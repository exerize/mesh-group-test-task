<?php

namespace App\Repositories;

use App\Models\Row;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;

/** @property Row $model **/
class RowsRepository extends BaseRepository
{
    public function model(): string
    {
        return Row::class;
    }

    /**
     * @return Collection
     */
    public function getRowsOrderedByDate(): Collection {
        return $this->model
            ->orderBy('date')
            ->get();
    }

    public function truncate()
    {
        $this->model->truncate();
    }

}
