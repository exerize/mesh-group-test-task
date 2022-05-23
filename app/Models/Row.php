<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;

    protected $fillable = [
      'id',
      'name',
      'date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
