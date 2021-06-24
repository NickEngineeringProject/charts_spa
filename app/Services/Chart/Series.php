<?php


namespace App\Services\Chart;

class Series
{
    public function dataset(string $type, string $value, ?string $name = null): array
    {
        if ($type == 'pie') {
            $value = explode(',', str_replace(' ', '', $value));
            $name = explode(',', str_replace(' ', '', $name));

            $data = [];
            for ($i = 0; $i<count($value); $i++) {
                $data[] = (object)[ "value" => (int)$value[$i], "name" => $name[$i] ];
            }
            return ["radius" => '50%', "data" => $data];
        } else {
            return [ "data" => explode(',', str_replace(' ', '', $data)), "type" => $type, ];
        }
    }
}
