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
        $frontier = new \SplQueue();
        $frontier->enqueue($grid->getStart());
        $cameFrom = [];
        $cameFrom[$this->toKey($grid->getStart())] = false;

        while (!$frontier->isEmpty()) {
            $current = $frontier->dequeue();

            if ($current === $grid->getTarget()) {
                break;
            }

            foreach ($grid->getNeighbors($current) as $next) {
                if (!isset($cameFrom[$this->toKey($next)])) {
                    $frontier->enqueue($next);
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
