<?php

namespace model;

class Board{
    private $rows;
    private $boxes;

    public function __construct($rows, $boxes){
        $this->rows = $rows;
        $this->boxes = $boxes;
    }

    public function getRows(){
        return $this->rows;
    }
    public function getBoxes(){
        return $this->boxes;
    }
}