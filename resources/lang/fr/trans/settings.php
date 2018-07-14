<?php

return [

    'general' => [
        'index' => [
            'title' => 'Informations générales',
            'email' => 'Adresse email',
            'register_date' => 'Date d\'inscription',
            'update_date' => 'Dernière mise à jour',
            'statuses' => [
                'valid' => 'Valide',
                'banned' => 'Banni'
            ],
            'buttons' => [
                'edit' => 'Éditer'
            ]
        ],
        'edit' => [
            'title' => 'Modification des informations',
            'name' => 'Nom',
            'email' => 'Adresse email',
            'password' => 'Mot de passe',
            'password_confirmation' => 'Mot de passe (confirmation)',
            'submit' => 'Éditer',
            'messages' => [
                'success' => 'Vos informations on bien été édité'
            ]
        ]
    ],
    'game' => [
        'account' => [
            'index' => [
                'title' => 'Mes comptes de jeu',
                'buttons' => [
                    'add' => 'Ajouter'
                ]
            ],
            'create' => [
                'title' => 'Ajouter un nouveau compte de jeu',
                'login' => 'Identifiant (lettres minuscule & chiffres uniquement)',
                'password' => 'Mot de passe',
                'password_confirmation' => 'Mot de passe (confirmation)',
                'submit' => 'Créer',
                'messages' => [
                    'success' => 'Le compte [:login] a bien été crée'
                ]
            ]
        ]
    ]

];