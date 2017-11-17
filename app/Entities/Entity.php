<?php

namespace App\Entities;

use App\Criterias\CriteriaInterface;
use App\Support\Convert;
use App\Traits\Searchable;
use App\Transformers\Transformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Html\Builder;

class Entity extends Model
{
    use Searchable, SoftDeletes;

    protected $convert = [];

    protected $appends = ['presentation'];

    public function getPresentationAttribute(){
        return
            $this->attributes['nome'] ??
            $this->attributes['razao_social'] ??
            $this->attributes['descricao'] ??
            $this->attributes['id'] ??
            '';
    }

    public function setPresentAttribute($value){
        $this->attributes['presentation'] = $value;
    }

    public function setAttribute($key, $value){
        if (isset($this->convert[$key]) && $this->convert[$key]) {
            $type = $this->convert[$key];

            if ($type == 'date') {
                $this->attributes[$key] = Convert::dateToDBFormat($value);
            }

            if ($type == 'datetime') {
                $this->attributes[$key] = Convert::dateTimeToDBFormat($value);
            }

            if ($type == 'money') {
                $this->attributes[$key] = Convert::moneyToDecimal($value);
            }

            if ($type == 'fone') {
                $this->attributes[$key] = $value;
            }

            if ($type == 'volume') {
                $this->attributes[$key] = Convert::volumeToDecimal($value);
            }
            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    public function getAttribute($key){
        if (isset($this->convert[$key]) && $this->convert[$key]) {
            $type = $this->convert[$key];

            if ($type == 'date') {
                if($this->attributes[$key] ?? false)
                    return Convert::DBToCarbonFormat($this->attributes[$key]);
            }

            if ($type == 'money') {
                if($this->attributes[$key] ?? false)
                    return Convert::decimalToMoney($this->attributes[$key]);
            }
        }

        return parent::getAttribute($key);
    }

    public static function syncHasManyRelation($model, $relation, $field, $array){
        $fill = collect($array ?? [])->map(function ($item) {
            return $item;
        })->toArray();

        $model->{$relation}()->whereIn($field, array_pluck($array ?? [], $field))->delete();

        $model->{$relation}()->createMany($fill);

        $model->{$relation}()->whereNotIn($field, array_pluck($array ?? [], $field))->delete();
    }

    public function setDataTable(CriteriaInterface $criteria, Transformer $transformer){
        if(!$transformer instanceof Transformer)
            throw new \Exception('O transformer passado não é da instância Transformer (App\Transformer)');

        if(!$criteria instanceof CriteriaInterface)
            throw new \Exception('A criteria passada não é da instância Criteria (App\Criteria)');

        return Datatables::of($criteria->apply())
            ->setTransformer(new $transformer)
            ->make(true);
    }

    public function setDataTableColumns($columns){
        return app(Builder::class)
            ->columns($columns)
            ->parameters([
                'language' => [
                    'search' => '<span>Busca:</span> _INPUT_',
                    'paginate' =>  ['first' => 'Primeiro', 'last' => 'Último', 'next' => '&rarr;', 'previous' => '&larr;'],
                    'sInfo' => "&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMostrando de _START_ até _END_ de _TOTAL_ registros",
                    'sZeroRecords' => "Nenhum registro encontrado",
                    'sInfoEmpty' => "&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMostrando 0 até 0 de 0 registros",
                    'sEmptyTable' => "Nenhum registro encontrado",
                    "processing" => "Carregando...",
                    'buttons' => [
                        'copy' => 'Copiar',
                        'copyTitle' => 'Copiando Registros',
                        'copySuccess' => [
                            '1' => "Copiando..",
                            '_' => "Copiando %d registros da página"
                        ],
                    ],
                ],
                'searching' => true,
                "bLengthChange" =>    false,
                'dom' => '<"pull-right"B>lfrtip',
                'buttons' => [
                    [
                        'extend' => 'copyHtml5',
                        'text' => '<i class="icon-copy3 position-left"></i> Copiar',
                        'className' => 'btn btn-default',
                        'exportOptions' => [
                            'columns' => [0, ':visible']
                        ]

                    ],
                    [
                        'extend' => 'excelHtml5',
                        'text' => '<i class="icon-file-excel position-left"></i> Excel',
                        'className' => 'btn btn-default',
                        'exportOptions' => [
                            'columns' => [0, ':visible']
                        ]

                    ],
                    [
                        'extend' => 'pdfHtml5',
                        'text' => '<i class="icon-file-pdf position-left"></i> PDF',
                        'className' => 'btn btn-default',
                        'exportOptions' => [
                            'columns' => [0, ':visible']
                        ]

                    ],
                    [
                        'extend' => 'colvis',
                        'text' => '<i class="icon-three-bars"></i> <span class="caret"></span>',
                        'className' => 'btn btn-default'
                    ]
                ]
            ]);
    }
}
