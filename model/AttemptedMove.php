<?php

namespace model;

class AttemptedMove {
    private $initialBoard;

    const ALLOWED_MOVE = 1;

    public function __construct(\model\Board $initialBoard){
        $this->initialBoard = $initialBoard;
    }

    public function tryMove(Array $boardWithAttemptedMove){
        $boxes = $this->initialBoard->getBoxes();
        $previouslyEmptyBoxes = array();
        $currentlyEmptyBoxes = array();
        foreach($boxes as $box){
            if($box === ""){
                array_push($previouslyEmptyBoxes, $box);
            }
        }
        foreach($boardWithAttemptedMove as $box){
            if($box === ""){
                array_push($currentlyEmptyBoxes, $box);
            }
        }
        $attemptedMoves = count($previouslyEmptyBoxes)-count($currentlyEmptyBoxes);
        if ($attemptedMoves === self::ALLOWED_MOVE) {
            return true;
        }
        else {
            return false;
        }
    }
}