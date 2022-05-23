<?php

namespace App\Services;

use App\Facades\Repositories\RowsRepository;
use App\Http\Resources\RowsResource;
use App\Imports\RowsImport;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class RowsService
{
    /**
     * @param UploadedFile $file
     * @return bool
     */
    public function importExcelFile(UploadedFile $file): bool
    {
        $hashName = Hash::make($file->getClientOriginalName() . now());
        $import = (new RowsImport($hashName));
        Excel::queueImport($import, $file)->allOnQueue(config('queue.connections.rabbitmq.queue'));

        return true;
    }

    /**
     * @return void
     */
    public function truncateAllRows(): void
    {
        RowsRepository::truncate();
    }

    /**
     * @return Collection
     */
    public function getRowsOrderedByDate(): Collection
    {
        return RowsRepository::getRowsOrderedByDate()
            ->groupBy(function ($q) {
                return Carbon::createFromDate($q->date)->format('d.m.Y');
            })
            ->map(fn(Collection $rows): JsonResource => RowsResource::collection($rows));
    }
}
