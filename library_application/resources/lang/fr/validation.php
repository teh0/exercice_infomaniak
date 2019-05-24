<?php
return array(
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    "accepted"         => "Le champ doit être accepté.",
    "active_url"       => "Le champ n'est pas une URL valide.",
    "after"            => "Le champ doit être une date postérieure au :date.",
    "alpha"            => "Le champ doit seulement contenir des lettres.",
    "alpha_dash"       => "Le champ doit seulement contenir des lettres, des chiffres et des tirets.",
    "alpha_num"        => "Le champ doit seulement contenir des chiffres et des lettres.",
    "before"           => "Le champ doit être une date antérieure au :date.",
    "between"          => array(
        "numeric" => "La valeur doit être comprise entre :min et :max.",
        "file"    => "Le fichier doit avoir une taille entre :min et :max kilobytes.",
        "string"  => "Le texte doit avoir entre :min et :max caractères.",
    ),
    "confirmed"        => "Le champ de confirmation ne correspond pas.",
    "date"             => "Le champ n'est pas une date valide.",
    "date_format"      => "Le champ ne correspond pas au format :format.",
    "different"        => "Les deux champs doivent être différents.",
    "digits"           => "Le champ doit avoir :digits chiffres.",
    "digits_between"   => "Le champ doit avoir entre :min and :max chiffres.",
    "email"            => "Le format du champ est invalide.",
    "exists"           => "Le champ sélectionné est invalide.",
    "image"            => "Le champ doit être une image.",
    "in"               => "Le champ est invalide.",
    "integer"          => "Le champ doit être un entier.",
    "ip"               => "Le champ doit être une adresse IP valide.",
    "max"              => array(
        "numeric" => "La valeur ne peut être supérieure à :max.",
        "file"    => "Le fichier ne peut être plus gros que :max kilobytes.",
        "string"  => "Le texte ne peut contenir plus de :max caractères.",
    ),
    "mimes"            => "Le champ doit être un fichier de type : :values.",
    "min"              => array(
        "numeric" => "La valeur doit être inférieure à :min.",
        "file"    => "Le fichier doit être plus que gros que :min kilobytes.",
        "string"  => "Le texte doit contenir au moins :min caractères.",
    ),
    "not_in"           => "Le champ sélectionné n'est pas valide.",
    "numeric"          => "Le champ doit contenir un nombre.",
    "regex"            => "Le format du champ est invalide.",
    "required"         => "Le champ est obligatoire.",
    "required_if"      => "Le champ est obligatoire quand la valeur de :other est :value.",
    "required_with"    => "Le champ est obligatoire quand :values est présent.",
    "required_without" => "Le champ est obligatoire quand :values n'est pas présent.",
    "same"             => "Les champs et :other doivent être identiques.",
    "size"             => array(
        "numeric" => "La taille de la valeur doit être :size.",
        "file"    => "La taille du fichier doit être de :size kilobytes.",
        "string"  => "Le texte doit contenir :size caractères.",
    ),
    "unique"           => "La valeur du champ est déjà utilisée.",
    "url"              => "Le format de l'URL n'est pas valide.",
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
    'custom' => array(),
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => array(),
);