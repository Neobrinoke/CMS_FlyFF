<?php

return [
	'nav' => [
		'home' => 'Accueil',
		'ranking' => [
			'header' => 'Classement',
			'players' => 'Joueurs',
			'guilds' => 'Guildes',
		],
		'download' => 'Téléchargement',
		'support' => 'Support',
		'shop' => 'Boutique',
		'login' => 'Connexion',
		'register' => 'S\'inscrire',
		'guild' => 'Détails de la guild [:name]'
	],
	'title' => [
		'connect' => 'Connexion',
		'register' => 'S\'inscrire',
		'news' => 'Actualité',
		'article' => ':title',
		'my_account' => 'Mon compte',
		'server_info' => 'Informations du serveur',
		'password_reset' => 'Réinitialisation du mot de passe',
		'player_ranking' => 'Classement des joueurs',
		'guild_ranking' => 'Classement des guildes'
	],
	'home' => [
		'aside' => [
			'my_account' => [
				'logout' => 'Deconnexion'
			]
		]
	],
	'article' => [
		'show_all' => 'Voir plus d\'articles',
		'show_more' => 'Voir plus sur l\'article',
		'detail' => 'Par :name, le :date à :time',
		'comment' => [
			'post' => 'Postez votre commentaire',
			'read' => 'Commentaires',
			'comment' => 'Commentaire',
			'submit' => 'Envoyer',
			'submit_comment' => [
				'comment' => [
					'create' => 'Le commentaire a bien été envoyé',
					'edit' => 'Le commentaire a bien été édité',
					'delete' => 'Le commentaire a bien été supprimé',
				],
				'response' => [
					'create' => 'La réponse a bien été envoyée',
					'edit' => 'La réponse a bien été éditée',
					'delete' => 'La réponse a bien été supprimée',
				]
			]
		]
	],
	'comment' => [
		'reply' => 'Répondre',
		'edit' => 'Editer',
		'delete' => 'Supprimer',
		'show' => 'Afficher les réponses',
		'hide' => 'Masquer les réponses',
		'delete_modal' => [
			'header' => 'Suppression de commentaire',
			'messages' => [
				'Voulez-vous vraiment supprimer ce commentaire ?',
				'Toute les réponses associées seront aussi supprimées.',
				'Cette action est irréversible et prend effet immédiatement après la confirmation.'
			],
			'yes' => 'Oui, supprimer le commentaire',
			'no' => 'Non surtout pas !'
		],
		'edit_modal' => [
			'header' => 'Edition de commentaire',
			'cancel' => 'Annuler',
			'submit' => 'Envoyer'
		]
	],
	'login' => [
		'email' => 'Adresse email',
		'password' => 'Mot de passe',
		'password_lost' => 'Mot de passe oublié ?',
		'submit' => 'Connexion'
	],
	'register' => [
		'name' => 'Nom',
		'email' => 'Adresse email',
		'password' => 'Mot de passe',
		'password_confirmation' => 'Confirmer le mot de passe',
		'rules' => 'J\'ai lu et j\'accèpte le <a href=":url">règlement</a>',
		'submit' => 'S\'inscrire'
	],
	'password_reset' => [
		'email' => 'Adresse email',
		'password' => 'Mot de passe',
		'password_confirmation' => 'Confirmer le mot de passe',
		'submit_request' => 'Envoyer le lien de réinitialisation',
		'submit_reset' => 'Réinitialiser le mot de passe'
	],
	'ranking' => [
		'player' => [
			'name' => 'Nom',
			'job' => 'Classe',
			'lvl' => 'Niveau',
			'gender' => 'Genre',
			'played_time' => 'Temps',
			'status' => 'Statut'
		],
		'guild' => [
			'name' => 'Nom',
			'lvl' => 'Niveau',
			'members' => 'Membres',
			'leader' => 'Chef',
			'logo' => 'Logo',
			'created_at' => 'Création'
		]
	],
	'guild' => [
		'info_divider' => 'Informations général de la guilde',
		'gvg_divider' => 'Informations sur les Guèrres des Guildes',
		'member_divider' => 'Liste des membres',
		'leader' => 'Chef:',
		'penya' => 'Penyas:',
		'lvl' => 'Niveau:',
		'member_count' => 'Nombre de membres:',
		'gvg_point' => 'Points:',
		'gvg_win' => 'Gagnées:',
		'gvg_lose' => 'Perdus:',
		'gvg_surrender' => 'Abandonnées:',
		'member_ranking' => [
			'name' => 'Nom',
			'job' => 'Classe',
			'lvl' => 'Niveau',
			'gender' => 'Genre',
			'rank' => 'Grade',
			'rank_lvl' => 'Niveau de Grade',
			'member_since' => 'Membre depuis',
			'status' => 'Statut'
		]
	],
	'jobs' => [
		'vagrant' => 'Vagabond',
		'mercenary' => 'Mercenaire',
		'acrobat' => 'Acrobate',
		'assist' => 'Acolyte',
		'magician' => 'Magicien',
		'knight' => 'Chevalier',
		'blade' => 'Assassin',
		'jeter' => 'Jester',
		'ranger' => 'Ranger',
		'ringmaster' => 'Pretre',
		'billposter' => 'Moine',
		'psykeeper' => 'Sorcier',
		'elementor' => 'Elementaliste',
		'knight_m' => 'Chevalier Maître',
		'blade_m' => 'Assassin Maître',
		'jeter_m' => 'Jester Maître',
		'ranger_m' => 'Ranger Maître',
		'ringmaster_m' => 'Pretre Maître',
		'billposter_m' => 'Moine Maître',
		'psykeeper_m' => 'Sorcier Maître',
		'elementor_m' => 'Elementaliste Maître',
		'knight_h' => 'Chevalier Hero',
		'blade_h' => 'Assassin Hero',
		'jeter_h' => 'Jester Hero',
		'ranger_h' => 'Ranger Hero',
		'ringmaster_h' => 'Pretre Hero',
		'billposter_h' => 'Moine Hero',
		'psykeeper_h' => 'Sorcier Hero',
		'elementor_h' => 'Elementaliste Hero',
		'templar' => 'Templier',
		'slayer' => 'Spadassin',
		'harlequin' => 'Sylphide',
		'crackshooter' => 'Arbaletrier',
		'seraph' => 'Primat',
		'force_master' => 'Chanoine',
		'mentalist' => 'Envouteur',
		'arcanist' => 'Arcaniste'
	],
	'guild_rank' => [
		'master' => 'Maître',
		'general' => 'Général',
		'officer' => 'Officier',
		'veteran' => 'Vétéran',
		'member' => 'Novice'
	],
	'sex' => [
		'boy' => 'Garçon',
		'girl' => 'Fille'
	],
	'online_status' => [
		'online' => 'En ligne',
		'offline' => 'Hors ligne'
	],
	'time' => [
		'years' => ':years ans',
		'year' => '1 ans',
		'days' => ':days jours',
		'day' => '1 jour',
		'hours' => ':hours heures',
		'hour' => '1 heure',
		'minutes' => ':minutes minutes',
		'minute' => '1 minute',
		'seconds' => ':seconds secondes',
		'second' => '1 seconde'
	]
];
