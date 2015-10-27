<?php

namespace controller;

require_once("view/HTMLView.php");
require_once("view/NavigationView.php");
require_once("view/GameView.php");

require_once("model/Board.php");

class Controller{
    private $view;
    private $html;
    private $nav;
    private $board;
    private $gameView;

    public function __construct(){
        $this->html = new \view\HTMLView("utf-8");
        $this->nav = new \view\NavigationView();
        $this->board = new \model\Board(3, 3);
        $this->gameView = new \view\GameView($this->board);
    }

    public function doGame(){
        if($this->nav->userWantToStartNewGame()){
            $this->view = $this->html->getHTML("Tick Tack Toe", $this->gameView->generateGameBoard(), $this->nav);
        }
        else{
            $this->view = $this->html->getHTML("Tick Tack Toe", $this->nav->presentStartingPage(), $this->nav);
        }
    }
    public function getView(){
        echo $this->view;
    }
}