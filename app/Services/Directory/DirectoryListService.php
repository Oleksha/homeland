<?php

namespace App\Services\Directory;

class DirectoryListService
{
    public function get(): array
    {
        return collect(config('directories'))
            ->map(function ($directory) {

                $model = $directory['model'];

                if ($directory['soft_delete'] ?? false) {
                    $count = $model::withoutTrashed()->count();
                    $archived = $model::onlyTrashed()->count();
                } else {
                    $count = $model::count();
                    $archived = null;
                }

                return [
                    'title' => $directory['title'],
                    'description' => $directory['description'],
                    'icon' => $directory['icon'],
                    'route' => route($directory['route']),
                    'count' => $count,
                    'archived' => $archived,
                ];
            })
            ->values()
            ->toArray();
    }
}
