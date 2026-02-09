<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use BaseModel, HasFactory;

    protected $fillable = [
        'label',
        'label_pl',
        'label_de',
        'label_pt',
        'label_es',
        'label_fr',
        'label_it',
        'factor1_id',
        'factor2_id',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    protected $relationship = [
        //
    ];
}
