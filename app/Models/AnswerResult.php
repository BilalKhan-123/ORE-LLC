<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerResult extends Model
{
    use BaseModel, HasFactory , SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'answer_id',
        'factor_id',
        'result',
        'response',
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    protected $relationship = [];

    /**
     * Model relationship's
     */
    public function factor()
    {
        return $this->belongsTo(Factor::class, 'factor_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
}
