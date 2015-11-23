<?php

namespace view;

require_once("model/Winner.php");
class GameView{
    //private $players = array();
    private $boxes;
    private $winner;
    private $computersTurn = false;
    private static $gameBoard = "gameBoard";

    const ALLOWED_MOVE = 1;

    public function __construct(){
        //$this->players = $players;
        $this->winner = new \model\Winner();
    }
    public function generateGameBoard(){
        $pTag = "<p>Type 'X' in the box you wish to put your move in, then click the submit button.</p>";
        $ret = "<form id='gameBoard' method='post'>";
        $ret2 = "";

        for($i = 0; $i <=8; $i++){
            $string = $this->boxes[$i];
            $ret2 .= "<select name='box$i'/>
                        <option value='". $this->boxes[$i] ."'>$string</option>
                        <option value='X'>X</option>
                      </select>";
            if($i==2 || $i==5 || $i==8){
                $ret2 .="<br>";
            }
        }
        if ($this->winner->getWinner() == null) {
            $ret3 = "    <input type='submit' name='submit' value='Submit'/>
                </form>";
        }
        else {
            $ret3 = $this->getWinner();
        }
        return $pTag . $ret . $ret2 . $ret3;
    }
    private function getSessionGameBoard(){
        if(isset($_SESSION[self::$gameBoard])){
            $boxes = $_SESSION[self::$gameBoard];
            return $boxes;
        }
        else {
            return array('', '', '', '', '', '', '', '', '');
        }
    }
    public function handleBoxes(){
        $this->boxes = $this->getSessionGameBoard();
        var_dump($this->boxes);
        $previouslyEmptyBoxes = array();
        $currentlyEmptyBoxes = array();
        foreach($this->boxes as $box){
            if($box === ""){
                array_push($previouslyEmptyBoxes, $box);
            }
        }
        for($i = 0; $i <=8; $i++)
        {
            $newBoxes[$i] = $_POST["box$i"];
        }
        foreach($newBoxes as $box){
            if($box === ""){
                array_push($currentlyEmptyBoxes, $box);
            }
        }
        $attemptedMoves = count($previouslyEmptyBoxes)-count($currentlyEmptyBoxes);
        var_dump($attemptedMoves);
        if ($attemptedMoves === self::ALLOWED_MOVE) {
            $this->computersTurn = true;
            for($i = 0; $i <=8; $i++)
            {
                $this->boxes[$i] = $newBoxes[$i];
            }
            //$_SESSION[self::$gameBoard] = $this->boxes;
            //var_dump($_SESSION[self::$gameBoard]);
        }
        else{
            echo "<p>Please follow the rules! You may only make one move at a time.</p>";
        }
    }
    private function checkIfFormHasEmptyBox(){
        for($i = 0; $i <=8; $i++){
            if($this->boxes[$i] == ''){
                return true;
            }
        }
        return false;
    }
    public function checkWhoIsWinner(\model\Players $playersArray){
        $players = $playersArray->getAllPlayers();
        foreach ($players as $player) {
            $this->winner->checkWinner($this->boxes, $player);
        }
    }
    public function computerMove(\model\Player $computer){
        if($this->checkIfFormHasEmptyBox() && $this->winner->getWinner() == null){
            $i = rand(0,8);
            while($this->boxes[$i] != ''){
                $i = rand(0,8);
            }
            $this->boxes[$i] = $computer->getSign();
        }
        $_SESSION[self::$gameBoard] = $this->boxes;
        return $this->boxes;
    }
    public function formIsSubmitted(){
        if(isset($_POST["submit"])){
            return true;
        }
        return false;
    }
    public function getWinner(){
        $winner = $this->winner->getWinner();
        if ($winner != null && $winner->getName() != "Computer") {
            unset($_SESSION[self::$gameBoard]);
            return "<p>Congratulations " . $winner->getName() . "! You won this round.</p>";
        }
        else if($winner != null && $winner->getName() === "Computer") {
            unset($_SESSION[self::$gameBoard]);
            return "<p>Sorry, the " . $winner->getName() . " won this round.</p>";;
        }
        else {
            return "";
        }
    }
    public function computersTurn(){
        return $this->computersTurn;
    }
}