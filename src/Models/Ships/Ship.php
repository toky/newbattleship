<?php
namespace App\Models\Ships;

/**
* class Ship representation of main properties for ship
* 
*
*/
class Ship
{
    /**
    * @var int $shipSize contain ship size
    */
    private $shipSize;

    /**
    * @var int $shipSize contain ship size
    */
    public function __construct($shipSize)
    {
        $this->shipSize = $shipSize;
    }

    /**
    * Getter for ship size
    *
    * @return int ship size
    */
    public function getSize()
    {
        return $this->shipSize;
    }
}
