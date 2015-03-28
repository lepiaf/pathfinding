<?php

namespace lepiaf\PathFinding;

class Queue
{
    protected $elements = [];

    public function isEmpty() {
        return count($this->elements) === 0;
    }

    public function put($node) {
        $this->elements[] = $node;
    }

    public function get() {
        return array_shift($this->elements);
    }
}
