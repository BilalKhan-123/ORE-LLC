<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\BaseModel;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use BaseModel, HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;

    public static $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'status',
        'client_id',
        'email',
        'password',
        'mobile_no',
        'address',
        'participants_limit',
        'email_verified_at',
        'client_code',
        'allow_multiple_attempts',
        'birth_of_country_id',
        'birth_of_city',
        'birth_of_state_id',
        'zipcode',
        'birthdate',
        'age_verified_by',
        'gender',
        'marital_status',
        'describe_you_text',
        'education',
        'living_status',
        'feel_age',
        'state_of_health',
        'current_major_illness_text',
        'language',
        'chronological_age',
        'chronological_age_range',
        '_chronological_age_array',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $dates = ['created_at'];

    public $queryable = [
        'id',
    ];

    protected $relationship = [
        'client' => [
            'model' => 'App\\Models\\User',
        ],
        'describes' => [
            'model' => 'App\\Models\\UserDescribe',
        ],
        'majorIllnesses' => [
            'model' => 'App\\Models\\UserMajorIllness',
        ],
        'purchasedExams' => [
            'model' => 'App\\Models\\Payment',
        ],
        'clientMetadata' => [
            'model' => 'App\\Models\\ClientMetadata',
        ],
        'country' => [
            'model' => 'App\\Models\\Country',
        ],
        'state' => [
            'model' => 'App\\Models\\State',
        ],
    ];

    protected $scopedFilters = ['client_id', 'search', 'status'];

    protected $appends = ['role', 'full_name'];

    public $allowedSorts = ['id', 'first_name'];

    /**
     * Accessor & Mutator
     */
    public function getFullNameAttribute() // notice that the attribute name is in CamelCase.
    {return $this->first_name . ' ' . $this->last_name;
    }

    protected function allowMultipleAttempts(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => 1
        );
    }

    protected function eligibleForCCi(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $metadata = $this->client->clientMetadata;
                $isTest = false;
                if (! empty($metadata)) {
                    if ($metadata->total_cci_count > $metadata->conducted_cci_count) {
                        $isTest = true;
                    }
                }

                return $isTest;
            }
        );
    }

    protected function eligibleForCciGlycan(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $metadata = $this->client->clientMetadata;
                $isTest = false;
                if (! empty($metadata)) {
                    if ($metadata->total_glycan_count > $metadata->conducted_glycan_count) {
                        $isTest = true;
                    }
                }

                return $isTest;
            }
        );
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Model Scope filter's
     */
    public function scopeClientId($query, $clientId)
    {
        return ! empty($clientId) ? $query->where('client_id', $clientId) : $query->whereNull('client_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->whereRaw("CONCAT_WS(' ', `first_name`, `last_name`) LIKE '%$search%'")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('mobile_no', 'like', "%$search%");
        });
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', (! empty($status) ? $status : config('site.user_status.active')));
    }

    public function hasAcccessManageClientStatus()
    {
        return auth()->user()->hasRole(config('site.roles.admin')) ? true : false;
    }

    public function hasAcccessManageParticipantStatus()
    {
        return auth()->user()->hasRole([config('site.roles.admin'), config('site.roles.client')]) ? true : false;
    }

    public function getRoleAttribute()
    {
        if (! empty($this->roles)) {
            return $this->roles->first()->only(['id', 'name']);
        }
    }

    public function isFirstAttempt()
    {
        $answer = Answer::where('user_id', $this->id)->first();

        return empty($answer) ? true : false;
    }

    /**
     * Model relatinship's
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id')->select('id', 'first_name', 'last_name', 'client_code');
    }

    public function participants()
    {
        return $this->hasMany(User::class, 'client_id')->select('id', 'first_name', 'last_name', 'client_code');
    }

    public function describes()
    {
        return $this->belongsToMany(DropdownOption::class, 'user_describes');
    }

    public function majorIllnesses()
    {
        return $this->belongsToMany(DropdownOption::class, 'user_major_illnesses');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'user_id');
    }

    public function firstAnswer()
    {
        return $this->hasOne(Answer::class, 'user_id')->orderBy('id');
    }

    public function answerLatest()
    {
        return $this->hasOne(Answer::class, 'user_id')->orderBy('id', 'DESC');
    }

    public function purchasedExams()
    {
        return $this->hasMany(Payment::class, 'user_id')->where('payment_by', config('site.roles.admin'));
    }

    public function clientMetadata()
    {
        return $this->hasOne(ClientMetadata::class, 'client_id');
    }

    public function participantMetadata()
    {
        return $this->hasMany(ParticipantMetadata::class, 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'birth_of_country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'birth_of_state_id');
    }

    public function userDescribe()
    {
        return $this->hasMany(UserDescribe::class, 'user_id');
    }

    public function userMajorIllness()
    {
        return $this->hasMany(UserMajorIllness::class, 'user_id');
    }

    /**
     * Custom method's
     */
    public function getParticipantMetadata(string $planType = '')
    {
        $types = [
            config('site.exam.exam_type.cci'),
            config('site.exam.exam_type.cci_plus'),
            config('site.exam.exam_type.cci_consultation'),
        ];

        $default = [
            'purchased_exam_count' => 0,
            'remaining_exam_count' => 0,
            'conducted_exam_count' => 0,
            'is_exam_available' => false,
        ];

        $result = [];
        $metadata = $this->participantMetadata();
        if (! empty($planType)) {
            $types = array_filter($types, function ($type) use ($planType) {
                return $type === $planType;
            });
            $metadata = $metadata->where('plan_type', $planType);
        }
        $metadata = $metadata->get();
        foreach ($types as $type) {
            $data = $metadata->firstWhere('plan_type', $type)?->toArray() ?? $default;
            $result[] = array_merge([
                'plan_type' => $type,
                'id' => $data['id'] ?? null,
                'remaining_exam_count' => $data['remaining_exam_count'] ?? 0,
                'is_exam_available' => ($data['remaining_exam_count'] > 0) ? true : false,
            ], (array) $data);
        }

        if (! empty($planType)) {
            return $result[0] ?? null;
        }

        return $result;
    }
}
