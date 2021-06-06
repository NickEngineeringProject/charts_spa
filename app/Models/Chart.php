<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'color', 'x_axis_data', 'y_axis_data', 'series_type', 'series_data', 'array_series'
    ];
}
