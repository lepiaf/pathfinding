<?php

namespace lepiaf\PathFinding;

/**
 * Interface PathFindingInterface
 *
 * @package lepiaf\PathFinding
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