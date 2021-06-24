<?php


namespace App\Services\Chart;

class Series
{
    public function dataset(string $type, string $value, ?string $name = null): array
    {
        $value = explode(',', str_replace(' ', '', $value));
        $name = explode(',', str_replace(' ', '', $name));

        if ($type == 'pie') {
            $data = [];
            for ($i = 0; $i<count($value); $i++) {
                $data[] = (object)[ "value" => (int)$value[$i], "name" => $name[$i] ];
            }
            return [ "radius" => '50%', "data" => $data ];
        } else {
            return [ "data" => $value, "type" => $type ];
        }
    }
}
