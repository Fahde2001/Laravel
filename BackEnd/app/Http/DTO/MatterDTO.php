<?php

namespace App\Http\DTO;

class MatterDTO
{
    public $name;
    public $cof;

    public function __construct($name, $cof)
    {
        $this->name = $name;
        $this->cof = $cof;
    }
}
