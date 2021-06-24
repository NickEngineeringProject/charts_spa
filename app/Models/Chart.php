<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory;

    protected $fillable = [
        'series_type',
        'series_data',
        //для pie
        'series_name',
        'x_axis',
        'y_axis',
    ];
}
