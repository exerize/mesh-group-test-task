<?php

namespace App\Imports;

use App\Events\RowAddEvent;
use App\Facades\Repositories\RowsRepository;
use App\Http\Requests\Api\Rows;
use App\Models\Row;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;

class RowsImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation, ShouldQueue
{
    use RemembersChunkOffset;
    use RemembersRowNumber;

    private const CHUNK_SIZE = 1000;
    private int $cacheTtl;

    public function __construct(protected string $hashName)
    {
        $this->cacheTtl = config('ttl.file_progress');
    }

    public function model(array $row)
    {
        $chunkOffset = $this->getChunkOffset();

        RowsRepository::create([
            'id' => $row['id'],
            'name' => $row['name'],
            'date' => $row['date']
        ]);
        $this->setCacheProgress();

        return null;
    }

    public function uniqueBy(): array
    {
        return ['id'];
    }

    public function upsertColumns(): array
    {
        return ['name', 'date'];
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'date' => ['required', 'date'],
        ];
    }

    public function prepareForValidation(array $row): array
    {
        return [
            'id' => (int) $row['id'],
            'name' => $row['name'],
            'date' => Date::excelToDateTimeObject($row['date']),
        ];
    }

    public function chunkSize(): int
    {
        return self::CHUNK_SIZE;
    }

    private function setCacheProgress() {
        $processedRows = $this->getRowNumber();
        Cache::put($this->hashName, $processedRows, $this->cacheTtl);
    }
}
