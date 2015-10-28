<?php

namespace controller;

require_once("view/HTMLView.php");
require_once("view/NavigationView.php");
require_once("view/GameView.php");

require_once("model/Player.php");
require_once("model/Players.php");

class Controller{
    private $view;
    private $html;
    private $nav;
    private $gameView;

    public function __construct(){
        $this->html = new \view\HTMLView("utf-8");
        $this->nav = new \view\NavigationView();

    }

    public function doGame(){
        if($this->nav->userWantsToStartNewGame()){
            $player = new \model\Player("Player1", "X");
            $computer = new \model\Player("Computer", "O");
            $players = new \model\Players();

            $players->addPlayer($player);
            $players->addPlayer($computer);

            $this->gameView = new \view\GameView($players);
            if ($this->gameView->formIsSubmitted()) {
                $this->gameView->handleBoxes();

                $this->gameView->checkIfFormIsEmpty();
                $this->gameView->computerMove();
                $this->gameView->checkWhoIsWinner();
                echo $this->gameView->getWinner();
            }
            $this->view = $this->html->getHTML("Tick Tack Toe", $this->nav, $this->gameView->generateGameBoard());
        }
        else{
            $this->view = $this->html->getHTML("Tick Tack Toe", $this->nav, $this->nav->presentStartingPage());
        }
    }
    public function getView(){
        return $this->view;
    }
}