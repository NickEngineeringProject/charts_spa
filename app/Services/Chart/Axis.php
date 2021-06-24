<?php

namespace App\Services\Chart;

use stdClass;

abstract class Axis
{
    public function labels($data): stdClass
    {
        $axis = new stdClass();

        if (!empty($data)) {
            is_array($data)
                ? $axis->data = $data
                : $axis->data = explode(',', str_replace(' ', '', $data));
            $axis->type = 'category';
        } else { $axis->type = 'value'; }

        return $axis;
    }
}
