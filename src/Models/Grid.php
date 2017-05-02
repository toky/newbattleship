<?php
namespace App\Models;

/**
 * Class Grid - representation of the game grid
 *
 */
class Grid
{
    /**
    * @var int $row contain rows of grid
    * @var int $column contain col of grid
    * @var int $ships contain rows of grid
    * @var mixed [] $matrix contain game grid
    * @var int $countShips contain ships count
    * @var int $sunkedShips contain sunked ships
    * @var int $finalMessage contain final game message
    * @var session|array $dataManager manipulate stored data from data manager
    */
    private $row;
    private $col;
    private $ships;
    private $matrix;
    protected $countShips;
    protected $sunkedShips;
    private $finalMessage;
    private $dataManager;


    /**
    * @param $gridDimension
    */
    public function __construct($gridDimension)
    {
        $this->dataManager = new \App\Decorator\DataManagerDecorator();
        $this->ships=[];
        $this->row = $gridDimension[0];
        $this->col = $gridDimension[1];
        $this->countShips = 0;
        $this->matrix = $this->generateGrid();
        if (!$this->dataManager->get('grid')) {
            $this->dataManager->set('grid', $this->generateGrid());
        }
    }

    /**
    * Generate game grid
    *
    * @return array
    */
    private function generateGrid()
    {
        for ($row=0; $row < $this->row; $row++) {
            for ($col=0; $col < $this->col; $col++) {
                $this->matrix[$row][$col] = ".";
            }
        }
        return $this->matrix;
    }

    /**
    * Get generated game grid in SESSION. Cehck for backdoor command to show ships
    *
    * @param string $state State of grid
    *
    * @return session
    */
    public function getGrid($state = null)
    {
        if ($state == 'show') { // Check for cheat command, to show ships in game grid
            $this->dataManager->set(
                'gridWithShips',
                $this->showShipsOnGrid(
                    $this->dataManager->get('shipCoordinates')
                    )
                );
            return $this->dataManager->get('gridWithShips');
        } else { // return game grid with hidden ships
            return $this->dataManager->get('grid');
        }
    }

    /**
    * Get grid row count
    *
    * @return int
    */
    public function getRowCount()
    {
        return $this->row;
    }

    /**
    * Get grid column count
    *
    * @return int
    */
    public function getColCount()
    {
        return $this->col;
    }

    /**
    *	Add ship to game grid
    *
    * @param int $shipsize
    */
    public function addShip($shipSize)
    {
        // Generate random number from ship orientation 0 form column or 1 form row.
        $shipOrientation = rand(0, 1);

        // Generate random first starting point for ship (row).
        $firstCoordinateRow = rand(0, $this->row - 1);
        $secondCoordinateRow = rand(0, ($this->row -1) - $shipSize);
        $startingCoordinateRow = [$firstCoordinateRow, $secondCoordinateRow];

        // Generate second starting point for ship (col).
        $firstCoordinateCol = rand(0, ($this->col - 1) - $shipSize);
        $secondCoordinateCol = rand(0, $this->col - 1);
        $startingCoordinateCol = [$firstCoordinateCol, $secondCoordinateCol];
        
        $i = 0;
        while ($i < $shipSize) {//loop for adding other coordinates to ship
            if ($shipOrientation) {// if orientation is 1(row) decrement column
                $row = $startingCoordinateRow[0] ;
                $col = $startingCoordinateRow[1]+ $i;
            } else { // if orientation is 0(column) decrement row
                $row = $startingCoordinateCol[0]+ $i;
                $col = $startingCoordinateCol[1] ;
            }

            // Put ship coordinates to array to store them
            $shipCoordinates[] = $row . ';' . $col;
            $i++;
        }
            
        if (empty($this->ships)) { // Cechk ships count, to add first ship without verification for overlaping
            // Add Coordinate to ships array to store him
            $this->ships[] = $shipCoordinates;

            // Increment ships count
            $this->countShips++;
        } else {
            if ($this->isShipOverlap($this->ships, $shipCoordinates)) { // Cechk ship coordinate for overlaping with others ship
                // Clear ship from ship array
                $this->ships = [];

                // Call again same method to generate new coordinates
                $this->addShip($shipSize);
            } else {
                // Add Coordinate to ships array to store him
                $this->ships[] = $shipCoordinates;

                // Increment ships count
                $this->countShips++;
            }
        }

        if (!($this->dataManager->get('shipCoordinates', $this->countShips) !== null)) { // Check is set session with current ship
            $this->dataManager->set(
                'shipCoordinates',
                $shipCoordinates,
                $this->countShips
                );
        }
    }

    /**
    * Check ship for Overlaping
    *
    * @param array $shipsOnGtidCoordinates
    * @param array $currentShip
    *
    * @return bool true|false
    */
    protected function isShipOverlap($shipsOnGtidCoordinates, $currentShip)
    {
        $isOverlap = false;

        if (!empty($shipsOnGtidCoordinates)) {
            foreach ($shipsOnGtidCoordinates as $key => $shipCoordinate) {
                if (array_intersect($currentShip, $shipCoordinate)) {
                    $isOverlap = true;
                }
            }
        }
        
        return $isOverlap;
    }

