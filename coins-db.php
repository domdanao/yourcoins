<?php

// Format for defining your coins
/*
This is your coin database

$coins = array(
	'account_name' => array(
		'name' => 'coin_name_in_coinmarketcap',		>> must be in quotes
		'amount' => number_from_your_wallet				>> check your wallets for actual numbers
	),
);

account_name => a name you give for an account, you can have multiple accounts for similar coins
name => match the proper coin name based on https://api.coinmarketcap.com/v1/ticker/<coin_name>/ 
amount => a number which could be a whole integer (1), or a float (0.2314341)

See sample below.
*/

$coins2 = array(
	'btc1' => array(
		'name' => 'bitcoin',
		'amount' => (0.12345678 + 0.54321827)	// Coins.ph + Coinbase (if you have these)
	),
	'btc2' => array(
		'name' => 'bitcoin',
		'amount' => 0.0287462	// Binance (again, if you have this)
	),
	'eth' => array(
		'name' => 'ethereum',
		'amount' => (18.000929 + 0.00605887)	// Coinbase + Binance
	),
	'dash' => array(
		'name' => 'dash',
		'amount' => 0.12345678	// Exodus (Anything after // is a comment, you can erase)
	),
	'all_neo' => array(
		'name' => 'neo',
		'amount' => 26	// from web wallet
	),
	'bch' => array(
		'name' => 'bitcoin-cash',
		'amount' => 5.0355	// Some cheery comment from the fork (Eg, Yay! Free money)
	),
	'doge' => array(
		'name' => 'dogecoin',
		'amount' => 100000 	// You have a lot because you like it :)
	)
);

?>
