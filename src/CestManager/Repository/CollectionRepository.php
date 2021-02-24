<?php

declare(strict_types = 1);
namespace App\CestManager\Repository;

use App\CestManager\Entity\Collection;
use App\CestManager\ValueObject\Collection\Id;
use Fantestic\CestManager\Finder;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CollectionRepository
{
    public function __construct(
        private Finder $finder
    ) {}


    /**
     * Returns a list of all existing Collections
     * 
     * @return iterable|Collection[] 
     */
    public function findAll() :iterable
    {
        foreach ($this->finder->listFiles() as $path) {
            yield new Collection(Id::fromPath($path));
        }
    }


    /**
     * Finds a collection or returns null if the collection cant be found.
     * 
     * @param Id $id 
     * @return null|Collection 
     */
    public function find(Id $id) :?Collection
    {
        if ($this->finder->hasFile($id->toPath())) {
            return new Collection($id);
        } else {
            return null;
        }
    }
}
