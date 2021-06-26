<?php


namespace App\Services\Chart;

use Illuminate\Support\Facades\Response;

class Series
{
    public function stringHandler(string $value): array
    {
        return explode(",", str_replace(" ", "", $value));
    }

    public function advancedHandler(string $value, string $name, string $type): array
    {
        $value = $this->stringHandler($value);
        $name = $this->stringHandler($name);

        $data = [];
        for ($i = 0; $i<count($value); $i++) {
            switch ($type) {
                //тип приводится автоматически иначе написать проверку на число и выдавать предупреждение
                //проверить на количество входящих элементов
                case "pie":
                    $data[] = (object)["value" => (int)$value[$i], "name" => $name[$i]];
                    break;
                case "scatter":
                    $data[] = [(int)$value[$i], (int)$name[$i]];
                    break;
                case "k":
                    $data[] = [(int)$value[$i], (int)$value[++$i], (int)$value[++$i], (int)$value[++$i]];
                    break;
            }
        }
        return $data;
    }

    public function dataset(string $type, string $value, ?string $name = null): \Illuminate\Http\JsonResponse|array
    {
        try {
            $values = $this->advancedHandler($value, $name, $type);

            return match ($type) {
                "line" => ["data" => $this->stringHandler($value), "type" => $type, "smooth" => false],
                "pie" => ["radius" => "50%", "data" => $values],
                "scatter" => ["symbolSize" => 20, "data" => $values, "type" => $type],
                "k" => ["type" => $type, "data" => $values],

                default => Response::json([
                    "status" => "error",
                    "message" => "Данного типа диаграммы не существует из доступных: line, pie, scatter, k
                     или введено больше или меньше элементов для построения диаграммы."
                ], 409),
            };
        } catch (\Exception) {
            return Response::json([
                "status" => "error",
                "message" => "Ошибка в обработке данных объекта Series"
            ], 500);
        }
    }
}
