<?php

declare(strict_types=1);

namespace App\UseCases\Cart;

use App\Facades\ExternalCalculateClient;
use App\Interfaces\UseCaseInterface;
use Illuminate\Support\Facades\Cache;

class CartCalculationUseCase implements UseCaseInterface
{
    private const CACHE_TIME = 600;

    private ExternalCalculateClient $client;

    private Cache $cache;

    public function __construct(ExternalCalculateClient $client, Cache $cache)
    {
        $this->client = $client;
        $this->cache = $cache;
    }

    public function handle(array $data): array
    {
        $products = $data['products'];
        $totalPrice = 0.00;

        foreach ($products as &$product) {
            $price = $this->getPrice($product);
            $product['price'] = $price;
            $totalPrice += $price;
        }

        return ['products' => $products, 'totalPrice' => $totalPrice];
    }

    private function getPrice(array $product): float
    {
        $key = 'product_' . $product['id'] . '_price';
        if ($this->cache::has($key)) {
            $product['price'] = $this->cache::get($key);
            $price = $product['price'] * $product['count'];
        } else {
            $response = $this->client::priceProduct(['id' => $product['id']]);
            $price = $response['price'] * $product['count'];
            $this->cache::put($key, $response['price'], self::CACHE_TIME);
        }

        return $price;
    }

}
