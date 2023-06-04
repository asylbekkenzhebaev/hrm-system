<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'department_id', 'employee_id'];

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
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

        $query->when(request('department_id'), function (Builder $q) {
            $q->where("{$this->getTable()}.department_id", '=', request('department_id'));
        });


        $query->when(request('employee_id'), function (Builder $q) {
            if (request('vacancy')) {
                $q->whereNull("{$this->getTable()}.employee_id");
            } else {
                $q->where("{$this->getTable()}.employee_id", '=', request('employee_id'));
            }
        });
    }
}
