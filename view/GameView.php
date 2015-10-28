<?php

namespace view;

require_once("model/Winner.php");
class GameView{
    private $players = array();
    private $boxes = array();
    private $winner;

    public function __construct(\model\Players $players){
        $this->players = $players;
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
        $this->boxes[0] = $_POST["box0"];
        $this->boxes[1] = $_POST["box1"];
        $this->boxes[2] = $_POST["box2"];
        $this->boxes[3] = $_POST["box3"];
        $this->boxes[4] = $_POST["box4"];
        $this->boxes[5] = $_POST["box5"];
        $this->boxes[6] = $_POST["box6"];
        $this->boxes[7] = $_POST["box7"];
        $this->boxes[8] = $_POST["box8"];
    }
    private function checkIfFormHasEmptyBox(){
        for($i = 0; $i <=8; $i++){
            if($this->boxes[$i] == ''){
                return true;
            }
        }
        return false;
    }
    public function checkWhoIsWinner(){
        $this->winner->checkWinner($this->boxes);
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
        return "<p>Grattis". $winner ."</p>";
    }
}