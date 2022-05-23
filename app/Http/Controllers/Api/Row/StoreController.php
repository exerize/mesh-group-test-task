<?php

namespace App\Http\Controllers\Api\Row;

use App\Facades\Services\RowsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Rows\StoreRequest;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $file = $request->file()['excel'];
        RowsService::truncateAllRows();
        RowsService::importExcelFile($file);

        return response()->json([
            'message' => 'File upload'
        ]);
    }
}
