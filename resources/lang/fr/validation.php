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

    'accepted' => "L'attribut :attribute doit etre valider.",
    'active_url' => "L'attribut :attribute doit etre un URL valide",
    'after' => "L'attribut :attribute doit etre une date apres le :date.",
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_format' => "L'attribut :attribute doit etre du format :format.",
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => "L'attribut :attribute doit avoir une valheur au moin au dessus de :min",
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => "Le format de l'attribut :attribute est invalide.",
    'required' => "Le champ :attribute doit etre remplie.",
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values is present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines

    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'point' => [
            'min' => 'Le credit ne peut pas etre negatif',
        ],
        'status' => [
            'required' => "L'utilisateur doit avoir un status",
            'in' => "La valheur du statu n'est pas valable",
        ],
        'CalanderID' => [
            'required' => "Vous ne pouvais pas faire une reservation si vous ne selectionner pas au moin un creneau.",
            'max' => "Vous n'etes pas autoriser a reserver plus de :max creneaux a la fois, veuillez contacter un administrateur pour justifier des creneaux plus long.",
        ],
        'engage' => [
            'required' => 'Vous devez aceppter de vous engager.'
        ],
        'verified' => [
            'required' => "Vous devez esstimer le temps d'utilisation de la machine avant de reserver. En effet, si vous depasser la duree de votre reservation nous ne pouvons pas garentir la dissponibilitee de la machine et vous pouvez etre contrain a la quitter prematurement. Pour bien estimer votre temps d'utilisation rendez-vous dans notre selection de tutoriels.",
        ],
        'email' => [
            'regex' => "Le format de l'adresse mail est invalide en effet, seul les personnes rattacher a l'ECE ont la possibilitee de cree des comptes sur ce site. Veuillez utiliser une adresse mail fourni par l'ecole",
        ],
        'project.0.id' => [
            'required' => "Vous devez renseigner l'attribut :attribute pour tout les projets",
            'max' => "L'attribut :attribute doit pas depasser la taille :max .",
            'min' => "L'attribut :attribute doit avoit au moin une taille de :min .",
            'distinct' => "L'attribut :attribute doit etre unique il ne peut pas y en avoir deux de similiaires."
        ],

    ],


];
