<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use BaseModel, HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'country_id',
        'name',
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    protected $relationship = [];

    public $allowedSorts = ['name'];
}
