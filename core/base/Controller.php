<?php

//Parent Controller Class

namespace Core\Base;

abstract class Controller
{       
    public $data = [];

    abstract public function render(); 
}