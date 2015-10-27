<?php

namespace view;

class GameView{
    private $gameBoard;

    public function __construct(\model\Board $gameBoard){
        $this->gameBoard = $gameBoard;
    }
    public function generateGameBoard(){
        $ret = "<table>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>";
        echo $ret;
    }
}