<?php

declare(strict_types=1);

namespace Interfaces\Admin\Clients\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:30'],
            'items.*.title.en' => ['required', 'string'],
            'items.*.title.nl' => ['required', 'string'],
            'items.*.title.fr' => ['required', 'string'],
            'items.*.paragraph.en' => ['required', 'string'],
            'items.*.paragraph.nl' => ['required', 'string'],
            'items.*.paragraph.fr' => ['required', 'string'],
            'items.*.type.en' => ['required', 'string'],
            'items.*.type.nl' => ['required', 'string'],
            'items.*.type.fr' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'items.*.title.en.required' => 'The title field is required.',
            'items.*.title.nl.required' => 'The title field is required.',
            'items.*.title.fr.required' => 'The title field is required.',
            'items.*.paragraph.en.required' => 'The paragraph field is required.',
            'items.*.paragraph.nl.required' => 'The paragraph field is required.',
            'items.*.paragraph.fr.required' => 'The paragraph field is required.',
            'items.*.type.en.required' => 'The type field is required.',
            'items.*.type.nl.required' => 'The type field is required.',
            'items.*.type.fr.required' => 'The type field is required.',
        ];
    }
}
