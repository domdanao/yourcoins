# yourcoins

## Requirements

-- PHP, with curl

-- Web server

I use MAMP (https://www.mamp.info/en/downloads/) to make this work on my Mac.

Download Windows package if you are using Windows.

For Linux, you can just set up LAMP stack. Install php-curl. Also, make sure you can write files to the director where you are serving your files.

Optionally, install composer (https://getcomposer.org), if you want mobile detection.

## Install

Go to your web server home directory. Usually `/var/www/html` on standard Linux installs. For MAMP, you can set it up using the control panel of MAMP.

Run the following commands. (Assumes you have git installed already.)

```
git clone https://github.com/domdanao/yourcoins.git
cd yourcoins
composer require mobiledetect/mobiledetectlib
```

Load your app. Ex: http://localhost:8888/yourcoins/

## List your coins

You need to edit `coins-db.php` to make the app your own. In this file, you list coins you hold, and the amounts you possess.

Example:
```
$coins2 = array(
	'btc1' => array(
		'name' => 'bitcoin',
		'amount' => (0.12345678 + 0.54321827)	// Coins.ph + Coinbase (if you have these)
	)
);
```

The above says you have one account, named `btc1`. This account has a coin named `bitcoin`, and you have an amount of `0.12345678 + 0.54321827`. The double front slashes means any text after it is a comment that will be ignored by the program. Why is it there? So you can see where the accounts are "stored", in this case, from Coins.ph and Coinbase. The program will run the addition operation.

The above means you can have an account `btc2`, which may also contain `bitcoin`, with different amounts. This is convenient if you are tracking multiple accounts of similar coins.

A slightly more complex database could look like this:

```
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
	'neo' => array(
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
```

The above says you've got some coins! Replace anything after `//` with your own comments. They could be notes about just about anything. Make sure the comments are just in one line after the `//`.

After editing your coins-db (and hopefully getting it all correct with no errors), re-oad your app. Ex: `http://localhost:8888/yourcoins/`

## What else?

You can extend the script and run it via cron every hour, for example, and send you an SMS or email. You'd have to have your SMS gateway and email server set up yourself.

Perhaps, you want to modify the `coins-db.php` file and include such information like buy price and gain threshold for alerts, etc.

Or perhaps you can get an API key from your exchange to do automatic trades.

As of now, just keeping it simple. Display the coins I have from a web server, and consume the info from my mobile phone.

Enjoy!
