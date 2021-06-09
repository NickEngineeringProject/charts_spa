<?php


namespace App\Services\Chart;

class Series
{
    private array $series = [];

    public function setSeriesStr(string $type, string $data, ?string $name = null)
    {
        if ($type == 'pie') {
            $value = explode(',', str_replace(' ', '', $data));

            $name = explode(',', str_replace(' ', '', $name));

            $data = [];

            for ($i = 0; $i<count($value); $i++) {
                $data[] = (object)[
                    "value" => (int)$value[$i],
                    "name" => $name[$i]
                ];
            }

            $this->series = ["radius" => '50%', "data" => $data];
        } else {
            $this->series = [
                "data" => explode(',', str_replace(' ', '', $data)),
                "type" => $type,
            ];
        }
    }

    /** пример получаемых данных
     *[
     *      ['type' => 'line', 'data' => [99,102,20,235,112,675,76,24,657,32]],
     *      ['type' => 'bar', 'data' => [199,202,30,335,212,575,176,124,457,132]],
     * ]
     * @param array $series
     */
    public function setSeriesArr(array $series)
    {
//        ($series[0]['type'])
        foreach ($series as $ser) { array_push($this->series, (object)$ser); }
    }

    public function getSeries(): array
    {
        return $this->series;
    }
}
