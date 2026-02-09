<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\BaseModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use BaseModel, HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'age_group_id',
        'exam_type',
        'start_at',
        'completed_at',
        'score',
        'time_taken',
        'timezone',
        'question1_answer_id',
        'question2_answer_id',
        'question3_answer_id',
        'question4_answer_id',
        'question5_answer_id',
        'question6_answer_id',
        'question7_answer_id',
        'question8_answer_id',
        'question9_answer_id',
        'question10_answer_id',
        'question11_answer_id',
        'question12_answer_id',
        'question13_answer_id',
        'question14_answer_id',
        'question15_answer_id',
        'question16_answer_id',
        'question17_answer_id',
        'question18_answer_id',
        'question19_answer_id',
        'question20_answer_id',
        'question21_answer_id',
        'question22_answer_id',
        'question23_answer_id',
        'question24_answer_id',
        'question25_answer_id',
        'question26_answer_id',
        'question27_answer_id',
        'question28_answer_id',
        'question29_answer_id',
        'question30_answer_id',
        'question31_answer_id',
        'question32_answer_id',
        'question33_answer_id',
        'question34_answer_id',
        'question35_answer_id',
        'question36_answer_id',
        'question37_answer_id',
        'question38_answer_id',
        'question39_answer_id',
        'question40_answer_id',
        'question41_answer_id',
        'question42_answer_id',
        'question43_answer_id',
        'question44_answer_id',
        'question45_answer_id',
        'question46_answer_id',
        'question47_answer_id',
        'question48_answer_id',
        'question49_answer_id',
        'question50_answer_id',
        'question51_answer_id',
        'question52_answer_id',
        'question53_answer_id',
        'question54_answer_id',
        'question55_answer_id',
        'question56_answer_id',
        'question57_answer_id',
        'question58_answer_id',
        'question59_answer_id',
        'question60_answer_id',
        'question1_time_taken',
        'question2_time_taken',
        'question3_time_taken',
        'question4_time_taken',
        'question5_time_taken',
        'question6_time_taken',
        'question7_time_taken',
        'question8_time_taken',
        'question9_time_taken',
        'question10_time_taken',
        'question11_time_taken',
        'question12_time_taken',
        'question13_time_taken',
        'question14_time_taken',
        'question15_time_taken',
        'question16_time_taken',
        'question17_time_taken',
        'question18_time_taken',
        'question19_time_taken',
        'question20_time_taken',
        'question21_time_taken',
        'question22_time_taken',
        'question23_time_taken',
        'question24_time_taken',
        'question25_time_taken',
        'question26_time_taken',
        'question27_time_taken',
        'question28_time_taken',
        'question29_time_taken',
        'question30_time_taken',
        'question31_time_taken',
        'question32_time_taken',
        'question33_time_taken',
        'question34_time_taken',
        'question35_time_taken',
        'question36_time_taken',
        'question37_time_taken',
        'question38_time_taken',
        'question39_time_taken',
        'question40_time_taken',
        'question41_time_taken',
        'question42_time_taken',
        'question43_time_taken',
        'question44_time_taken',
        'question45_time_taken',
        'question46_time_taken',
        'question47_time_taken',
        'question48_time_taken',
        'question49_time_taken',
        'question50_time_taken',
        'question51_time_taken',
        'question52_time_taken',
        'question53_time_taken',
        'question54_time_taken',
        'question55_time_taken',
        'question56_time_taken',
        'question57_time_taken',
        'question58_time_taken',
        'question59_time_taken',
        'question60_time_taken',
        'response',
        'created_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_at' => 'timestamp',
        'completed_at' => 'timestamp',
        'created_at' => 'timestamp',
    ];

    protected $relationship = [
        'user' => [
            'model' => User::class,
        ],
        'answerResult' => [
            'model' => AnswerResult::class,
        ],
    ];

    public $queryable = [
        'id',
    ];

    protected $exactFilters = [];

    public $allowedSorts = ['id'];

    protected $scopedFilters = [
        'user_id',
        'start_date',
        'end_date',
        'search',
    ];

    /**
     * Model Scope filter's
     */
    public function scopeUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeStartDate($query, ...$params)
    {
        if (count($params) == 1) {
            $startDate = Carbon::parse(Carbon::createFromTimestamp((int) $params[0])->format('Y-m-d') . ' 00:00:00')->format('Y-m-d H:i:s');
        } else {
            $startDate = Carbon::parse(Carbon::createFromTimestamp((int) $params[0], $params[1])->format('Y-m-d') . ' 00:00:00', $params[1])->setTimezone(config('site.timezone'))->format('Y-m-d H:i:s');
        }

        return $query->where('created_at', '>=', $startDate);
    }

    public function scopeEndDate($query, ...$params)
    {
        if (count($params) == 1) {
            $endDate = Carbon::parse(Carbon::createFromTimestamp((int) $params[0])->format('Y-m-d') . ' 23:59:59')->format('Y-m-d H:i:s');
        } else {
            $endDate = Carbon::parse(Carbon::createFromTimestamp((int) $params[0], $params[1])->format('Y-m-d') . ' 23:59:59', $params[1])->setTimezone(config('site.timezone'))->format('Y-m-d H:i:s');
        }

        return $query->where('created_at', '<=', $endDate);
    }

    public function scopeSearch($query, $search)
    {
        $query->whereHas('user', function ($qry) use ($search) {
            $qry->whereRaw("CONCAT_WS(' ', `first_name`, `last_name`) LIKE '%$search%'")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('mobile_no', 'LIKE', "%{$search}%");
        });
    }

    /**
     * Model Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checkPermission()
    {
        if (Auth::user()->hasRole(config('site.roles.client'))) {
            return $this->user->client_id == Auth::id() ? true : false;
        } elseif (Auth::user()->hasRole(config('site.roles.user'))) {
            return $this->user_id == Auth::id() ? true : false;
        } else {
            return true;
        }
    }

    public function answerResult()
    {
        return $this->hasMany(AnswerResult::class, 'answer_id');
    }
}
