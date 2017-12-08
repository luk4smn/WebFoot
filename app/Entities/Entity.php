<?php

namespace App\Entities;

use App\Support\Convert;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


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


}
