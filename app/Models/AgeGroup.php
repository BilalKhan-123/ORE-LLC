<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgeGroup extends Model
{
    use BaseModel, HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'min_age',
        'max_age',
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    protected $relationship = [];
}
