<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChartRequest;
use App\Services\Chart\Chart;

class EchartsController extends Controller
{
    private Chart $service;

    public function __construct(Chart $service)
    {
        $this->service = $service;
    }

    public function __invoke(ChartRequest $request)
    {
        return $this->service
            ->handler($request->all());
    }

    public function createChart()
    {
        return $this->service
//            ->labels('1')
            ->dataset('series_type', 'series_data', 'series_name');
    }
}
