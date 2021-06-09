<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChartRequest;
use App\Services\Chart\Charts;

class EchartsController extends Controller
{
    private Charts $service;

    public function __construct(Charts $service)
    {
        $this->service = $service;
    }

    public function store(ChartRequest $request)
    {
        return $this->service
            ->createChart($request->all());
//        ->getChart();
    }
}
