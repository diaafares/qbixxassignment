<?php

declare(strict_types=1);

namespace Domain\Clients\Models;

use Domain\Clients\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    public function items(): HasMany {
        return $this->hasMany(Item::class);
    }
}
