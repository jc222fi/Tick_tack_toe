<?php

namespace controller;

use model\GameModel;

require_once("view/HTMLView.php");
require_once("view/NavigationView.php");
require_once("view/GameView.php");

require_once("model/Player.php");
require_once("model/Players.php");
require_once("model/Winner.php");
require_once("model/Board.php");
require_once("model/GameModel.php");

class Controller{
    private $view;
    private $html;
    private $nav;
    private $winner;
    private $gameView;
    private $board;

    public function __construct(){
        $this->html = new \view\HTMLView("utf-8");
        $this->nav = new \view\NavigationView();
        $this->board = new \model\Board(Array('', '', '', '', '', '', '', '', ''));
        $this->winner = new \model\Winner();
        $this->gameView = new \view\GameView($this->board);
    }

    public function doGame(){
        if($this->nav->userWantsToStartNewGame()){
            $player = new \model\Player("Player", "X");
            $computer = new \model\Player("Computer", "O");
            $players = new \model\Players();

            $players->addPlayer($player);
            $players->addPlayer($computer);

            if ($this->gameView->formIsSubmitted()) {
                $tempBoard = new \model\Board(Array('', '', '', '', '', '', '', '', ''));
                $tempBoard->setBoard($this->board->getBoxes());

                $gameModel = new \model\GameModel($players, $tempBoard);
                $gameModel->setPlayerTurn("Player");
//                //var_dump($tempBoard);
                $boxes = $this->gameView->handleBoxes($gameModel);
                //var_dump($boxes);
                $this->board->setBoard($boxes);
                $winnerOfThisRound = $gameModel->checkWinner($this->winner);
                $gameModel->setPlayerTurn("Computer");
                //var_dump($this->board->getBoxes());
//                $this->gameView->checkWhoIsWinner($players, $this->board);
                if ($winnerOfThisRound === null) {
                    $newBoard = $this->gameView->computerMove($gameModel);
                    $this->board->setBoard($newBoard);
                    //var_dump($this->board->getBoxes());
                }
                $winnerOfThisRound = $gameModel->checkWinner($this->winner);
//                $this->gameView->checkWhoIsWinner($players, $this->board);
                //var_dump($gameModel->futurePossibleBoard());
                if ($winnerOfThisRound != null) {
                    $this->gameView->getWinner($winnerOfThisRound);
                }
                $gameModel->setPlayerTurn("Player");
            }
            $this->view = $this->html->getHTML("Tick Tack Toe", $this->nav, $this->gameView->generateGameBoard($this->board));
        }
        else{
            $this->view = $this->html->getHTML("Tick Tack Toe", $this->nav, $this->nav->presentStartingPage());
        }
    }
    public function getView(){
        return $this->view;
    }
}