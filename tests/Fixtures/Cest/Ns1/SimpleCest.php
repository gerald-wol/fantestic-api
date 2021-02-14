<?php

declare(strict_types = 1);
namespace App\Tests\Fixtures\Cest\Ns1;

/**
 * Codeception Cest generated by Fantestic.
 *
 * Feel free to add custom tests, any tests that do not have a 
 * @fantestic annotation will be ignored by Fantestic.
 * 
 * @author Fantestic
*/
class SimpleCest
{
    /**
     * This is a valid Fantestic Test and should be loaded
     * @fantestic
     * @param AcceptanceTester $I 
     * @return void 
     */
    public function firstTest(\AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }

    /**
     * This is not a fantestic test as the fantestic annotation is missing
     * @param AcceptanceTester $I 
     * @return void 
     */
    public function notForFantestic(\AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }
}
