<?php

declare(strict_types=1);

namespace App\Interfaces;

interface ExternalCalculateInterface
{
    public function priceProduct(array $data): array;
}
