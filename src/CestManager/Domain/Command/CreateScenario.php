<?php

declare(strict_types = 1);
namespace App\CestManager\Domain\Command;

use App\CestManager\Domain\Entity\Scenario;

/**
 * Command to create a Scenario.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CreateScenario
{
    public function __construct(
        private Scenario $scenario
    ) { }


    public function getScenario() :Scenario
    {
        return $this->scenario;
    }
}