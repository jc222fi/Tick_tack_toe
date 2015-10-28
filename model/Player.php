<?php

namespace model;

class Player{
    private $name;
    private $sign;

    public function __construct($name, $sign){
        $this->name = $name;
        $this->sign = $sign;
    }
    public function getName(){
        return $this->name;
    }
    public function getSign(){
        return $this->sign;
    }
    public function move(){

    }
}