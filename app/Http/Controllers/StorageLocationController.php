<?php

namespace App\Http\Controllers;

use App\Domains\StorageLocation\Actions\DeleteStorageLocationAction;
use App\Domains\StorageLocation\Actions\ForceDeleteStorageLocationAction;
use App\Domains\StorageLocation\Actions\RestoreStorageLocationAction;
use App\Domains\StorageLocation\Actions\StoreStorageLocationAction;
use App\Domains\StorageLocation\Actions\UpdateStorageLocationAction;
use App\Domains\StorageLocation\DTO\StorageLocationDTO;
use App\Domains\StorageLocation\Models\StorageLocation;
use App\Http\Requests\StorageLocationRequest;

class StorageLocationController extends Controller
{
    public function index()
    {
        return view('dictionaries.storage-locations.index', [
            'locations' => (new StorageLocation())->orderBy('name')->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Места хранения'],
            ],
        ]);
    }

    public function create()
    {
        return view('dictionaries.storage-locations.form', [
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Места хранения', 'url' => route('storage-locations.index')],
                ['title' => 'Добавление'],
            ],
        ]);
    }

    public function store(StorageLocationRequest $request, StoreStorageLocationAction $action)
    {
        $action->execute(StorageLocationDTO::fromRequest($request));

        return redirect()
            ->route('storage-locations.index')
            ->with('success','Место хранения создано.');
    }

    public function edit(StorageLocation $storageLocation)
    {
        return view('dictionaries.storage-locations.form', [
            'storageLocation' => $storageLocation,
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Места хранения', 'url' => route('storage-locations.index')],
                ['title' => 'Редактирование'],
            ],
        ]);
    }

    public function update(
        StorageLocationRequest $request,
        StorageLocation $storageLocation,
        UpdateStorageLocationAction $action
    ) {
        $action->execute(
            $storageLocation,
            StorageLocationDTO::fromRequest($request)
        );

        return redirect()
            ->route('storage-locations.index')
            ->with('success','Место хранения изменено.');
    }

    public function destroy(StorageLocation $storageLocation, DeleteStorageLocationAction $action)
    {
        $action->execute($storageLocation);

        return redirect()
            ->route('storage-locations.index')
            ->with('success','Место хранения перемещено в архив.');
    }

    public function archive()
    {
        return view('dictionaries.storage-locations.archive', [
            'locations' => StorageLocation::onlyTrashed()->orderBy('name')->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Архив мест хранения'],
            ],
        ]);
    }

    public function restore(int $id, RestoreStorageLocationAction $action)
    {
        $action->execute($id);

        return redirect()
            ->route('storage-locations.index')
            ->with('success','Место хранения восстановлено.');
    }

    public function forceDelete(int $id)
    {
        ForceDeleteStorageLocationAction::run($id);

        return redirect()->route('storage-locations.index')
            ->with('success','Место хранения удалено навсегда.');
    }
}
