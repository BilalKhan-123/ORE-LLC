<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContactMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'email',
        'subject',
        'message',
        'is_responded',
        'responded_at',
        'responded_by',
        'is_show',
        'status',
        'ip_address',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_show', 1)->orderBy('created_at', 'desc');
    }

    // protected static function boot() { 
    //     parent::boot(); 
        
    //     static::creating(function ($model) { 
    //         $model->added_by = auth()->id(); 
    //         }); 
        
    //     static::updating(function ($model) { 
    //         $model->updated_by = auth()->id(); 
    //         }); 
    // }
}
