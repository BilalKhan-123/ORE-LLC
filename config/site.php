<?php

return [
    'master_password' => env('SITE_MASTER_PASSWORD', '7$pan@2015'),
    'otpExpirationTimeInMinutes' => '10',
    'siteTitle' => env('SITE_TITLE', 'Optimus Revenue Expert LLC'),
    'generateOtpLength' => '6',
    'roles' => [
        'admin' => 'admin',
        'client' => 'client',
        'user' => 'user',
    ],
    'frontWebsiteUrl' => env('FRONT_WEBSITE_URL', 'http://127.0.0.1:8000'),
    'participantWebsiteUrl' => env('PARTICIPANT_WEBSITE_URL', 'http://127.0.0.1:8000'),
    'gender' => [
        'male',
        'female',
        'prefer_not_to_say',
    ],
    'race' => [
        'white',
        'black',
        'asian',
        'other',
    ],
    'education' => [
        'elementary',
        'secondary',
        'college_university',
    ],
    'general_health' => [
        'good',
        'average',
        'poor',
    ],
    'outlook_on_life' => [
        'optimist',
        'pessimist',
        'undecided',
    ],
    'user_status' => [
        'active' => 'active',
        'inactive' => 'inactive',
    ],
    'user_form' => [
        'option' => [
            'ethnic_group' => 'ethnic_group',
            'major_illness' => 'major_illness',
        ],
    ],
    'age_verified_by' => [
        'passport',
        'driver_license',
        'family_records',
        'government_id',
    ],
    'marital_status' => [
        'single',
        'married',
        'divorced',
        'widowed',
    ],
    'living_status' => [
        'living_alone',
        'living_with_family',
        'assisted_care',
    ],
    'state_of_health' => [
        'poor',
        'moderate',
        'good',
        'excellent',
    ],
    'password' => [
        'regex' => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).*$/",
    ],
    'test_results' => [
        'time' => [
            'min' => -34,
            'max' => 119,
        ],
        'self_valuation' => [
            'min' => -44,
            'max' => 154,
        ],
        'aging' => [
            'min' => -26,
            'max' => 91,
        ],
        'health' => [
            'min' => -16,
            'max' => 56,
        ],
        'curiosity' => [
            'min' => -62,
            'max' => 217,
        ],
        'gratitude' => [
            'min' => -18,
            'max' => 63,
        ],
        'generosity' => [
            'min' => -12,
            'max' => 42,
        ],
        'admiration' => [
            'min' => -28,
            'max' => 98,
        ],
    ],
    'question_mode' => [
        'forward' => 'forward',
        'backward' => 'backward',
    ],
    'support' => [
        'email' => 'support@longevity.com',
    ],
    'user_language' => [
        'en',
        'pl',
        'de',
        'pt',
        'es',
        'fr',
        'it',
    ],
    'emails' => [
        'verify_email_link_expired_in' => 120,
        'reset_password_email_expired_in' => 120,
    ],
    'format' => [
        'date' => 'm/d/Y',
        'date_time' => 'm/d/Y g:i A',
    ],
    'payment_status' => [
        'paid' => 'PAID',
        'failed' => 'FAILED',
        'pending' => 'PENDING',
        'canceled' => 'CANCELED',
        'overdue' => 'OVERDUE',
        'reversed' => 'REVERSED',
        'rejected' => 'REJECTED',
        'manual' => 'MANUAL',
        'refunded' => 'REFUNDED',
        'settled' => 'SETTLED',
        'expired' => 'EXPIRED',
        'partial' => 'PARTIAL',
    ],
    'exam' => [
        'exam_type' => [
            'cci' => 'cci',
            'cci_glycan_age' => 'cci_glycan_age',
            'cci_plus' => 'cci_plus',
            'cci_consultation' => 'cci_consultation',
        ],
        'plan' => [
            'cci' => 'CCI',
            'cci_glycan_age' => 'CCI + GlycanAge',
            'cci_plus' => 'CCI +',
            'cci_consultation' => 'CCI Consultation',
        ],
        'type' => [
            'free' => 'free',
            'paid' => 'Paid',
        ],
        'client_payments' => [
            'min_quantity' => 1,
            'max_quantity' => 999,
        ],
    ],
    'stripe' => [
        'items_payment_for' => 'purchase_plan',
        'payment_status' => [
            'paid' => 'paid',
            'failed' => 'failed',
        ],
    ],
];
