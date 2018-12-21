<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product
{
    public $name;

    public $cost;

    public function __construct($name, $cost)
    {
        $this->name = $name;

        $this->cost = $cost;
    }
}
