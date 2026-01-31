<?php

namespace App\Http\Controllers;

use App\Services\Directory\DirectoryListService;

class DirectoryController extends Controller
{
    public function __invoke(DirectoryListService $service)
    {
        return view('dictionaries.directories.index', [
            'directories' => $service->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники'],
            ],
        ]);
    }
}
