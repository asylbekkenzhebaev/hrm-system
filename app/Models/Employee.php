<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
