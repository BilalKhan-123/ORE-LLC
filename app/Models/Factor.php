<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Factor extends Model
{
    use BaseModel, HasFactory;

    protected $fillable = [
        'name',
        'type',
        'response',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    protected $relationship = [];

    public function factor1_questions()
    {
        return $this->hasMany(Question::class, 'factor1_id', 'id');
    }

    public function factor2_questions()
    {
        return $this->hasMany(Question::class, 'factor2_id', 'id');
    }

    public function getResultColumn()
    {
        return preg_replace('/[- ]/', '_', strtolower($this->name));
    }
}
