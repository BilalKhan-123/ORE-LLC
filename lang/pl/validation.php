<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Wiersze tłumaczeń walidacji
    |--------------------------------------------------------------------------
    |
    | Poniższe wiersze językowe zawierają domyślne komunikaty o błędach używane
    | przez klasę walidatora. Niektóre z tych reguł mają wiele wersji, na przykład
    | reguły dotyczące rozmiaru. Możesz dowolnie dostosować każdą z tych wiadomości tutaj.
    |
    */

    'accepted' => ':attribute musi zostać zaakceptowany.',
    'active_url' => ':attribute nie jest prawidłowym adresem URL.',
    'after' => ':attribute musi być datą po :date.',
    'after_or_equal' => ':attribute musi być datą po lub równą :date.',
    'alpha' => ':attribute może zawierać tylko litery.',
    'alpha_dash' => ':attribute może zawierać tylko litery, cyfry, myślniki i podkreślenia.',
    'alpha_num' => ':attribute może zawierać tylko litery i cyfry.',
    'array' => ':attribute musi być tablicą.',
    'before' => ':attribute musi być datą przed :date.',
    'before_or_equal' => ':attribute musi być datą przed lub równą :date.',
    'between' => [
        'numeric' => ':attribute musi być między :min i :max.',
        'file' => ':attribute musi mieć między :min i :max kilobajtów.',
        'string' => ':attribute musi mieć od :min do :max znaków.',
        'array' => ':attribute musi mieć od :min do :max elementów.',
    ],
    'boolean' => 'Pole :attribute musi być prawdziwe lub fałszywe.',
    'confirmed' => 'Potwierdzenie :attribute nie pasuje.',
    'date' => ':attribute nie jest prawidłową datą.',
    'date_equals' => ':attribute musi być datą równą :date.',
    'date_format' => ':attribute nie pasuje do formatu :format.',
    'different' => ':attribute i :other muszą być różne.',
    'digits' => ':attribute musi mieć :digits cyfr.',
    'digits_between' => ':attribute musi mieć od :min do :max cyfr.',
    'dimensions' => ':attribute ma nieprawidłowe wymiary obrazu.',
    'distinct' => 'Pole :attribute zawiera duplikatowaną wartość.',
    'email' => ':attribute musi być prawidłowym adresem e-mail.',
    'ends_with' => ':attribute musi kończyć się jedną z następujących wartości: :values.',
    'exists' => 'Wybrany :attribute jest nieprawidłowy.',
    'file' => ':attribute musi być plikiem.',
    'filled' => 'Pole :attribute musi mieć wartość.',
    'gt' => [
        'numeric' => ':attribute musi być większy niż :value.',
        'file' => ':attribute musi być większy niż :value kilobajtów.',
        'string' => ':attribute musi mieć więcej niż :value znaków.',
        'array' => ':attribute musi mieć więcej niż :value elementów.',
    ],
    'gte' => [
        'numeric' => ':attribute musi być większy lub równy :value.',
        'file' => ':attribute musi być większy lub równy :value kilobajtów.',
        'string' => ':attribute musi mieć :value znaków lub więcej.',
        'array' => ':attribute musi mieć :value elementów lub więcej.',
    ],
    'image' => ':attribute musi być obrazem.',
    'in' => 'Wybrany :attribute jest nieprawidłowy.',
    'in_array' => 'Pole :attribute nie istnieje w :other.',
    'integer' => ':attribute musi być liczbą całkowitą.',
    'ip' => ':attribute musi być prawidłowym adresem IP.',
    'ipv4' => ':attribute musi być prawidłowym adresem IPv4.',
    'ipv6' => ':attribute musi być prawidłowym adresem IPv6.',
    'json' => ':attribute musi być prawidłowym ciągiem JSON.',
    'lt' => [
        'numeric' => ':attribute musi być mniejszy niż :value.',
        'file' => ':attribute musi być mniejszy niż :value kilobajtów.',
        'string' => ':attribute musi mieć mniej niż :value znaków.',
        'array' => ':attribute musi mieć mniej niż :value elementów.',
    ],
    'lte' => [
        'numeric' => ':attribute musi być mniejszy lub równy :value.',
        'file' => ':attribute musi być mniejszy lub równy :value kilobajtów.',
        'string' => ':attribute musi mieć :value znaków lub mniej.',
        'array' => ':attribute musi mieć nie więcej niż :value elementów.',
    ],
    'max' => [
        'numeric' => ':attribute nie może być większy niż :max.',
        'file' => ':attribute nie może być większy niż :max kilobajtów.',
        'string' => ':attribute nie może mieć więcej niż :max znaków.',
        'array' => ':attribute nie może mieć więcej niż :max elementów.',
    ],
    'mimes' => ':attribute musi być plikiem typu: :values.',
    'mimetypes' => ':attribute musi być plikiem typu: :values.',
    'min' => [
        'numeric' => ':attribute musi być co najmniej :min.',
        'file' => ':attribute musi mieć co najmniej :min kilobajtów.',
        'string' => ':attribute musi mieć co najmniej :min znaków.',
        'array' => ':attribute musi mieć co najmniej :min elementów.',
    ],
    'not_in' => 'Wybrany :attribute jest nieprawidłowy.',
    'not_regex' => 'Format :attribute jest nieprawidłowy.',
    'numeric' => ':attribute musi być liczbą.',
    'password' => 'Hasło jest nieprawidłowe.',
    'present' => 'Pole :attribute musi być wypełnione.',
    'regex' => 'Format :attribute jest nieprawidłowy.',
    'required' => 'Pole :attribute jest wymagane.',
    'required_if' => 'Pole :attribute jest wymagane, gdy :other jest :value.',
    'required_unless' => 'Pole :attribute jest wymagane, chyba że :other znajduje się w :values.',
    'required_with' => 'Pole :attribute jest wymagane, gdy :values jest obecne.',
    'required_with_all' => 'Pole :attribute jest wymagane, gdy :values są obecne.',
    'required_without' => 'Pole :attribute jest wymagane, gdy :values nie jest obecne.',
    'required_without_all' => 'Pole :attribute jest wymagane, gdy żadne z :values nie są obecne.',
    'same' => ':attribute i :other muszą być takie same.',
    'size' => [
        'numeric' => ':attribute musi być :size.',
        'file' => ':attribute musi mieć :size kilobajtów.',
        'string' => ':attribute musi mieć :size znaków.',
        'array' => ':attribute musi zawierać :size elementów.',
    ],
    'starts_with' => ':attribute musi zaczynać się jednym z następujących: :values.',
    'string' => ':attribute musi być tekstem.',
    'timezone' => ':attribute musi być prawidłową strefą czasową.',
    'unique' => ':attribute jest już zajęte.',
    'uploaded' => 'Nie udało się przesłać :attribute.',
    'url' => 'Format :attribute jest nieprawidłowy.',
    'uuid' => ':attribute musi być prawidłowym UUID.',

    [
        /*
        |--------------------------------------------------------------------------
        | Benutzerdefinierte Validierungssprachzeilen
        |--------------------------------------------------------------------------
        |
        | Hier können Sie benutzerdefinierte Validierungsnachrichten für Attribute
        | unter Verwendung der Konvention "attribute.rule" angeben, um die Zeilen zu benennen.
        | Dies ermöglicht es Ihnen, schnell eine spezifische benutzerdefinierte Sprachzeile
        | für eine bestimmte Attributregel anzugeben.
        |
        */

        'custom' => [
            'attribute-name' => [
                'rule-name' => 'benutzerdefinierte-nachricht',
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Benutzerdefinierte Validierungsattribute
        |--------------------------------------------------------------------------
        |
        | Die folgenden Sprachzeilen werden verwendet, um unseren Platzhalter für Attribute
        | durch etwas Benutzerfreundlicheres wie "E-Mail-Adresse" anstelle von "email" zu ersetzen.
        | Dies hilft uns einfach, unsere Nachricht ausdrucksstärker zu gestalten.
        |
        */

        'attributes' => [],
    ],

];
