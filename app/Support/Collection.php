<?php

namespace App\Support;
/**
 * Created by PhpStorm.
 * User: stavan.shah
 * Date: 11/18/2017
 * Time: 6:05 PM
 */

class Collection
{
    protected $items = [];

    public function __construct(array $items=[])
    {
        $this->items = $items;
    }

    public function get() {
        return $this->items;
    }

    public function count() {
        return count($this->items);
    }
}