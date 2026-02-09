<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FactorExplanationConfig extends Model
{
    use BaseModel, HasFactory;

    protected $table = "factor_explanation_configs";

    protected $fillable = [
        'factor',
        'language',
        'name',
        'score_label',
        'high_score',
        'low_score',
        'high_score_suggestion',
        'low_score_suggestion',
        'personal_profile_summary',
        'main_summary_text_for_table',
        'sub_summary_text_for_table',
        'main_summary_text_for_individual', 	
        'sub_summary_text_for_individual',
        'profile_summary_text_for_individual',
        'created_at',
    ];

    protected $casts = [   
        'created_at','updated_at'
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    protected $relationship = [
        //
    ];


}
