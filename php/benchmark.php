<?php
require_once './AppGati.php';

class Benchmark {
    protected $benchmark;
    function __construct()
    {
        $this->benchmark = new AppGati();
    }

    function start(){
        $this->benchmark->step('start');
    }

    function end(){
        $this->benchmark->step('end');
        print_r($this->benchmark->getReport('start', 'end'));
    }
}

$benchmark = new AppGati();

$benchmark->step('start');