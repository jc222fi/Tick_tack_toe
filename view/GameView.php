<?php

namespace view;

use model\AttemptedMove;
use model\Board;

require_once("model/Winner.php");
class GameView{
    //private $players = array();
    //private $board;
    private $winner;
    private $computersTurn = false;
    private $playersTurn = true;

    public function __construct(){
        //$this->players = $players;
        //$this->winner = new \model\Winner();
    }
    public function generateGameBoard(\model\Board $board){
        $pTag = "<p>Type 'X' in the box you wish to put your move in, then click the submit button.</p>";
        $ret = "<form id='gameBoard' method='post'>";
        $ret2 = "";

        $boxes = $board->getBoxes();
        for($i = 0; $i <=8; $i++){
            $string = $boxes[$i];
            $ret2 .= "<select name='box$i'/>
                        <option value='". $boxes[$i] ."'>$string</option>
                        <option value='X'>X</option>
                      </select>";
            if($i==2 || $i==5 || $i==8){
                $ret2 .="<br>";
            }
        }
        if ($this->winner == null) {
            $ret3 = "    <input type='submit' name='submit' value='Submit'/>
                </form>";
        }
        else {
            $ret3 = $this->winner;
        }
        return $pTag . $ret . $ret2 . $ret3;
    }
    public function handleBoxes(\model\GameModel $gameModel){
        for($i = 0; $i <=8; $i++)
        {
            $newBoxes[$i] = $_POST["box$i"];
        }
        $success = $gameModel->tryMove($newBoxes);

        if($success){
            $this->computersTurn = true;
            return $newBoxes;
        }
        else {
            echo "<p>Please follow the rules! You may only make one move at a time.</p>";
        }

        /*$previouslyEmptyBoxes = array();
        $currentlyEmptyBoxes = array();
        foreach($this->boxes as $box){
            if($box === ""){
                array_push($previouslyEmptyBoxes, $box);
            }
        }

        foreach($newBoxes as $box){
            if($box === ""){
                array_push($currentlyEmptyBoxes, $box);
            }
        }
        $attemptedMoves = count($previouslyEmptyBoxes)-count($currentlyEmptyBoxes);
        var_dump($attemptedMoves);
        if ($attemptedMoves === self::ALLOWED_MOVE) {

            for($i = 0; $i <=8; $i++)
            {
                $this->boxes[$i] = $newBoxes[$i];
            }
        }
        else{
            echo "<p>Please follow the rules! You may only make one move at a time.</p>";
        }*/
    }
    private function checkIfFormHasEmptyBox(\model\Board $board){
        $boxes = $board->getBoxes();
        for($i = 0; $i <=8; $i++){
            if($boxes[$i] == ''){
                return true;
            }
        }
        return false;
    }
/*    public function checkWhoIsWinner(\model\Players $playersArray, \model\Board $board){
        $players = $playersArray->getAllPlayers();
        foreach ($players as $player) {
            $this->winner->checkWinner($board, $player);
        }
    }*/
    public function computerMove(\model\GameModel $gameModel){
        if($this->checkIfFormHasEmptyBox($gameModel->getBoard()) && $this->winner == null){
            $i = rand(0,8);
            $boxes = $gameModel->getBoard()->getBoxes();
            while($boxes[$i] != ''){
                $i = rand(0,8);
            }
            $boxes[$i] = $gameModel->getPlayerTurn()->getSign();
        }
        return $boxes;
    }
    public function formIsSubmitted(){
        if(isset($_POST["submit"])){
            return true;
        }
        return false;
    }
    public function getWinner(\model\Player $winner){
        if ($winner->getName() != "Computer") {
            $this->winner = "<p>Congratulations " . $winner->getName() . "! You won this round.</p>";
        }
        else if($winner->getName() === "Computer") {
            $this->winner = "<p>Sorry, the " . $winner->getName() . " won this round.</p>";;
        }
        else {
            $this->winner = null;
        }
    }
    public function computersTurn(){
        return $this->computersTurn;
    }
}