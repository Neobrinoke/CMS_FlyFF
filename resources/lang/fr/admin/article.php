<?php

return [

    'index' => [
        'table' => [
            'id' => 'Id',
            'titre' => 'Titre',
            'authorized_comment' => 'Commentaires autorisés',
            'created_at' => 'Créée le ...',
            'action' => 'Action',
            'actions' => [
                'show' => 'Voir',
                'edit' => 'Editer',
                'delete' => 'Supprimer',
            ],
            'statuses' => [
                'on' => 'Activée',
                'off' => 'Désactivée',
            ]
        ]
    ],

    'create' => [
        'form' => [
            'title' => 'Titre de l\'article',
            'image_thumbnail' => 'Image de couverture',
            'image_header' => 'Image à la une',
            'content' => 'Contenu de l\'article',
            'category' => 'Catégorie',
            'authorized_comment' => 'Autoriser les commentaires',
            'submit' => 'Envoyer',
            'messages' => [
                'success' => 'L\'article a bien été ajoutée',
            ]
        ]
    ],

    'edit' => [
        'form' => [
            'title' => 'Titre de l\'article',
            'image_thumbnail' => 'Image de couverture',
            'image_header' => 'Image à la une',
            'category' => 'Catégorie',
            'content' => 'Contenu de l\'article',
            'authorized_comment' => 'Autoriser les commentaires',
            'submit' => 'Envoyer',
            'messages' => [
                'success' => 'L\'article a bien été éditée',
            ]
        ]
    ],

    'destroy' => [
        'messages' => [
            'success'=> 'La suppression s\'est effectuée avec succès',
            'error' => 'Une erreur est survenue lors de la suppression',
        ]
    ],

    'modal' => [
        'delete' => [
            'header' => 'Suppression de l\'article [:name]',
            'messages' => [
                'Voulez-vous vraiment supprimer cet article ?',
                'Tous les objet lié à cet article ne seront plus disponible',
            ],
            'no' => 'Non, surtout pas !',
            'yes' => 'Oui, j\'en suis sûr !',
        ]
    ]

];
