<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute doit être accepté(e).',
    'active_url' => ':attribute n\'est pas une URL valide.',
    'after' => ':attribute doit être une date postérieure à :date.',
    'after_or_equal' => ':attribute doit être une date postérieure ou égale à :date.',
    'alpha' => ':attribute ne peut contenir que des lettres.',
    'alpha_dash' => ':attribute ne peut contenir que des lettres, des chiffres, des tirets et des underscores.',
    'alpha_num' => ':attribute ne peut contenir que des lettres et des chiffres.',
    'array' => ':attribute doit être un tableau.',
    'before' => ':attribute doit être une date antérieure à :date.',
    'before_or_equal' => ':attribute doit être une date antérieure ou égale à :date.',
    'between' => [
        'numeric' => ':attribute doit être compris entre :min et :max.',
        'file' => ':attribute doit avoir une taille entre :min et :max kilobytes.',
        'string' => ':attribute doit avoir entre :min et :max caractères.',
        'array' => ':attribute doit avoir entre :min et :max éléments.',
    ],
    'boolean' => ':attribute doit être vrai ou faux.',
    'confirmed' => 'La confirmation de :attribute ne correspond pas.',
    'date' => ':attribute n\'est pas une date valide.',
    'date_equals' => ':attribute doit être une date égale à :date.',
    'date_format' => ':attribute ne correspond pas au format :format.',
    'different' => ':attribute et :other doivent être différents.',
    'digits' => ':attribute doit avoir :digits chiffres.',
    'digits_between' => ':attribute doit avoir entre :min et :max chiffres.',
    'dimensions' => ':attribute a des dimensions d\'image invalides.',
    'distinct' => 'Le champ :attribute a une valeur en double.',
    'email' => ':attribute doit être une adresse e-mail valide.',
    'ends_with' => ':attribute doit se terminer par l\'un des éléments suivants : :values.',
    'exists' => ':attribute sélectionné(e) est invalide.',
    'file' => ':attribute doit être un fichier.',
    'filled' => 'Le champ :attribute doit avoir une valeur.',
    'gt' => [
        'numeric' => ':attribute doit être supérieur(e) à :value.',
        'file' => ':attribute doit avoir une taille supérieure à :value kilobytes.',
        'string' => ':attribute doit avoir plus de :value caractères.',
        'array' => ':attribute doit avoir plus de :value éléments.',
    ],
    'gte' => [
        'numeric' => ':attribute doit être supérieur(e) ou égal(e) à :value.',
        'file' => ':attribute doit avoir une taille supérieure ou égale à :value kilobytes.',
        'string' => ':attribute doit avoir au moins :value caractères.',
        'array' => ':attribute doit avoir :value éléments ou plus.',
    ],
    'image' => ':attribute doit être une image.',
    'in' => ':attribute sélectionné(e) est invalide.',
    'in_array' => 'Le champ :attribute n\'existe pas dans :other.',
    'integer' => ':attribute doit être un entier.',
    'ip' => ':attribute doit être une adresse IP valide.',
    'ipv4' => ':attribute doit être une adresse IPv4 valide.',
    'ipv6' => ':attribute doit être une adresse IPv6 valide.',
    'json' => ':attribute doit être une chaîne JSON valide.',
    'lt' => [
        'numeric' => ':attribute doit être inférieur(e) à :value.',
        'file' => ':attribute doit avoir une taille inférieure à :value kilobytes.',
        'string' => ':attribute doit avoir moins de :value caractères.',
        'array' => ':attribute doit avoir moins de :value éléments.',
    ],
    'lte' => [
        'numeric' => ':attribute doit être inférieur(e) ou égal(e) à :value.',
        'file' => ':attribute doit avoir une taille inférieure ou égale à :value kilobytes.',
        'string' => ':attribute doit avoir au plus :value caractères.',
        'array' => ':attribute ne doit pas avoir plus de :value éléments.',
    ],
    'max' => [
        'numeric' => ':attribute ne peut pas être supérieur(e) à :max.',
        'file' => ':attribute ne peut pas avoir une taille supérieure à :max kilobytes.',
        'string' => ':attribute ne peut pas avoir plus de :max caractères.',
        'array' => ':attribute ne peut pas avoir plus de :max éléments.',
    ],
    'mimes' => ':attribute doit être un fichier de type : :values.',
    'mimetypes' => ':attribute doit être un fichier de type : :values.',
    'min' => [
        'numeric' => ':attribute doit être au moins :min.',
        'file' => ':attribute doit avoir une taille d\'au moins :min kilobytes.',
        'string' => ':attribute doit avoir au moins :min caractères.',
        'array' => ':attribute doit avoir au moins :min éléments.',
    ],
    'not_in' => ':attribute sélectionné(e) est invalide.',
    'not_regex' => 'Le format de :attribute est invalide.',
    'numeric' => ':attribute doit être un nombre.',
    'password' => 'Le mot de passe est incorrect.',
    'present' => 'Le champ :attribute doit être présent.',
    'regex' => 'Le format de :attribute est invalide.',
    'required' => 'Le champ :attribute est obligatoire.',
    'required_if' => 'Le champ :attribute est obligatoire lorsque :other est :value.',
    'required_unless' => 'Le champ :attribute est obligatoire sauf si :other est dans :values.',
    'required_with' => 'Le champ :attribute est obligatoire lorsque :values est présent(e).',
    'required_with_all' => 'Le champ :attribute est obligatoire lorsque :values sont présents.',
    'required_without' => 'Le champ :attribute est obligatoire lorsque :values n\'est pas présent(e).',
    'required_without_all' => 'Le champ :attribute est obligatoire lorsque aucun(e) :values n\'est présent(e).',
    'same' => ':attribute et :other doivent correspondre.',
    'size' => [
        'numeric' => ':attribute doit être de :size.',
        'file' => ':attribute doit avoir une taille de :size kilobytes.',
        'string' => ':attribute doit avoir :size caractères.',
        'array' => ':attribute doit contenir :size éléments.',
    ],
    'starts_with' => ':attribute doit commencer par l\'un des éléments suivants : :values.',
    'string' => ':attribute doit être une chaîne de caractères.',
    'timezone' => ':attribute doit être un fuseau horaire valide.',
    'unique' => ':attribute a déjà été pris(e).',
    'uploaded' => 'Le fichier :attribute n\'a pas pu être téléchargé.',
    'url' => 'Le format de :attribute est invalide.',
    'uuid' => ':attribute doit être un UUID valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'message personnalisé',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],
];
