<?php

namespace controller;

use model\GameModel;

require_once("view/HTMLView.php");
require_once("view/NavigationView.php");
require_once("view/GameView.php");

require_once("model/Player.php");
require_once("model/Players.php");
require_once("model/Winner.php");
require_once("model/GameModel.php");
require_once("model/MiniMax.php");

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
        $this->gameView = new \view\GameView();
        $this->board = new \model\Board(Array('', '', '', '', '', '', '', '', ''));
        $this->winner = new \model\Winner();
    }

    public function doGame(){
        if($this->nav->userWantsToStartNewGame()){
            $player = new \model\Player("Player", "X");
            $computer = new \model\Player("Computer", "O");
            $players = new \model\Players();

            $players->addPlayer($player);
            $players->addPlayer($computer);

            $game = new \model\GameModel($players, $this->board);

            if ($this->gameView->formIsSubmitted()) {
                $this->board = $game->getBoardFromSession();
                /*$move = $this->gameView->handleBoxes($game);
                $this->board->updateBoard($move);
                $game->saveBoardInSession($this->board);*/
                var_dump($this->board);




                /*$tempBoard->setBoard($gameModel->getBoard()->getBoxes(true), true);

                $boxes = $this->gameView->handleBoxes($gameModel);
                $gameModel->updateBoard($boxes, true);
                $winnerOfThisRound = $gameModel->checkWinner($player);

                if($winnerOfThisRound === null){
                    $gameModel->setPlayerTurn("Computer");
                    $miniMax = new \model\MiniMax();
                    $result = $miniMax->miniMax($gameModel->getBoard(), $winnerOfThisRound, 2, true);

                    //var_dump($result);
                }*/
                //$gameModel->updateBoard($this->board->getBoxes());
                //$gameModel->setPlayerTurn("Computer");
                //var_dump($this->board->getBoxes());
//                $this->gameView->checkWhoIsWinner($players, $this->board);
                //var_dump($winnerOfThisRound);
                /*if ($winnerOfThisRound === null) {
                    $miniMax = new \model\MiniMax();
                    $result = $miniMax->miniMax($gameModel, true);

                    /*$newBoard = $this->gameView->computerMove($gameModel);
                    $this->board->setBoard($newBoard);
                    //var_dump($this->board->getBoxes());
                }*/
                //$winnerOfThisRound = $gameModel->checkWinner();
//                $this->gameView->checkWhoIsWinner($players, $this->board);
                //var_dump($gameModel->futurePossibleBoard());
                /*if ($winnerOfThisRound != null) {
                    $this->gameView->getWinner($winnerOfThisRound);
                }*/
                //$gameModel->setPlayerTurn("Player");
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