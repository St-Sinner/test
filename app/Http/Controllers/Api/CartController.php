<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\CalculationRequest;
use App\UseCases\Cart\CartCalculationUseCase;

class CartController extends Controller
{
    /**
     * @param CalculationRequest $request
     * @param CartCalculationUseCase $cartCalculationCase
     *
     * @return array
     */
    public function calculate(CalculationRequest $request, CartCalculationUseCase $cartCalculationCase): array
    {
        return $cartCalculationCase->handle($request->toArray());
    }

    /**
     * TODO remove
     * Method for test
     */
    public function external(): array
    {
        return [
            'id' => 1,
            'price' => 100,
        ];
    }
}
