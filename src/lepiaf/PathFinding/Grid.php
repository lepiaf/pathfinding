<?php

namespace lepiaf\PathFinding;

/**
 * Class Grid
 *
 * @package lepiaf\pathfinding
 */
class Grid
{
    /**
     * @var array
     */
    protected $map = [];

    /**
     * @var int
     */
    protected $sizeX;

    /**
     * @var int
     */
    protected $sizeY;

    /**
     * @var array
     */
    protected $walls;

    /**
     * @var array
     */
    protected $start;

    /**
     * @var array
     */
    protected $target;

    /**
     * @param int $sizeX
     * @param int $sizeY
     */
    public function __construct($sizeX, $sizeY)
    {
        $this->sizeX = $sizeX;
        $this->sizeY = $sizeY;
    }

    /**
     * @param array $walls
     *
     * @return self
     */
    public function setWalls($walls)
    {
        $this->walls = $walls;

        return $this;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStart(array $start)
    {
        $this->start = $start;

        return $this;
    }

    public function setTarget(array $target)
    {
        $this->target = $target;

        return $this;
    }

    public function inBound(array $node)
    {
        list($x, $y) = $node;

        return 0 <= $x && $x < $this->sizeX && 0 <= $y && $y < $this->sizeY;
    }

    public function passable(array $node)
    {
        return !in_array($node, $this->walls);
    }

    /**
     * Reverse path solution
     *
     * @param array $cameFrom
     *
     * @return array
     */
    public function getResolvedPath(array $cameFrom)
    {
        $current = $this->target;
        $result = [];

        while (isset($cameFrom[$this->toKey($current)])) {
            $result[] = $cameFrom[$this->toKey($current)];
            $current = $cameFrom[$this->toKey($current)];
            if ($current == $this->start) {
                break;
            }
        }

        return array_reverse($result);
    }

    /**
     * @param array $node
     *
     * @return array
     */
    public function getNeighbors(array $node)
    {
        list($x, $y) = $node;

        $results = [[$x+1, $y], [$x, $y-1], [$x-1, $y], [$x, $y+1]];
        if (($x + $y) % 2 === 0) {
            array_reverse($results);
        }

        $that = $this;
        $results = array_filter($results, function ($value) use ($that) {
            return $that->inBound($value);
        });

        $results = array_filter($results, function ($value) use ($that) {
            return $that->passable($value);
        });

        return $results;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function displayMap()
    {
        for ($i = 0; $i < $this->sizeY; $i++) {
            $this->map[] = array_fill(0, $this->sizeX, ' ');
        }

        foreach ($this->walls as $wall) {
            list ($x, $y) = $wall;
            $this->map[$y][$x] = '#';
        }

        if ($this->start) {
            list($x, $y) = $this->start;
            $this->map[$y][$x] = "S";
        }

        if ($this->target) {
            list($x, $y) = $this->target;
            $this->map[$y][$x] = "T";
        }

        for ($y = 0; $y < $this->sizeY; $y++) {
            for ($x = 0; $x < $this->sizeX; $x++) {
                echo $this->map[$y][$x];
            }
            echo PHP_EOL;
        }
    }

    public function toKey(array $node)
    {
        return implode(',', $node);
    }
}
