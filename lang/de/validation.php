<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validierungs-Sprachzeilen
    |--------------------------------------------------------------------------
    |
    | Die folgenden Sprachzeilen enthalten die Standardfehlermeldungen, die von
    | der Validator-Klasse verwendet werden. Einige dieser Regeln haben mehrere
    | Versionen, z. B. die Größenregeln. Sie können jede dieser Meldungen
    | hier nach Ihren Wünschen anpassen.
    |
    */

    'accepted' => ':attribute muss akzeptiert werden.',
    'active_url' => ':attribute ist keine gültige URL.',
    'after' => ':attribute muss ein Datum nach :date sein.',
    'after_or_equal' => ':attribute muss ein Datum nach oder gleich :date sein.',
    'alpha' => ':attribute darf nur Buchstaben enthalten.',
    'alpha_dash' => ':attribute darf nur Buchstaben, Zahlen, Bindestriche und Unterstriche enthalten.',
    'alpha_num' => ':attribute darf nur Buchstaben und Zahlen enthalten.',
    'array' => ':attribute muss ein Array sein.',
    'before' => ':attribute muss ein Datum vor :date sein.',
    'before_or_equal' => ':attribute muss ein Datum vor oder gleich :date sein.',
    'between' => [
        'numeric' => ':attribute muss zwischen :min und :max liegen.',
        'file' => ':attribute muss zwischen :min und :max Kilobyte groß sein.',
        'string' => ':attribute muss zwischen :min und :max Zeichen lang sein.',
        'array' => ':attribute muss zwischen :min und :max Elemente enthalten.',
    ],
    'boolean' => 'Das Feld :attribute muss wahr oder falsch sein.',
    'confirmed' => ':attribute Bestätigung stimmt nicht überein.',
    'date' => ':attribute ist kein gültiges Datum.',
    'date_equals' => ':attribute muss ein Datum gleich :date sein.',
    'date_format' => ':attribute entspricht nicht dem Format :format.',
    'different' => ':attribute und :other müssen unterschiedlich sein.',
    'digits' => ':attribute muss :digits Ziffern enthalten.',
    'digits_between' => ':attribute muss zwischen :min und :max Ziffern enthalten.',
    'dimensions' => ':attribute hat ungültige Bildabmessungen.',
    'distinct' => 'Das Feld :attribute hat einen doppelten Wert.',
    'email' => ':attribute muss eine gültige E-Mail-Adresse sein.',
    'ends_with' => ':attribute muss mit einem der folgenden Elemente enden: :values.',
    'exists' => 'Das ausgewählte :attribute ist ungültig.',
    'file' => ':attribute muss eine Datei sein.',
    'filled' => 'Das Feld :attribute muss einen Wert haben.',
    'gt' => [
        'numeric' => ':attribute muss größer als :value sein.',
        'file' => ':attribute muss größer als :value Kilobyte sein.',
        'string' => ':attribute muss länger als :value Zeichen sein.',
        'array' => ':attribute muss mehr als :value Elemente enthalten.',
    ],
    'gte' => [
        'numeric' => ':attribute muss größer oder gleich :value sein.',
        'file' => ':attribute muss größer oder gleich :value Kilobyte sein.',
        'string' => ':attribute muss größer oder gleich :value Zeichen sein.',
        'array' => ':attribute muss mindestens :value Elemente enthalten.',
    ],
    'image' => ':attribute muss ein Bild sein.',
    'in' => 'Das ausgewählte :attribute ist ungültig.',
    'in_array' => 'Das Feld :attribute ist nicht in :other vorhanden.',
    'integer' => ':attribute muss eine Ganzzahl sein.',
    'ip' => ':attribute muss eine gültige IP-Adresse sein.',
    'ipv4' => ':attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6' => ':attribute muss eine gültige IPv6-Adresse sein.',
    'json' => ':attribute muss ein gültiger JSON-String sein.',
    'lt' => [
        'numeric' => ':attribute muss kleiner als :value sein.',
        'file' => ':attribute muss kleiner als :value Kilobyte sein.',
        'string' => ':attribute muss kürzer als :value Zeichen sein.',
        'array' => ':attribute muss weniger als :value Elemente enthalten.',
    ],
    'lte' => [
        'numeric' => 'Der Wert von ":attribute" darf nicht größer als :value sein.',
        'file' => 'Die Größe von ":attribute" darf nicht mehr als :value Kilobyte betragen.',
        'string' => 'Die Länge von ":attribute" darf nicht mehr als :value Zeichen betragen.',
        'array' => '":attribute" darf nicht mehr als :value Elemente enthalten.',
    ],
    'max' => [
        'numeric' => 'Der Wert von ":attribute" darf nicht größer als :max sein.',
        'file' => 'Die Größe von ":attribute" darf nicht mehr als :max Kilobyte betragen.',
        'string' => 'Die Länge von ":attribute" darf nicht mehr als :max Zeichen betragen.',
        'array' => '":attribute" darf nicht mehr als :max Elemente enthalten.',
    ],
    'mimes' => 'Die Datei ":attribute" muss einen Dateityp von :values haben.',
    'mimetypes' => 'Die Datei ":attribute" muss einen Dateityp von :values haben.',
    'min' => [
        'numeric' => 'Der Wert von ":attribute" muss mindestens :min sein.',
        'file' => 'Die Größe von ":attribute" muss mindestens :min Kilobyte betragen.',
        'string' => 'Die Länge von ":attribute" muss mindestens :min Zeichen betragen.',
        'array' => '":attribute" muss mindestens :min Elemente enthalten.',
    ],
    'not_in' => 'Der ausgewählte Wert für ":attribute" ist ungültig.',
    'not_regex' => 'Das Format von ":attribute" ist ungültig.',
    'numeric' => '":attribute" muss eine Zahl sein.',
    'password' => 'Das Passwort ist falsch.',
    'present' => 'Das Feld ":attribute" muss ausgefüllt sein.',
    'regex' => 'Das Format von ":attribute" ist ungültig.',
    'required' => 'Das Feld ":attribute" ist erforderlich.',
    'required_if' => 'Das Feld ":attribute" ist erforderlich, wenn ":other" den Wert ":value" hat.',
    'required_unless' => 'Das Feld ":attribute" ist erforderlich, es sei denn ":other" hat einen der folgenden Werte: :values',
    'required_with' => 'Das Feld ":attribute" ist erforderlich, wenn einer der folgenden Werte vorhanden ist: :values',
    'required_with_all' => 'Das Feld ":attribute" ist erforderlich, wenn alle der folgenden Werte vorhanden sind: :values',
    'required_without' => 'Das Feld ":attribute" ist erforderlich, wenn keiner der folgenden Werte vorhanden ist: :values',
    'required_without_all' => 'Das Feld ":attribute" ist erforderlich, wenn keiner der folgenden Werte vorhanden ist: :values',
    'same' => '":attribute" und ":other" müssen übereinstimmen.',
    'size' => [
        'numeric' => 'Der Wert von ":attribute" muss :size sein.',
        'file' => 'Die Größe von ":attribute" muss :size Kilobyte betragen.',
        'string' => 'Die Länge von ":attribute" muss :size Zeichen betragen.',
        'array' => '":attribute" muss :size Elemente enthalten.',
    ],
    'starts_with' => '":attribute" muss mit einem der folgenden Werte beginnen: :values',
    'string' => '":attribute" muss eine Zeichenkette sein.',
    'timezone' => '":attribute" muss eine gültige Zeitzone sein.',
    'unique' => 'Der Wert von ":attribute" ist bereits vorhanden.',
    'uploaded' => 'Das Hochladen von ":attribute" ist fehlgeschlagen.',
    'url' => 'Das Format von ":attribute" ist ungültig.',
    'uuid' => '":attribute" muss eine gültige UUID sein.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Hier können Sie benutzerdefinierte Validierungsnachrichten für Attribute angeben,
    | indem Sie die Konvention "attribut.regel" verwenden, um die Zeilen zu benennen.
    | Dies ermöglicht es Ihnen, schnell eine bestimmte benutzerdefinierte Sprachzeile
    | für eine bestimmte Attributregel anzugeben.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Benutzerdefinierte Validierungsattribute
    |--------------------------------------------------------------------------
    |
    | Die folgenden Sprachzeilen werden verwendet, um unsere Attributplatzhalter
    | gegen etwas Lesefreundlicheres auszutauschen, wie z.B. "E-Mail-Adresse" anstelle
    | von "email". Dies hilft uns einfach dabei, unsere Nachricht ausdrucksvoller zu gestalten.
    |
    */

    'attributes' => [],

];
