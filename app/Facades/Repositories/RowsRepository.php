<?php

namespace App\Facades\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Repositories\RowsRepository
 *
 * @see \App\Repositories\RowsRepository::getRowsOrderedByDate()
 * @method static Collection getRowsOrderedByDate()
 *
 * @see \App\Repositories\RowsRepository::truncate()
 * @method static truncate()
 *
 * @see \App\Repositories\RowsRepository::create()
 * @method static create()
 *
 */

class RowsRepository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Repositories\RowsRepository::class;
    }
}
