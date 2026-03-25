<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'sub_title',
        'description',
        'is_featured',
        'is_show',
        'main_image',
        'logo',
        'all_text',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_show', 1)->orderBy('created_at', 'desc');
    }

    protected static function boot() { 
        parent::boot(); 
        
        static::creating(function ($model) { 
            $model->added_by = auth()->id(); 
            }); 
        
        static::updating(function ($model) { 
            $model->updated_by = auth()->id(); 
            }); 
    }
}
