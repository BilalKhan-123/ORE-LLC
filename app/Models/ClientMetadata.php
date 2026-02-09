<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientMetadata extends Model
{
    use BaseModel, HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'conducted_cci_count',
        'total_cci_count',
        'conducted_glycan_count',
        'total_glycan_count',
        'total_cci_plus_count',
        'conducted_cci_plus_count',
        'total_cci_consultation_count',
        'conducted_cci_consultation_count',
        'number_of_participants',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    protected $relationship = [];

    /**
     * Model's Accessor & Mutator
     */
    protected function remainingCciCount(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['total_cci_count'] - $attributes['conducted_cci_count'],
        );
    }

    protected function remainingCciGlycanCount(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['total_glycan_count'] - $attributes['conducted_glycan_count'],
        );
    }

    protected function remainingCciPlusCount(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['total_cci_plus_count'] - $attributes['conducted_cci_plus_count'],
        );
    }

    protected function remainingCciConsultationCount(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['total_cci_consultation_count'] - $attributes['conducted_cci_consultation_count'],
        );
    }
}
