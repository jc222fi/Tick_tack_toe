<?php

namespace view;

require_once("model/Winner.php");
class GameView{
    //private $players = array();
    private $boxes = array();
    private $winner;

    public function __construct(){
        //$this->players = $players;
        $this->winner = new \model\Winner();
    }
    public function generateGameBoard(){
        $pTag = "<p>Type 'X' in the box you wish to put your move in, then click the submit button.</p>";
        $ret = "<form id='gameBoard' method='post' >";
        $ret2 = "";

        for($i = 0; $i <=8; $i++){
            $ret2 .= "<input type='text' name='box". $i ."' value='". $this->boxes[$i] ."'/>";
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
    public function handleBoxes(){
        $this->boxes = array('','','','','','','','','');
        for($i = 0; $i <=8; $i++)
        {
            $this->boxes[$i] = $_POST["box$i"];
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
            return "<p>Congratulations " . $winner->getName() . "! You won this round.</p>";
        }
        else if($winner != null && $winner->getName() === "Computer") {
            return "<p>Sorry, the " . $winner->getName() . " won this round</p>";;
        }
        else {
            return "";
        }
    }
}