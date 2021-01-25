<?php

declare(strict_types = 1);

namespace App\Dto;

/**
 * Collection Input Dto. Consumed by api read operations.
 * 
 * @author Gerald Baumeister <gerald.b@whosonlocation.com>
 * @see: https://api-platform.com/docs/core/dto/
 * 
 */
final class CollectionOutput
{
    /**
     * @var string the identifier of the Collection.
    */
    public string $id;
}
