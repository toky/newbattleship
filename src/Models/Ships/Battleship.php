<?php
namespace App\Models\Ships;

/**
* class Battleship - representation of ship type "Battleship"
* Extend Ship for base properties
*
*/
class Battleship extends Ship
{
    /**
    *
    * @param int $shipSize
    */
    public function __construct($shipSize)
    {
        parent::__construct($shipSize);
    }
}
