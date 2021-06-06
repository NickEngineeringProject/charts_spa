<?php

namespace App\Services\Chart;

use Illuminate\Support\Facades\Response;

class Charts
{
    private string $title;
    private array $color;
    private xAxios $xAxios;
    private yAxios $yAxios;
    private Series $series;

    public function __construct(xAxios $xAxios, yAxios $yAxios, Series $series)
    {
        $this->xAxios = $xAxios;
        $this->yAxios = $yAxios;
        $this->series = $series;
    }

    public function store(array $request): Charts {
        $this->title = $request['title'];

        $colorTemplate = ['#c23531','#2f4554', '#61a0a8', '#d48265', '#91c7ae','#749f83',  '#ca8622', '#bda29a','#6e7074', '#546570', '#c4ccd3'];

        $colorTemplate[] = shuffle($colorTemplate);

        $this->color = is_null((array) $request['color']) ?: $colorTemplate;

        $this->xAxios->setData($request['x_axis_data']);

        $this->yAxios->setData($request['y_axis_data']);

        if (is_null($request['array_series'])) {
            $this->series
                ->setSeriesObject($request['series_type'], $request['series_data']);
        } else {
            $this->series
                ->setSeries($request['array_series']); }

        return $this;
    }

    public function getJson(): \Illuminate\Http\JsonResponse
    {
        return Response::json([
            "title" => $this->title,
            "color" => $this->color,
            "xAxis" => $this->xAxios->getData(),
            "yAxis" => $this->yAxios->getData(),
            "series" => $this->series->getSeries()
        ], 200);
    }
}
