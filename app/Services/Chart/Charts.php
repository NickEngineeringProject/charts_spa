<?php

namespace App\Services\Chart;

use Illuminate\Support\Facades\Response;

class Charts
{
    private Series $series;
    private xAxis $xAxis;
    private yAxis $yAxis;

    public function __construct(Series $series, xAxis $xAxis, yAxis $yAxis)
    {
        $this->series = $series;
        $this->xAxis = $xAxis;
        $this->yAxis = $yAxis;
    }

    public function createChart(array $request): Charts
    {
        is_null($request['array_series'])
            ? $this->series
                ->setSeriesStr($request['series_type'], $request['series_data'], $request['series_name'])
            : $this->series
                ->setSeriesArr($request['array_series']);

        $this->xAxis
            ->setAxis($request['x_axis']);

        $this->yAxis
            ->setAxis($request['y_axis']);

        return $this;
    }

    public function getChart()
    {

        return Response::json([
            "xAxis" => $this->xAxis
                ->getAxis(),
            "yAxis" => $this->yAxis
                ->getAxis(),
            "series" => $this->series
                ->getSeries()
        ], 200);

    }
}
