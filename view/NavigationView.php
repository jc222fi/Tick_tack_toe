<?php

namespace view;

class NavigationView{
    private static $newGame = "new_game";

    public function presentStartingPage(){
        return "<p>Welcome to Tick Tack Toe. Click the link to start a new game</p>";
    }
    public function getGameLink(){
        return "<a href='?".self::$newGame."'>New Game</a>";
    }
    public function userWantsToStartNewGame(){
        if(isset($_GET[self::$newGame])){
            return true;
        }
        return false;
    }
}