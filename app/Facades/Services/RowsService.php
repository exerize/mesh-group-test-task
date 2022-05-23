<?php

namespace App\Facades\Services;

use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\RowsService
 *
 * @see \App\Services\RowsService::importExcelFile()
 * @method static importExcelFile(UploadedFile $file)
 *
 * @see \App\Services\RowsService::truncateAllRows()
 * @method static truncateAllRows()
 *
 * @see \App\Services\RowsService::getRowsOrderedByDate()
 * @method static Collection getRowsOrderedByDate()
 *
 */

class RowsService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\RowsService::class;
    }
}
