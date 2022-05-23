<?php
namespace App\Http\Controllers\Api\Row;

use App\Facades\Services\RowsService;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke()
    {
        return RowsService::getRowsOrderedByDate();
    }
}
