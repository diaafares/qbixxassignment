<?php

declare(strict_types=1);

namespace Domain\Clients\Models;

use Domain\Clients\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, HasTranslations;

    const TYPE_WISDOM = [
        'en' => 'Wisdom',
        'nl' => 'Wijsheid',
        'fr' => 'Sagesse',
    ];

    const TYPE_DESIGN = [
        'en' => 'Design',
        'nl' => 'Ontwerp',
        'fr' => 'Conception',
    ];

    const TYPE_PHILOSOPHY = [
        'en' => 'Philosophy',
        'nl' => 'Filosofie',
        'fr' => 'Philosophie',
    ];

    public $translatable = [
        'title',
        'paragraph',
        'type'
    ];

    public function client(): BelongsTo {
        return $this->belongsTo(Client::class);
    }
}
