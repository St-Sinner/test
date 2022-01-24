<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property int $is_published
 * @property string|null $description
 * @property string $code
 * @property float $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $table = 'products';
}
