<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DropdownOption extends Model
{
    use BaseModel, HasFactory;

    protected $fillable = [
        'value',
        'name',
        'name_pl',
        'name_de',
        'name_pt',
        'name_es',
        'name_fr',
        'name_it',
        'type',
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
}
