<?php

namespace controller;

require_once("view/HTMLView.php");
require_once("view/NavigationView.php");

require_once("model/Board.php");

class Controller{
    private $html;
    private $nav;
    private $board;

    public function __construct(){
        $this->html = new \view\HTMLView("utf-8");
        $this->nav = new \view\NavigationView();
        $this->board = new \model\Board();
    }

    public function doGame(){
        if($this->nav->userWantToStartNewGame()){
            echo "start new game";
        }
        else{
            echo "welcome";
        }
    }
    public function getView(){
        return $this->html->getHTML("Tick Tack Toe", $this->nav->presentStartingPage(), $this->nav);
    }
}