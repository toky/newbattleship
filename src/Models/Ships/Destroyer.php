<?php
namespace App\Models\Ships;

/**
* class Destroyer - representation of ship type "Destroyer"
* Extend Ship for base properties
*
*/
class Destroyer extends Ship
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
