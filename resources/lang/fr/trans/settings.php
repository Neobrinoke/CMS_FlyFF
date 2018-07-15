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
            'new_password' => 'Nouveau mot de passe *',
            'new_password_confirmation' => 'Nouveau mot de passe (confirmation)',
            'submit' => 'Éditer',
            'messages' => [
                'success' => 'Vos informations on bien été édité',
                'new_password' => '* Remplissez ce champ uniquement si vous voulez changer de mot de passe !',
                'password_error' => 'Le mot de passe actuelle est invalide.'
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
                'account' => 'Identifiant (lettres minuscule & chiffres uniquement)',
                'password' => 'Mot de passe',
                'password_confirmation' => 'Mot de passe (confirmation)',
                'submit' => 'Créer',
                'messages' => [
                    'success' => 'Le compte [:account] a bien été crée'
                ]
            ],
            'edit' => [
                'title' => 'Modifier le compte [:account]',
                'password' => 'Mot de passe',
                'password_confirmation' => 'Mot de passe (confirmation)',
                'new_password' => 'Nouveau mot de passe',
                'new_password_confirmation' => 'Nouveau mot de passe (confirmation)',
                'submit' => 'Créer',
                'messages' => [
                    'success' => 'Le compte [:account] a bien été édité',
                    'password_error' => 'Le mot de passe actuelle est invalide.'
                ]
            ]
        ]
    ]

];