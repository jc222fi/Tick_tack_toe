<?php

namespace model;

require_once("AttemptedMove.php");
require_once("Winner.php");
class GameModel{
    private $players;
    private $player;
    private $board;
    private $winner;

    public function __construct(\model\Players $players, \model\Board $board){
        $this->players = $players;
        $this->board = $board;
        $this->winner = new Winner();
    }
    public function getPlayers(){
        return $this->players;
    }
    public function setPlayerTurn($playerName){
        $this->player = $this->players->getPlayerByName($playerName);
    }
    public function getPlayerTurn(){
        return $this->player;
    }
    public function switchPlayer(){
        if($this->player == null || $this->player->getSign() == "O"){
            $this->player = $this->players->getPlayerByName("Player");
        }
        else{
            $this->player = $this->players->getPlayerByName("Computer");
        }
    }
    public function getBoard(){
        return $this->board;
    }
    public function availableMoves(){
        $boxes = $this->getBoard()->getBoxes();
        $availableMoves = array();
        for($i = 0; $i <=8; $i++)
        {
            if($boxes[$i] == ''){
                array_push($availableMoves, $i);
            }
        }
        return $availableMoves;
    }
    public function futurePossibleBoard($move){
        $newBoard = new Board($this->board->getBoxes());
        $this->makeMove($move, $newBoard);
        return $newBoard;


        /*$boxes = $this->board->getBoxes();
        foreach($boxes as $i => $box){
            if($box == ''){
                $newBoard = new Board($this->board->getBoxes());
                $this->makeMove($i, $newBoard);

//                $newBoxes = Array();
//                for($i = 0; $i <=8; $i++)
//                {
//                    if($newBoxes[$i] == ''){
//                        $newBoxes[$i] = $this->getPlayerTurn()->getSign();
//                        $this->switchPlayer();
//                    }
//                }
//                /*foreach($newBoard as &$newBox){
//                    if($newBox == ''){
//                        $newBox = $this->getPlayerTurn()->getSign();
//                        $this->switchPlayer();
//                        array_push($newBoxes, $newBox)
//                    }
//                }
//                $newBoard->setBoard($newBoxes);
                //array_push($nextPossibleBoards, new GameModel($this->players, $newBoard));
            }
        }*/
    }
    public function makeMove($position, Board $board){

        $board->setBoxValue($position, $this->player->getSign());
    }
    public function tryMove(Array $attempt){
        $attemptedMove = new \model\AttemptedMove($this->board);
        $result = $attemptedMove->tryMove($attempt);
        return $result;
    }
    public function getWinner(){
        return $this->winner;
    }
    public function checkWinner(){
        $this->winner->checkWinner($this->board, $this->player);
        $this->winner = $this->winner->getWinner();
        return $this->winner;
    }
}