<?php

declare(strict_types=1);

namespace Interfaces\Admin\Clients\Controllers;

use App\Enums\RoutesEnum;
use Domain\Clients\Models\Item;
use Domain\Clients\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Interfaces\Admin\Clients\Requests\UpdateClientRequest;

class UpdateClient extends Controller
{
    public function __invoke(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $client->update([
            'name' => $request->input('name')
        ]);

        foreach ($request->input('items') as $updatedItem) {
            $item = Item::find($updatedItem['id']);

            $item->update([
                'title' => $updatedItem['title'],
                'paragraph' => $updatedItem['paragraph'],
                'type' => $updatedItem['type']
            ]);
        }

        return redirect()->route(RoutesEnum::ADMIN_INDEX_CLIENTS);
    }
}
