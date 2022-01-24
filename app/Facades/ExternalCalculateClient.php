<?php

declare(strict_types=1);

namespace App\Facades;

use App\Clients\ExternalCalculateClient as Client;
use Illuminate\Support\Facades\Facade;

/**
 * Class ExternalCalculateClient
 *
 * @method Client priceProduct(array $data)
 */
class ExternalCalculateClient extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'external-calculate';
    }
}
