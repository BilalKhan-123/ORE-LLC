<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDescribe extends Model
{
    use BaseModel, HasFactory , SoftDeletes;

    protected $fillable = [
        'user_id',
        'dropdown_option_id',
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    protected $relationship = [];
}
