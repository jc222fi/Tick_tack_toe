<?php

namespace model;

require_once("AttemptedMove.php");
require_once("Winner.php");
require_once("Board.php");
class GameModel{
    private $players;
    private $board;
    private static $sessionSaveLocation = "gameBoard";

    public function __construct(\model\Players $players, Board $board){
        $this->players = $players;
        $this->board = $board;
    }
    public function saveBoardInSession($board){
        $_SESSION[self::$sessionSaveLocation] = $board;
        $this->$board = $board;
    }
    public function getBoard(){
        return $this->board;
    }
    public function getBoardFromSession(){
        if(isset($_SESSION[self::$sessionSaveLocation])){
            $this->board = $_SESSION[self::$sessionSaveLocation];
        }
        return $this->board;
    }
    public function tryMove(Array $attempt){
        $attemptedMove = new \model\AttemptedMove($this->board);
        $result = $attemptedMove->tryMove($attempt);
        return $result;
    }
    public function checkWinner($player){
        $winner = new Winner();
        $winner->checkWinner($this->board, $player);
        return $winner->getWinner();
    }

    /*public function getPlayers(){
        return $this->players;
    }
    public function updateBoard(Array $array, $first){
        $this->board->setBoard($array, $first);
    }
    public function setPlayerTurn($playerName){
        $this->player = $this->players->getPlayerByName($playerName);
    }
    public function getPlayerTurn(){
        return $this->player;
    }
    public function switchPlayer(){
        if($this->player->getSign() == "O"){
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
        return $this->board->getAvailableBoxes();
        $boxes = $this->getBoard()->getBoxes(true);
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
        $newBoard = new Board($this->board->getBoxes(true));
        $this->makeMove($move, $newBoard);
        return $newBoard;
    }
    public function makeMove($position, Board $board){
        $board->makeMove($position);
    }
    public function tryMove(Array $attempt){
        $attemptedMove = new \model\AttemptedMove($this->board);
        $result = $attemptedMove->tryMove($attempt);
        return $result;
    }
    public function getWinner(){
        return $this->winner->getWinner();
    }
    public function checkWinner($player){
        $this->winner->checkWinner($this->board, $player);
        return $this->winner->getWinner();
    }
    public function isGameOver(){
        if($this->getWinner() == null){
            return false;
        }
        else{
            return true;
        }
    }*/
}