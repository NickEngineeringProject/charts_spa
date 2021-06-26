<?php


namespace App\Services\Chart;

use Illuminate\Support\Facades\Response;

class Series
{
    /**
     * @param string $dataset
     * @return array
     */
    public function stringHandler(string $dataset): array
    {
        return explode(",", str_replace(" ", "", $dataset));
    }

    public function advancedHandler(string $firstDataset, string $secondDataset, string $chartType): array
    {
        $firstDataset = $this->stringHandler($firstDataset);
        $secondDataset = $this->stringHandler($secondDataset);

        $data = [];
        for ($i = 0; $i<count($firstDataset); $i++) {
            switch ($chartType) {
                //TODO: тип приводится автоматически иначе написать проверку на число и выдавать предупреждение
                //TODO: проверить на количество входящих элементов
                case "pie":
                    $data[] = (object)["value" => (int)$firstDataset[$i], "name" => $secondDataset[$i]];
                    break;
                case "scatter":
                    $data[] = [(int)$firstDataset[$i], (int)$secondDataset[$i]];
                    break;
                case "k":
                    $data[] = [(int)$firstDataset[$i], (int)$firstDataset[++$i], (int)$firstDataset[++$i], (int)$firstDataset[++$i]];
                    break;
            }
        }
        return $data;
    }

    public function dataset(string $chartType, string $firstDataset, ?string $secondDataset = null): \Illuminate\Http\JsonResponse|array
    {
        try {
            $dataset = $this->advancedHandler($firstDataset, $secondDataset, $chartType);

            return match ($chartType) {
                "line" => ["data" => $this->stringHandler($firstDataset), "type" => $chartType, "smooth" => false],
                "pie" => ["radius" => "50%", "data" => $dataset],
                "scatter" => ["symbolSize" => 20, "data" => $dataset, "type" => $chartType],
                "k" => ["type" => $chartType, "data" => $dataset],

                default => Response::json([
                    "status" => "error",
                    "message" => "Данного типа диаграммы не существует из доступных: line, pie, scatter, k."
                ], 409),
            };
        } catch (\Exception) {
            return Response::json([
                "status" => "error",
                "message" => "Ошибка в обработке данных объекта Series или введено больше или меньше элементов для построения диаграммы."
            ], 500);
        }
    }
}
