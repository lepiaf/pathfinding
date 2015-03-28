<?php

namespace lepiaf\PathFinding;

/**
 * Implement Breadth First Search algorithm
 *
 * @package lepiaf\PathFinding
 */
class BreadthFirstSearch implements PathFindingInterface
{
    /**
     * @param Grid $grid
     *
     * @return array
     */
    public function search(Grid $grid)
    {
        $frontier = new Queue();
        $frontier->put($grid->getStart());
        $cameFrom = [];
        $cameFrom[$this->toKey($grid->getStart())] = null;

        while (!$frontier->isEmpty()) {
            $current = $frontier->get();

            if ($current === $grid->getTarget()) {
                break;
            }

            foreach ($grid->getNeighbors($current) as $next) {
                if (!isset($cameFrom[$this->toKey($next)])) {
                    $frontier->put($next);
                    $cameFrom[$this->toKey($next)] = $current;
                }
            }
        }

        return $cameFrom;
    }

    public function toKey(array $node)
    {
        return implode(',', $node);
    }
}
