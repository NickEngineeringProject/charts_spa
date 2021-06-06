<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EchartRequest;
use App\Services\Chart\Charts;

class EchartsController extends Controller
{
    private Charts $service;

    public function __construct(Charts $service) { $this->service = $service; }

    public function store(EchartRequest $request) { return $this->service->store($request->all())->getJson(); }
}
