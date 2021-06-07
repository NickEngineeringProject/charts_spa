<?php

namespace App\Services\Chart;

use Illuminate\Support\Facades\Response;

class Charts
{
    private xAxios $xAxios;
    private yAxios $yAxios;
    private Series $series;

    public function __construct(xAxios $xAxios, yAxios $yAxios, Series $series)
    {
        $this->xAxios = $xAxios;
        $this->yAxios = $yAxios;
        $this->series = $series;
    }

    public function create(array $request): Charts
    {
        $this->xAxios->setData($request['x_axis_data']);
        $this->yAxios->setData($request['y_axis_data']);

        is_null($request['array_series'])
            ? $this->series
                ->setSeriesObject($request['series_type'], $request['series_data'])
            : $this->series
                ->setSeries($request['array_series']);

        return $this;
    }

    public function getJson()
    {
        return Response::json([
            "xAxis" => $this->xAxios->getData(),
            "yAxis" => $this->yAxios->getData(),
            "series" => $this->series->getSeries()
        ], 200);
    }
}
