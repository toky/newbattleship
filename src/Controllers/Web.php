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

        $input = new \App\Decorator\InputDecorator();
        $input->set("coord", GRID_ROW, GRID_COL);
        
        // Call static buildGame to create game
        $gameVariables = \App\Factory\GameFactory::buildGame($input->get());
        
        // Call static showGame to show game
        \App\Factory\GameFactory::showGame(
            $gameVariables[1], 
            GRID_ROW, GRID_COL, 
            $gameVariables[0], 
            $gameVariables[2]
            );
    }
}
