<?php


namespace App\Scopes;


use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class orderScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
       $builder->orderBy(DB::raw('ISNULL(`sort_number`), `sort_number`'), 'asc');
    }
}
