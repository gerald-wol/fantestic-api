<?php

declare(strict_types = 1);
namespace App\Tests\Unit\CestManager\Scenario\Transformer;

use App\CestManager\Scenario\Transformer\IdToCollectionIdTransformer;
use App\CestManager\Collection\ValueObject\Id as CollectionId;
use App\CestManager\Scenario\ValueObject\Id as ScenarioId;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdToCollectionIdTransformerTest extends KernelTestCase
{
    public function testEncodesValue() :void
    {
        $idString = 'Dir-File';
        $collectionId = CollectionId::fromString($idString);
        $scenarioId = ScenarioId::fromString($idString.'::'.'methodname');
        $t = new IdToCollectionIdTransformer();
        $this->assertEquals($collectionId, $t->transform($scenarioId));
    }


    public function testGetMethodNameReturnsTheMethod() :void
    {
        $methodName = 'methodName';
        $id = ScenarioId::fromString("Dir-File::{$methodName}");
        $this->assertEquals($methodName, $id->getMethodName());
    }
}
