<?php


namespace App\Services\Chart;


class Series
{
    private array $series = [];

    public function setSeriesObject(string $type, string $data)
    {
        array_push($this->series, (object)[$type, $data]);
    }

    /** пример получаемых данных
     * [
     *      ['type' => '1', 'data' => [99,102,20,235,112,675,76,24,657,32]],
     *      ['type' => '2', 'data' => [199,202,30,335,212,575,176,124,457,132]],
     * ]
     */
    public function setSeries($series)
    {
        foreach ($series as $ser) { array_push($this->series, (object)$ser); }
    }

    public function getSeries(): array
    {
        return $this->series;
    }
}
