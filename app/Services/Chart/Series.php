<?php


namespace App\Services\Chart;

use Exception;
use Illuminate\Support\Facades\Response;

class Series
{
    public function stringHandler(string $value): array
    {
        return explode(",", str_replace(" ", "", $value));
    }

    public function advancedHandler(string $value, string $name): array
    {
        $value = $this->stringHandler($value);
        $name = $this->stringHandler($name);

        $data = [];
        for ($i = 0; $i<count($value); $i++) {
            $data[] = (object)["value" => (int)$value[$i], "name" => $name[$i]];
        }

        return $data;
    }

    public function dataset(string $type, string $value, ?string $name = null)
    {
        try {
            return match ($type) {
                "line" => ["data" => $this->stringHandler($value), "type" => $this->stringHandler($type), "smooth" => false],
                "pie" => ["radius" => "50%", "data" => $this->advancedHandler($value, $name)],
                "scatter" => ["symbolSize" => 20, "data" => $this->advancedHandler($value, $name), "type" => $type],
                "k" => ["type" => $type, "data" => $this->advancedHandler($value, $name)],
                default => Response::json(["status" => "error", "message" => "Данного типа диаграммы не существует!"], 500),
            };
        } catch (\Exception) {
            return Response::json(["status" => "error", "message" => "Ошибка в обработке данных объекта Series"], 500);
        }
    }
}
