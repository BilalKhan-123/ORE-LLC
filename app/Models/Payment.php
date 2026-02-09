<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use BaseModel, HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'checkout_session_id',
        'payment_intent_id',
        'exam_type',
        'transaction_id',
        'quantity',
        'discount_amount',
        'amount',
        'payment_by',
        'invoice_id',
        'invoice_date',
        'invoice_number',
        'invoice_url',
        'discount_id',
        'coupon_code_id',
        'coupon_code',
        'promotion_code_id',
        'promotion_code',
        'amount_off',
        'percent_off',
        'status',
        'description',
        'response',
        'created_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'invoice_date' => 'timestamp',
        'created_at' => 'timestamp',
    ];

    protected $hidden = [
        'response',
        'updated_at',
        'deleted_at',
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    protected $relationship = [
        'user' => [
            'model' => User::class,
        ],
        'user.country' => [
            'model' => Country::class,
        ],
        'user.state' => [
            'model' => State::class,
        ],
    ];

    /**
     * Model Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Model Scope filter's
     */
    public function scopeUserId($query, $userId)
    {
        return ! empty($userId) ? $query->where('client_id', $userId) : '';
    }

    public function scopeExamType(object $query, string $value)
    {
        $examType = '';
        if ($value == config('site.exam.exam_type.cci')) {
            $examType = 'CCI';
        } elseif ($value == config('site.exam.exam_type.cci_glycan_age')) {
            $examType = 'CCI with Glycanage';
        } elseif ($value == config('site.exam.exam_type.cci_plus')) {
            $examType = 'CCI +';
        } elseif ($value == config('site.exam.exam_type.cci_consultation')) {
            $examType = 'CCI Consultation';
        }

        return $query->where('exam_type', $examType);
    }
}
