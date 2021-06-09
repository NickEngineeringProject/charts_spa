<?php


namespace App\Services\Chart;


class Series
{
    private array $series = [];
    protected array $data = [];
    protected array $value = [];
    protected array $name = [];

    public function setSeriesStr(string $type, string $data, ?string $name = null)
    {
        //разбить на data: [
        //                {value: 1048, name: '搜索引擎'},
        //                {value: 735, name: '直接访问'},
        //                {value: 580, name: '邮件营销'},
        //                {value: 484, name: '联盟广告'},
        //                {value: 300, name: '视频广告'}
        //            ],
        if ($type == 'pie') {

            $this->value = explode(',', str_replace(' ', '', $data));

            $this->name = explode(',', str_replace(' ', '', $name));

            $result = [];
            for ($i = 0, $i<count($this->value), $i++) {
                $result[] = [$this->value[$i], $this->name[$i]];
            }

            $this->series = [
                "type" => $type,
                "radius" => '50%',
                "data" => $result
            ];
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
        foreach ($series as $ser) { array_push($this->series, (object)$ser); }
    }

    public function getSeries(): array
    {
        return $this->series;
    }
}
