<?php

use App\Model\Web\Shop;

return [

    'choose_shop' => 'Choisissez une boutique !',
    'show_item_details' => 'Voir les détails de l\'objet',
    'search' => [
        'header' => 'Section de recherche',
        'title' => 'Titre',
        'price_min' => 'Prix min',
        'price_max' => 'Prix max',
        'category' => 'Catégorie',
        'devise' => 'Devise',
        'sort_by' => 'Trié par',
        'select_categories' => 'Sélectionnez une/des catégorie(s)',
        'select_devises' => 'Sélectionnez une/des devise(s)',
        'select_sort' => 'Sélectionnez un ordre de tri',
        'submit' => 'Rechercher',
        'clear_form' => 'Vider la recherche',
        'can_not_find' => 'Aucun article ne correspond exactement à vos critères.',
        'sort_list' => [
            // /!\ These keys must be matched with const SORTS in Shop class /!\
            'price-asc' => 'Prix ↑',
            'price-desc' => 'Prix ↓',
            'title-asc' => 'Nom ↑',
            'title-desc' => 'Nom ↓'
        ],
    ],
    'quantity' => 'Quantité',
    'add_to_cart' => 'Ajouter au panier',
    'sale_types' => [
        Shop::SALE_CS_TYPE => 'GPotato Point',
        Shop::SALE_VOTE_TYPE => 'Vote Point'
    ],
    'cart' => [
        'cart_summary' => 'Récapitulatif de votre panier',
        'buy_summary' => 'Finalisation de l\'achat du panier',
        'image' => 'Image',
        'name' => 'Nom',
        'quantity' => 'Qte',
        'unit_price' => 'Prix Unit.',
        'ttl_price' => 'Prix Ttl.',
        'you_have' => 'Vous avez:',
        'you_will_have' => 'Vous aurez après votre achat',
        'select_char' => 'Sélectionnez le personnage qui recevera l\'objet',
        'buy' => 'Acheter le panier',
        'need_login' => 'Vous devez être connecté pour ajouter cet objet à votre panier',
        'no_chars' => 'Aucun personnages disponible',
        'error' => [
            'empty_cart' => 'Votre panier est vide',
            'char_not_found' => 'Personnage introuvable',
            'insufficient_balance' => 'Solde insuffisant'
        ],
        'success' => 'L\'objet a bien été envoyé à :name. Merci de vous reconnecter pour y avoir accès.'
    ]

];
