<?php


namespace App\Services\Chart;

use Exception;
use Illuminate\Support\Facades\Response;

class Series
{
    public function dataset(string $type, string $value, ?string $name = null)
    {
        try {
            $value = explode(",", str_replace(" ", "", $value));
            $name = explode(",", str_replace(" ", "", $name));

            switch ($type) {
                case "line":
                    return ["data" => $value, "type" => $type];
                    break;
                case "pie":
                    $data = [];
                    for ($i = 0; $i<count($value); $i++) {
                        $data[] = (object)["value" => (int)$value[$i], "name" => $name[$i]];
                    }
                    return ["radius" => "50%", "data" => $data];
                    break;
                case "scatter":
                    //TODO: протестировать ввод 3 параметров
                    //TODO: продумать изменение свойства symbolSize а также подсказки для пользователя типа что такое стандартная диаграмма
                    $data = [];
                    for ($i = 0; $i<count($value); $i++) {
                        $data[] = [$value[$i], $value[++$i]];
                    }
                    return ["symbolSize" => 20, "data" => $data, "type" => $type];
                default:
                    return Response::json(["status" => "error", "message" => "Данного типа диаграммы не существует!"], 500);
            }
        } catch (\Exception) {
            return Response::json(["status" => "error", "message" => "Ошибка в обработке данных объекта Series"], 500);
        }
    }
}
