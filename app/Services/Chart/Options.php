<?php

namespace App\Services\Chart;

abstract class Options
{
    protected string $type;
    private array $data;

    public function setData($data)
    {
       $this->data = (array) $data;
    }

    public function getData(): array|string
    {
        return empty($this->data) ? $this->type = 'value' : $this->data;
    }
}
