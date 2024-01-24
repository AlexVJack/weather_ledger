<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

    // this can probably be rewritten to the simple and clear version if we will use Country model
    // for the speed question, I would probably use this, working solution
    public function scopeHighestSalaryPerCountry(Builder $query)
    {
        $sub = self::select('country', DB::raw('MAX(salary) as max_salary'))
            ->groupBy('country');

        return $query->from(DB::raw("({$sub->toSql()}) as sub"))
            ->mergeBindings($sub->getQuery())
            ->join('employees', function ($join) {
                $join->on('employees.country', '=', 'sub.country')
                    ->on('employees.salary', '=', 'sub.max_salary');
            });
    }
}
