<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class Transformer extends TransformerAbstract{

    public function convertDBDateTimeToBRDate($date){
        return !empty($date) ? $format = Carbon::createFromFormat('Y-m-d H:i:s',trim($date))->format('d/m/Y') : $format = '';
    }

    public function convertDBDateToBRDate($date){
        return !empty($date) ? $format = Carbon::createFromFormat('Y-m-d', trim($date))->format('d/m/Y') : $format = '';
    }

    public function formatSala($date){
        return !empty($date) ? $format = Carbon::createFromFormat('Y-m-d H:m:s', trim($date))->format('d/m/Y à\\s H:i\\h') : $format = '';
    }
}App\Criterias\CriteriaInterface