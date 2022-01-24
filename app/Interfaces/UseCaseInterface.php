<?php

declare(strict_types=1);

namespace App\Interfaces;

interface UseCaseInterface
{
    public function handle(array $data);
}
