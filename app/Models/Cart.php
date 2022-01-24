<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $session_id
 * @property Collection $cartProducts
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @mixin \Eloquent
 */
class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        $totalPrice = 0.0;

        /** @var CartProduct[] $products */
        $products = $this->cartProducts()->with('products')->get(['products.price', 'cart_products.count']);

        foreach ($products as $product) {
            $totalPrice += $product->product->price * $product->count;
        }

        return $totalPrice;
    }

    /**
     * @return HasMany
     */
    public function cartProducts(): HasMany
    {
        return $this->hasMany(CartProduct::class);
    }

}