    /**
    * Show ships on game grid
    *
    * @param array $shipsCoordinates
    *
    * @return array Game grid without dot, only with ships
    */
    public function showShipsOnGrid($shipsCoordinates)
    {
        $gridWithShips = [];
        for ($row=0; $row < $this->row; $row++) {
            for ($col=0; $col < $this->col; $col++) {
                $gridWithShips[$row][$col] = " ";
            }
        }

        foreach ($shipsCoordinates as $key => $ship) {
            foreach ($ship as $key => $shipCoordinates) {
                $explodedShipCoordinates = explode(';', $shipCoordinates);
                $row = $explodedShipCoordinates[0];
                $col = $explodedShipCoordinates[1];
                $gridWithShips[$row][$col] = "X";
            }
        }

        return $gridWithShips;
    }

    /**
    * Get coordinates of ships in game grid
    *
    * @return array
    */
    public function getShipsOnGridCoordinates()
    {
        return $this->ships;
    }

    public function restartGrid()
    {
        session_destroy();
    }

    /**
    * Seter for final game message
    *
    * @return void
    */
    public function setFinalMessage($finalMessage)
    {
        $this->finalMessage = $finalMessage;
    }

    /**
    * Get final message
    *
    * @return string
    */
    public function getFinalMessage()
    {
        return $this->finalMessage;
    }
    
    /**
    *	Transalte input to coordinate for shot
    * @param array $input
    *
    * @return array Return translated input to coordinate
    */
    private function inputToCoordinates($input)
    {
        return $input;
    }
    
    /**
    * Shot ship on game grid
    *
    * @param array $shotCoordinates
    *
    * @return string Return message for hit, miss ot sunked ship
    */
    public function shot($inputShotCoordinates)
    {
        //Count shots
        $this->countShots();

        // Declare empty variable for message
        $message = "";

        //Translate user input to shot coordinates
        $shotCoordinates = $this->inputToCoordinates($inputShotCoordinates);

        // Declare shot row coordinate
        $shotRow = $shotCoordinates[0];

        // Declare shot column coordinate
        $shotCol = $shotCoordinates[1];

        //Merge coordinate in string
        $shotCoordinates = $shotCoordinates[0].";".$shotCoordinates[1];

        //Count non sunked ships
        $shipCountRow = count(
            array_filter(
                $this->dataManager->get('shipCoordinates')
                )
            );

        foreach ($this->dataManager->get('shipCoordinates') as $key => $ship) {

            // Check is shot hit ship
            $isHitShip = in_array($shotCoordinates, $ship);
            if ($isHitShip) {// Is ship is hitted
                // Remove coordinate from ship
                $this->hitShip($shotCoordinates, $ship, $key, $shotRow, $shotCol);
                
                if (count($ship) == 1) { // Count current nonshoted ship coordinates
                    // Set message for sunked ship
                    $message = "Sunk";

                    if ($shipCountRow == 1) { // Cehck ship count, to check game status

                        // Set Final Message
                        $finalMessage = "Well done! You completed the game in " . $this->dataManager->get('countShots') . " shots";
                        $this->setFinalMessage($finalMessage);
                    }
                } else { // If current shot hit ship

                    // Set message for successfully hited ship
                    $message = "Hit";
                }
                
                // Stop executing script
                break;
            } else { // Set message for unsuccessful shot
                // Set message
                $message = "Miss";
                
                // Set sign on game grid for unsuccessful shot
                $this->dataManager->set(
                    'grid',
                    '-',
                    $shotRow + 1,
                    $shotCol + 1
                    );
            }
        }

        return $message;
    }

    protected function countShots()
    {
        if (!($this->dataManager->get('countShots') !== null)) {
            // Set session with first shot
           $this->dataManager->set('countShots', 1);
        } else {
            // Increment Session with shots
            $incrementShot = $this->dataManager->get('countShots') + 1;
            $this->dataManager->set('countShots', $incrementShot);
        }
    }

    protected function hitShip($shotCoordinates, $ship, $key, $shotRow, $shotCol)
    {
        $hitedShipCoordinate = array_search($shotCoordinates, $ship);
                $this->dataManager->unsetValue(
                    'shipCoordinates',
                    $key,
                    $hitedShipCoordinate
                    );

                // Set grid session without hitted coordiante
                $this->dataManager->set(
                    'gridWithShips',
                    $this->showShipsOnGrid(
                        $this->dataManager->get('shipCoordinates')
                        )
                    );
                
                // Set shot as successfully to game grid
                $this->dataManager->set(
                    'grid',
                    'X',
                    $shotRow + 1,
                    $shotCol + 1
                    );
    }
}
