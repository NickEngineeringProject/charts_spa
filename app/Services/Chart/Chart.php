<?php

namespace App\Services\Chart;


class Chart
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
//    public static function build(): Chart
//    {
//        dd(new Chart(new Series, new xAxis, new yAxis));
//    }
//    public function labels(string $data)
//    {
//        return [ "xAxis" => $this->xAxis->setAxis($data) ];
//    }
//    public function labels(string $data)
//    {
//        return [ "yAxis" => $this->yAxis->setAxis($data) ];
//    }
//    /**
//     * 'series_type', 'series_data', 'series_name'
//     */
//    public function dataset(string $type, string $data, string $name)
//    {
//        return [ "series" => $this->series->setSeries($type, $data, $name) ];
//    }
    public function handler(array $request): array
    {
        return [
            "xAxis" => $this->xAxis
                ->labels($request['x_axis']),
            "yAxis" => $this->yAxis
                ->labels($request['y_axis']),
            "series" => $this->series
                ->dataset(
                    $request['series_type'], $request['series_data'], $request['series_name']
                ),
        ];
    }
}
