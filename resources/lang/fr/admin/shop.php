<?php

return [
    'index' => [
        'table' => [
            'id' => 'Id',
            'label' => 'Label',
            'image_thumbnail' => 'Image de couverture',
            'state' => 'Statut',
            'created_at' => 'Créée le ...',
            'action' => 'Action',
            'actions' => [
                'show' => 'Voir',
                'edit' => 'Editer',
                'delete' => 'Supprimer'
            ],
            'statuses' => [
                'on' => 'Activée',
                'off' => 'Désactivée'
            ]
        ]
    ],
    'create' => [
        'form' => [
            'label' => 'Label',
            'image_thumbnail' => 'Image de couverture',
            'is_active' => 'Activation',
            'active_details' => '(La boutique sera dans tous les cas désactivée si elle ne possède aucun objet)',
            'submit' => 'Envoyer',
            'messages' => [
                'success' => 'La boutique a bien été ajoutée'
            ]
        ]
    ],
    'edit' => [
        'form' => [
            'label' => 'Label',
            'image_thumbnail' => 'Image de couverture',
            'is_active' => 'Activation',
            'active_details' => '(La boutique sera dans tous les cas désactivée si elle ne possède aucun objet)',
            'submit' => 'Envoyer',
            'messages' => [
                'success' => 'La boutique a bien été éditée'
            ]
        ]
    ],
    'modal' => [
        'delete' => [
            'header' => 'Suppression de la boutique [:name]',
            'messages' => [
                'Voulez-vous vraiment supprimer cette boutique ?',
                'Tous les objet lié à cette boutique ne seront plus disponible'
            ],
            'no' => 'Non, surtout pas !',
            'yes' => 'Oui, j\'en suis sûr !'
        ]
    ]
];
