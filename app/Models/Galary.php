<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galary extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'main_image',
        'is_show',
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
