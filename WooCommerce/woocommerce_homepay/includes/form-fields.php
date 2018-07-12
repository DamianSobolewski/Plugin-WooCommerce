<?php
return array (
		'enabled' => array (
				'title' => __ ( 'Włącz/Wyłącz', 'woocommerce' ),
				'type' => 'checkbox',
				'label' => __ ( 'Włącz metodę płatności przez Homepay.', 'woocommerce' ),
				'default' => 'yes' 
		),
		'title' => array (
				'title' => __ ( 'Nazwa', 'woocommerce' ),
				'type' => 'text',
				'default' => __ ( 'Homepay', 'woocommerce' ),
				'desc_tip' => true 
		),
		'description' => array (
				'title' => __ ( 'Opis', 'woocommerce' ),
				'type' => 'textarea',
				'description' => __ ( 'Ustawia opis bramki, który widzi użytkownik przy tworzeniu zamówienia.', 'woocommerce' ),
				'default' => __ ( 'Zapłać przez Homepay.', 'woocommerce' ) 
		),
		'user_id' => array (
				'title' => __ ( 'ID użytkownika', 'woocommerce' ),
				'type' => 'text',
				'description' => __ ( 'Twoje ID użytkownika w systemie Homepay.', 'woocommerce' ),
				'default' => __ ( '0', 'woocommerce' ),
				'desc_tip' => true 
		),
		'public_key' => array (
				'title' => __ ( 'Klucz publiczny', 'woocommerce' ),
				'type' => 'text',
				'description' => __ ( 'Klucz publiczny konta na Homepay.', 'woocommerce' ),
				'default' => __ ( '0', 'woocommerce' ),
				'desc_tip' => true 
		),
		'private_key' => array (
				'title' => __ ( 'Klucz prywatny', 'woocommerce' ),
				'type' => 'text',
				'description' => __ ( 'Klucz prywatny konta na Homepay.', 'woocommerce' ),
				'default' => __ ( '0', 'woocommerce' ),
				'desc_tip' => true 
		) 
);