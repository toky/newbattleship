<?php
namespace App\Factory;

/**
* class GameFactory 
*/

class GameFactory
{
    /**
    * @var string $gameMessage
    */
    public $gameMessage;

    private function __construct()
    {
        ;
    }

    /**
    *
    * @param $input User input
    *
    * @return array $shotMessage, $gridState, $grid->getFinalMessage()
    */
    public static function buildGame($input)
    {
        // Declared variable for shoting message
        $shotMessage = "";

        // Create new instance of class Grid to create game grid, with game grid dimensions 10x10
        $grid = new \App\Models\Grid([GRID_ROW, GRID_COL]);
        
        for ($battleShip=0; $battleShip < BATTLESHIP_COUNT; $battleShip++) {

            // Create new instance of class Battleship to create Battleship
            $battleShipShip = new \App\Models\Ships\Battleship(BATTLESHIP_LENGHT);

            // Add ships to grid
            $grid->addShip($battleShipShip->getSize());
        }
        
        for ($destroyer=0; $destroyer < DESTROYERS_COUNT; $destroyer++) {
            
            // Create new instance of class Destroyer to create Battleship
            $destroyerShip = new \App\Models\Ships\Battleship(DESTROYER_LENGHT);

            // Add ships to grid
            $grid->addShip($destroyerShip->getSize());
        }

        // Generate game grid
        $gridState = $grid->getGrid();

        if (isset($input) && $input != "" && $input != "error") { // Cehck for empty input
                if ($input == 'show') { // Check for back door command to show only ships
                    // Set only ships to grid
                    $gridState = $grid->getGrid('show');
                } else {
                    // Try to shot ship
                    $shotMessage = $grid->shot($input);

                    // Get game grid with result of shot
                    $gridState = $grid->getGrid();
                }
        } else { // If input is empty
                // Set empty shot message
               
                if($input == "error")
                {
                    $shotMessage = "Error: coordinates are out of range";
                } else {
                     $shotMessage = "";
                }
                // Get current grid
                $gridState = $grid->getGrid();
        }

        return [$shotMessage, $gridState, $grid->getFinalMessage()];
    }
    /**
    * Show game grid
    *
    * @param 
    */
    public static function showGame(
        $gridState, 
        $gridRow, 
        $gridCol, 
        $shotMessage, 
        $finalMessage
        ){
            // Create instance of Decorate
            $decorator = new \App\Decorator\WebDecorator(
                $gridState, 
                $gridRow, 
                $gridCol, 
                $shotMessage, 
                $finalMessage);

            if (IS_CLIENT) { // Check if client is Cli (Console)
                // Call decorator for cli
                $decorator->cliDecorate();
                return;
            }
            
            // Call decorator for web
            $decorator->webDecorate();
        }
}
