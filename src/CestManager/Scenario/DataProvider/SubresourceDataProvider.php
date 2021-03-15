<?php

declare(strict_types = 1);
namespace App\CestManager\Scenario\DataProvider;

use App\CestManager\Collection\CollectionRepository;
use App\CestManager\Scenario\Transformer\IdToCollectionIdTransformer;
use App\CestManager\Collection\ValueObject\Id as CollectionId;
use App\CestManager\Exception\ValueObject\InvalidIdentifierStringException;
use App\CestManager\Scenario\ValueObject\Id as ScenarioId;
use App\CestManager\Collection\Transformer\IdToNamespaceTransformer;
use App\CestManager\Scenario\Entity\Scenario;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SubresourceDataProviderInterface;
use Fantestic\CestManager\CestReader;
use Fantestic\CestManager\Exception\ClassNotFoundException;
use LogicException;
use Fantestic\CestManager\Exception\UnprocessableScenarioException;

/**
 * DataProvider to load Collections into ApiPlatform
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class SubresourceDataProvider implements RestrictedDataProviderInterface, SubresourceDataProviderInterface
{
    public function __construct(
        private IdToCollectionIdTransformer $idToCollectionIdTransformer,
        private CollectionRepository $collectionRepository,
        private CestReader $cestReader,
        private IdToNamespaceTransformer $idToNamespaceTransformer
    ) { }


    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return Scenario::class === $resourceClass;
    }


    /**
     * 
     * @param string $resourceClass 
     * @param array $identifiers 
     * @param array $context 
     * @param string|null $operationName 
     * @return iterable|Scenario[]
     * @throws ClassNotFoundException
     * @throws LogicException
     * @throws UnprocessableScenarioException
     */
    public function getSubresource(string $resourceClass, array $identifiers, array $context, ?string $operationName = null) :?iterable
    {
        $collectionId = CollectionId::fromString($identifiers['id']['id']);
        try {
            $collectionDto = $this->cestReader->getCollection(
                $this->idToNamespaceTransformer->transform($collectionId)
            );
            foreach ($collectionDto->getScenarios() as $scenario) {
                yield Scenario::fromDto($scenario, $collectionId);
            }
        } catch (InvalidIdentifierStringException $e) {
            return null;
        } catch (ClassNotFoundException | LogicException | UnprocessableScenarioException $e) {
            throw $e;
        }
    }
}
