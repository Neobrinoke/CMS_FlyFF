<?php

use App\Model\Web\ShopItem;

return [

	'choose_shop' => 'Choisissez une boutique !',
	'show_item_details' => 'Voir les détails de l\'objet',
	'search' => [
		'header' => 'Section de recherche',
		'title' => 'Titre',
		'price' => 'Tranche de prix (5 - 50) remplissez celui de gauche pour un résultat strict',
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
			/**
			 * These keys need to be formatted like that (column-direction). That's important!
			 */
			'price-asc' => 'Prix ↑',
			'price-desc' => 'Prix ↓',
			'title-asc' => 'Nom ↑',
			'title-desc' => 'Nom ↓'
		],
	],
	'quantity' => 'Quantité',
	'add_to_cart' => 'Ajouter au panier',
	'sale_types' => [
		ShopItem::SALE_CS_TYPE => 'GPotato Point',
		ShopItem::SALE_VOTE_TYPE => 'Vote Point'
	],
	'cart' => [
		'cart_summary' => 'Récapitulatif de votre panier',
		'image' => 'Image',
		'name' => 'Nom',
		'quantity' => 'Qte',
		'unit_price' => 'Prix Unit.',
		'ttl_price' => 'Prix Ttl.',
		'buy_summary' => 'Achetez votre panier',
		'you_have' => 'Vous avez:',
		'you_will_have' => 'Vous aurez après votre achat',
		'select_char' => 'Sélectionnez le personnage qui recevera l\'objet',
		'buy' => 'Achetez votre panier',
		'need_login' => 'Vous devez être connecté pour ajouter cet objet à votre panier',
		'error' => [
			'empty_cart' => 'Votre panier est vide',
			'char_not_found' => 'Personnage introuvable',
			'insufficient_balance' => 'Solde insuffisant'
		],
		'success' => 'L\'objet a bien été envoyé à :name. Merci de vous reconnecter pour y avoir accès.'
	]

];
