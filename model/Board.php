<?php

namespace model;

class Board{
    private $boxes = Array();
    private static $sessionSaveLocation = "gameBoard";

    public function __construct(Array $boxes){
        $this->boxes = $boxes;
    }
    public function getBoxes(){
        if(isset($_SESSION[self::$sessionSaveLocation])){
            $this->boxes = $_SESSION[self::$sessionSaveLocation];
        }
        return $this->boxes;
    }
    public function setBoxValue($position, $value){
        $this->boxes[$position] = $value;
        $this->setBoard($this->boxes);
    }
    public function setBoard(Array $boxes){
        $_SESSION[self::$sessionSaveLocation] = $boxes;
    }
    public function clearBoard(){
        unset($_SESSION[self::$sessionSaveLocation]);
        $this->boxes = Array('', '', '', '', '', '', '', '', '');
    }
}