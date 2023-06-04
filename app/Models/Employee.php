<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['fio', 'birthday', 'gender_id'];

    /**
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function position()
    {
        return $this->hasOne(Position::class);
    }

    /**
     * @return BelongsTo
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeFilter(Builder $query): void
    {
        $query->when(request('id'), function (Builder $q) {
            $q->where("{$this->getTable()}.id", '=', request('id'));
        });

        $query->when(request('name'), function (Builder $q) {
            $q->where("{$this->getTable()}.name", 'LIKE', '%' . request('name') . '%');
        });

        $departmentEmployees = DB::table('positions')
            ->select('employee_id')
            ->whereNotNull('employee_id')
            ->where('positions.department_id', '=', request('department_id'));

        $query->when(request('department_id'), function (Builder $q) use ($departmentEmployees) {
            $q->whereIn("{$this->getTable()}.id", $departmentEmployees);
        });

        $positionEmployees = DB::table('positions')
            ->select('employee_id')
            ->whereNotNull('employee_id')
            ->where('positions.id', '=', request('position_id'));

        $query->when(request('position_id'), function (Builder $q) use ($positionEmployees) {
            $q->whereIn("{$this->getTable()}.id", $positionEmployees);
        });

        $query->when(request('gender_id'), function (Builder $q) {
            $q->where("{$this->getTable()}.gender_id", '=', request('gender_id'));
        });
    }
}
