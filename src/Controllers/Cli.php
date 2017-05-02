<?php
namespace App\Controllers;

/**
* class Web - representation game logic for cli (console)
*
*/
class Cli extends Controller
{
    public function index()
    {
        $input = new \App\Decorator\InputDecorator();
        $gameVariables = \App\Factory\GameFactory::buildGame($input->get());
        
        // Call static showGame to show game
        \App\Factory\GameFactory::showGame(
            $gameVariables[1],
            GRID_ROW,
            GRID_COL,
            $gameVariables[0],
            $gameVariables[2]
            );
                
        while (true) { // Start infinity loop
            echo "Enter coordinates (row, col), e.g. A5: ";
            // Get inputed coordinates
            $cliInput = fgets(STDIN, 1024);
            $input->set($cliInput, GRID_ROW, GRID_COL);
            
            // Call static buildGame to create game
            $gameVariables = \App\Factory\GameFactory::buildGame($input->get());
            
            // Call static showGame to show game
            \App\Factory\GameFactory::showGame(
                $gameVariables[1],
                GRID_ROW, GRID_COL,
                $gameVariables[0],
                $gameVariables[2]
                );
                
            if ($gameVariables[2]) {// If we gave final message
                // Stop infinity loop
                return false;
            }
        }
    }
}
