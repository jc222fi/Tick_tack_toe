<?php

namespace view;

class GameView{
    private $gameBoard;
    private $box = array();
    private $blank;
    private $winner = '';

    public function __construct(\model\Board $gameBoard){
        $this->gameBoard = $gameBoard;
    }
    public function generateGameBoard(){
        $ret = "<form id='gameBoard' method='post' >";
        $ret2 = "";

        for($i = 0; $i <=8; $i++){
            $ret2 .= "<input type='text' name='box". $i ."' value='". $this->box[$i] ."'/>";
            if($i==2 || $i==5 || $i==8){
                $ret2 .="<br>";
            }
        }
		$ret3= "    <input type='submit' name='submit' value='Submit'/>
                </form>";
        return $ret . $ret2 . $ret3;
    }
    public function handleBoxes(){
        $this->box = array('','','','','','','','','');
        $this->box[0] = $_POST["box0"];
        $this->box[1] = $_POST["box1"];
        $this->box[2] = $_POST["box2"];
        $this->box[3] = $_POST["box3"];
        $this->box[4] = $_POST["box4"];
        $this->box[5] = $_POST["box5"];
        $this->box[6] = $_POST["box6"];
        $this->box[7] = $_POST["box7"];
        $this->box[8] = $_POST["box8"];
    }
    public function checkIfFormIsEmpty(){
        $this->blank = 0;
        for($i = 0; $i <=8; $i++){
            if($this->box[$i] == ''){
                $this->blank = 1;
            }
        }
    }
    public function checkIfPlayerIsWinner(){
        if(($this->playerInARow())||
            ($this->playerInAColumn())||
            ($this->playerDiagonal())){
            $this->winner = "X";
        }
    }
    private function playerInARow(){
        if(($this->box[0] == 'X' && $this->box[1] == 'X' && $this->box[2] == 'X')||
            ($this->box[3] == 'X' && $this->box[4] == 'X' && $this->box[5] == 'X')||
            ($this->box[6] == 'X' && $this->box[7] == 'X' && $this->box[8] == 'X')){
            return true;
        }
        return false;
    }
    private function playerInAColumn(){
        if(($this->box[0] == 'X' && $this->box[3] == 'X' && $this->box[6] == 'X')||
            ($this->box[1] == 'X' && $this->box[4] == 'X' && $this->box[7] == 'X')||
            ($this->box[2] == 'X' && $this->box[5] == 'X' && $this->box[8] == 'X')){
            return true;
        }
        return false;
    }
    private function playerDiagonal(){
        if(($this->box[0] == 'X' && $this->box[4] == 'X' && $this->box[8] == 'X')||
            ($this->box[2] == 'X' && $this->box[4] == 'X' && $this->box[6] == 'X')){
            return true;
        }
        return false;
    }
    private function computerInARow(){
        if(($this->box[0] == 'O' && $this->box[1] == 'O' && $this->box[2] == 'O')||
            ($this->box[3] == 'O' && $this->box[4] == 'O' && $this->box[5] == 'O')||
            ($this->box[6] == 'O' && $this->box[7] == 'O' && $this->box[8] == 'O')){
            return true;
        }
        return false;
    }
    private function computerInAColumn(){
        if(($this->box[0] == 'O' && $this->box[3] == 'O' && $this->box[6] == 'O')||
            ($this->box[1] == 'O' && $this->box[4] == 'O' && $this->box[7] == 'O')||
            ($this->box[2] == 'O' && $this->box[5] == 'O' && $this->box[8] == 'O')){
            return true;
        }
        return false;
    }
    private function computerDiagonal(){
        if(($this->box[0] == 'O' && $this->box[4] == 'O' && $this->box[8] == 'O')||
            ($this->box[2] == 'O' && $this->box[4] == 'O' && $this->box[6] == 'O')){
            return true;
        }
        return false;
    }
    public function computerMove(){
        if($this->blank == 1 && $this->winner == ''){
            $i = rand(0,8);
            while($this->box[$i] != ''){
                $i = rand(0,8);
            }
            $this->box[$i] = "O";
            if(($this->computerInARow())||
                ($this->computerInAColumn())||
                ($this->computerDiagonal())){
                $this->winner = "O";
            }
        }
    }
    public function formIsSubmitted(){
        if(isset($_POST["submit"])){
            return true;
        }
        return false;
    }
    public function getWinner(){
        //var_dump($this->winner);
        return "<p>". $this->winner ."</p>";
    }
}