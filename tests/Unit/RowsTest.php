<?php

namespace Tests\Unit;

use App\Facades\Services\RowsService;
use App\Imports\RowsImport;
use App\Models\Row;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class RowsTest extends TestCase
{
    public function test_store()
    {
        Excel::fake();

        $filename = 'test.xlsx';
        $file = new UploadedFile(base_path('tests/Files/'.$filename), $filename, 'application/excel', null, true);
        $this->assertTrue(RowsService::importExcelFile($file));

        Excel::assertQueued($filename, static fn (RowsImport $import): bool => true);
        Excel::assertImported($filename, static fn (RowsImport $import): bool => true);
    }

    public function test_truncate()
    {
        $rows = Row::factory()->count(5)->create();
        RowsService::truncateAllRows();

        $this->assertEmpty(Row::get());
    }

    public function test_show()
    {
        $rows = Row::factory()->count(5)->create();
        $sortedRows = $rows->sortBy('date');

        $expectedArray = [];
        foreach ($sortedRows as $row) {
            $expectedArray[Carbon::createFromDate($row->date)->format('d.m.Y')][] = [
              'id' => $row->id,
              'name'   => $row->name
            ];
        }

        $resultArray = RowsService::getRowsOrderedByDate()->toArray();

        $this->assertEquals(json_encode($expectedArray), json_encode($resultArray));
    }
}
