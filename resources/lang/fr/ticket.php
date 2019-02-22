<?php

return [

    'statuses' => [
        '1' => 'Ouvert',
        '2' => 'Fermé',
        '3' => 'Rejeté',
        '4' => 'En attente',
        '5' => 'Réponse de l\'équipe',
        '6' => 'En attente (lu)',
    ],

    'index' => [
        'search_section' => [
            'header' => 'Section de recherche',
            'title' => 'Titre',
            'categories' => 'Catégories',
            'statuses' => 'Statuts',
            'creation_date_min' => 'Date de création (de)',
            'creation_date_max' => 'Date de création (à)',
            'select_categories' => 'Sélectionnez une/des catégorie(s)',
            'select_statuses' => 'Sélectionnez un/des statut(s)',
        ],
        'ticket_list' => 'Liste des tickets',
        'title' => 'Titre',
        'category' => 'Catégorie',
        'status' => 'Statut',
        'creation_date' => 'Date de création',
        'action' => 'Action',
        'create_ticket' => 'Créer un nouveau ticket',
    ],

    'create' => [
        'form' => [
            'title' => 'Titre',
            'category' => 'Catégorie',
            'select_category' => 'Sélectionnez une catégorie',
            'content' => 'Contenu',
            'attachments' => 'Sélectionnez un ou plusieurs fichier(s) à attacher(s) au ticket',
            'submit' => 'Envoyer'
        ],
        'messages' => [
            'success' => 'Votre ticket a bien été crée',
        ],
    ],

    'show' => [
        'info_block' => [
            'category' => 'Catégorie:',
            'created_ago' => 'Crée:',
            'status' => 'Statut:'
        ],
        'response' => [
            'form' => [
                'content' => 'Ecrivez votre réponse',
                'attachments' => 'Sélectionnez un ou plusieurs fichier(s) à attacher(s) à la réponse',
                'submit' => 'Répondre'
            ],
            'messages' => [
                'success' => 'Votre réponse a bien été crée',
            ],
        ],
    ],

];
