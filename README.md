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

## What else?

You can extend the script and run it via cron every hour, for example, and send you an SMS or email. You'd have to have your SMS gateway and email server set up yourself.

Perhaps, you want to modify the `coins-db.php` file and include such information like buy price and gain threshold for alerts, etc.

Or perhaps you can get an API key from your exchange to do automatic trades.

As of now, just keeping it simple. Display the coins I have from a web server, and consume the info from my mobile phone.

Enjoy!
