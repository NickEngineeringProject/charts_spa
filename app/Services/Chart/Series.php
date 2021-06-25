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
                    return ["data" => $value, "type" => $type, "smooth" => false];
                    break;
                case "pie":
                    $data = [];
                    for ($i = 0; $i<count($value); $i++) {
                        $data[] = (object)["value" => (int)$value[$i], "name" => $name[$i]];
                    }
                    return ["radius" => "50%", "data" => $data];
                    break;
                case "scatter":
                    //TODO: протестировать ввод 1,3 параметров(ринимает 2)
                    //TODO: продумать изменение свойства symbolSize а также подсказки для пользователя типа что такое стандартная диаграмма
                    $data = [];
                    for ($i = 0; $i<count($value); $i++) {
                        $data[] = [$value[$i], $value[++$i]];
                    }
                    return ["symbolSize" => 20, "data" => $data, "type" => $type];
                case "k":
                    //TODO: протестировать ввод 3,5 параметров(принимает 4)
                    $data = [];
                    for ($i = 0; $i<count($value); $i++) {
                        $data[] = [$value[$i], $value[++$i], $value[++$i], $value[++$i]];
                    }
                    return ["type" => $type, "data" => $data];
                default:
                    return Response::json(["status" => "error", "message" => "Данного типа диаграммы не существует!"], 500);
            }
        } catch (\Exception) {
            return Response::json(["status" => "error", "message" => "Ошибка в обработке данных объекта Series"], 500);
        }
    }
}
