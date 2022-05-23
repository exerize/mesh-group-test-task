<?php

namespace App\Observers;

use App\Events\RowAddEvent;
use App\Models\Row;
use Carbon\Carbon;

class RowObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  Row $row
     * @return void
     */
    public function created(Row $row)
    {
        $addEventData = [
            'id' => $row->id,
            'name' => $row->name,
            'date' => $row->date
        ];
        event(new RowAddEvent($addEventData));
    }
}
