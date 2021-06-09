<?php

namespace App\Services\Chart;

use stdClass;

class Axis
{
    private stdClass $axis;

    public function setAxis($data)
    {
        $axis = $this->axis = new stdClass();

        $axis->type = 'category';

        is_array($data)
            ? $axis->data = $data
            : $axis->data = explode(',', str_replace(' ', '', $data));

        if (empty($data)) { unset($axis->data); $axis->type = 'value'; }
    }

    public function getAxis(): stdClass
    {
        return $this->axis;
    }
}
