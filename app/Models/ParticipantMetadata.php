<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParticipantMetadata extends Model
{
    use BaseModel, HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'plan_type',
        'purchased_exam_count',
        'conducted_exam_count',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $queryable = [
        'id',
    ];

    protected $appends = ['remaining_exam_count'];

    protected $exactFilters = [];

    protected $relationship = [];

    /**
     * Model accessors & mutators
     */
    protected function remainingExamCount(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['purchased_exam_count'] - $attributes['conducted_exam_count'],
        );
    }
}
