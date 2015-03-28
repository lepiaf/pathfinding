<?php

namespace lepiaf\pathfinding;

/**
 * Interface PathFindingInterface
 *
 * @package lepiaf\pathfinding
 */
interface PathFindingInterface {

    /**
     * Search path to target
     *
     * @param Grid $grid
     *
     * @return array
     */
    public function search(Grid $grid);
}