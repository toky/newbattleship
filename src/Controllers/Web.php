<?php
namespace App\Controllers;

/**
* class Web - representation game logic for web 
*
*/
class Web extends Controller
{
    public function index()
    {
        if (isset($_POST['coord']) && $_POST['coord'] != "") {
            $input = $_POST['coord'];
        } else {
            $input = "";
        }

        // Call static buildGame to create game
        $gameVariables = \App\Factory\GameFactory::buildGame($input);
        
        // Call static showGame to show game
        \App\Factory\GameFactory::showGame(
            $gameVariables[1], 
            GRID_ROW, GRID_COL, 
            $gameVariables[0], 
            $gameVariables[2]
            );
    }
}
