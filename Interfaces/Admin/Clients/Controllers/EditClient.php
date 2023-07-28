<?php

declare(strict_types=1);

namespace Interfaces\Admin\Clients\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Domain\Clients\Models\Client;
use App\Http\Controllers\Controller;
use Domain\Clients\Models\Item;

class EditClient extends Controller
{
    public function __invoke(Client $client): Response
    {
        $client->load('items');

        $types = [
            Item::TYPE_WISDOM,
            Item::TYPE_PHILOSOPHY,
            Item::TYPE_DESIGN,
        ];

        return Inertia::render(
            'Admin/Clients/Edit',
            compact('client', 'types'),
        );
    }
}
