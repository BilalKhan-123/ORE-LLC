<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use BaseModel, HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    protected $relationship = [];

    public $allowedSorts = ['name'];
}
