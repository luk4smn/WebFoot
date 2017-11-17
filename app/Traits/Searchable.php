<?php

namespace App\Traits;

use App\Interfaces\SearchableInterfaces;
use Illuminate\Database\Eloquent\Builder;

trait Searchable {

    protected $searchable = [];

    public function scopeSearch(Builder $query, $search, array $params = []) {
        if(isset($params['customSearch'])){
            $this->applySearchByRequestFields($query, $search, $params);
            return;
        }

        $query->where(function($query) use($search, $params) {
            if(isset($params['fields'])){
                $fields = explode(",", $params['fields']);
            } else {
                $fields = $this->searchable;
            }

            $fieldsForSearch = $this->prepareFieldsForSearch($fields, $search);

            foreach ($fieldsForSearch as $where){
                $this->applyConditions($query, $where['field'], $where['condition'], $where['search'], SearchableInterfaces::WHERE_CONDITIONS_AND);
            }
        });
    }

    private function prepareFieldsForSearch($fields, $search = null) : array {
        $wheres = [];

        foreach ($fields as $field => $condition) {
            if (is_integer($field)) {
                $field = $condition;
                $condition = SearchableInterfaces::CONDITION_EQUAL;
            }

            if(strstr($field, ':')){
                $fieldWithCondition = explode(':', $field);
                $field = $fieldWithCondition[0];
                $condition = $fieldWithCondition[1];

                if(!empty($fieldWithCondition[2])){
                    $search = $fieldWithCondition[2];
                }

                if(!empty($fieldWithCondition[3])){
                    $whereCondition = $fieldWithCondition[3];
                }
            }

            if($condition == SearchableInterfaces::CONDITION_IN || $condition == SearchableInterfaces::CONDITION_NOT_IN){
                $search = explode('-', $search);
            }

            if($condition == SearchableInterfaces::CONDITION_LIKE){
                $search = "%$search%";
            }

            $wheres[] = [
                'field' => $field,
                'condition' => $condition,
                'search' => $search,
                'whereCondition' => $whereCondition ?? SearchableInterfaces::WHERE_CONDITIONS_AND
            ];
        }

        return $wheres;
    }

    private function applyConditions(Builder &$query, $field, $fieldCondition, $search, $whereConditions = SearchableInterfaces::WHERE_CONDITIONS_AND){
        if(!$search){
            return;
        }

        if($whereConditions == SearchableInterfaces::WHERE_CONDITIONS_OR){
            if ($fieldCondition == SearchableInterfaces::CONDITION_IN) {
                $query->orWhereIn($field, $search);
            } else if ($fieldCondition == SearchableInterfaces::CONDITION_NOT_IN) {
                $query->orWhereNotIn($field, $search);
            } else {
                $query->orWhere($field, $fieldCondition, "$search");
            }
        }

        if($whereConditions == SearchableInterfaces::WHERE_CONDITIONS_AND){
            if ($fieldCondition == SearchableInterfaces::CONDITION_IN) {
                $query->whereIn($field, $search);
            } else if ($fieldCondition == SearchableInterfaces::CONDITION_NOT_IN) {
                $query->whereNotIn($field, $search);
            } else {
                $query->where($field, $fieldCondition, "$search");
            }
        }
    }

    private function applySearchByRequestFields(Builder &$builder, $search, array $params){
        if(isset($params['fields'])){
//            $whereConditions = SearchableInterfaces::WHERE_CONDITIONS_AND;
//
//            if(isset($params['whereConditions'])){
//                $whereConditions = $params['whereConditions'];
//            }

            $fields = explode(',', $params['fields']);
            $relationsApplied = [];

            $builder->where(function($builder) use($fields, $search, &$relationsApplied) {
                $fieldsSearchble = $this->prepareFieldsForSearch($fields, $search);

                foreach ($fieldsSearchble as $where){
                    if(strstr($where['field'], '.')){
                        $this->applyWhereHasWithConditions($builder, $where['field'], $where);

                    } else {
                        $this->applyConditions($builder, $where['field'], $where['condition'], $where['search'], $where['whereCondition']);
                    }
                }
            });
        }
    }

    private function applyWhereHasWithConditions(Builder &$builder, $field, array $where){
        $relationPos = strrpos($field, '.');
        $relation = substr($field, 0, $relationPos);
        $relationField = substr($field, $relationPos + 1, strlen($field));

        if($where['whereCondition'] == SearchableInterfaces::WHERE_CONDITIONS_OR){
            $builder->orWhereHas($relation, function($query) use($field, $relationField, $where){
                $this->applyConditions(
                    $query,
                    $relationField,
                    $where['condition'],
                    $where['search'],
                    SearchableInterfaces::WHERE_CONDITIONS_AND
                );
            });
        } else {
            $builder->whereHas($relation, function($query) use($field, $relationField, $where){
                $this->applyConditions(
                    $query,
                    $relationField,
                    $where['condition'],
                    $where['search'],
                    SearchableInterfaces::WHERE_CONDITIONS_AND
                );
            });
        }

    }

}