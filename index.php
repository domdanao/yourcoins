<?php
require __DIR__ . '/vendor/autoload.php';
require 'coins-db.php';
require 'columns.php';

// Useful if you have your own web host,
// so that you can view your coins with your mobile phone
$detect = new Mobile_Detect;

// Specify your own timezone here
date_default_timezone_set('Asia/Manila');


$thistime = time();
$total_usd = 0;
$coins_info = array();
$json_a = array();

$datafile = "data2.txt";

$totalsfile = "total2.txt";
if (file_exists($totalsfile)) {
	$string = file_get_contents($totalsfile);
	$json_a = json_decode($string, true);
}

foreach ($coins2 as $account => $details ) {
	$coin_info = get_info($details["name"]);
	$coin_info["account"] = $account;
	$coin_info["holding"] = $details["amount"];
	$coin_info["usd_value"] = $coin_info["price_usd"] * $details["amount"];
	array_push($coins_info, $coin_info);

	$total_usd = $total_usd + $coin_info["usd_value"];
}

// Difference between this check and last check
$diff = $total_usd - $json_a["total_value"];
$perc = (($total_usd / $json_a["total_value"]) - 1) * 100;
$state = '';
if ($diff == 0) {
	$state = 'No difference';
}
if ($diff < 0) {
	$state = "Down";
}
if ($diff > 0) {
	$state = "Up";
}
$sec = $thistime - $json_a["when"];
$ago = secondsToTime($sec);

$clean_info = array("data" => []);

foreach ($coins_info as $a) {
	$clean = array();
	$clean["account"] = $a["account"];
	$clean["name"] = $a["name"];
	$clean["symbol"] = $a["symbol"];
	$clean["price_usd"] = $a["price_usd"];
	$clean["percent_change_1h"] = $a["percent_change_1h"];
	$clean["percent_change_24h"] = $a["percent_change_24h"];
	$clean["percent_change_7d"] = $a["percent_change_7d"];
	$clean["holding"] = $a["holding"];
	$clean["holding_value_usd"] = number_format($a["usd_value"],2,'.',',');
	$percentage = ($a['usd_value'] / $total_usd) * 100;
	$clean["percentage"] = number_format($percentage,2,'.',',');
	array_push($clean_info["data"], $clean);
}

// Write data file
$data = fopen($datafile, "w");
fwrite($data, json_encode($clean_info));
fclose($data);

// Record totals reference
$total_info = array(
	"when" => time(),
	"total_value" => $total_usd
);
$total = fopen($totalsfile, "w");
fwrite($total, json_encode($total_info));
fclose($total);


/* UTILITY FUNCTIONS */
// Get information from coinmarketcap
function get_info($coin) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.coinmarketcap.com/v1/ticker/$coin/");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$res = json_decode(curl_exec($ch), true);
	return $res[0];
}

function secondsToTime($seconds) {
	$dtF = new \DateTime('@0');
	$dtT = new \DateTime("@$seconds");
	return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
}
?>
<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<style>
			body,p { font-family: "Helvetica Nueue", "Helvetica", sans-serif; }
			.total {font-family: "HelveticaNeueThin", "HelveticaNeue-Thin", "Helvetica Neue Thin", "HelveticaNeue", "Helvetica Neue", 'TeXGyreHerosRegular', "Arial", sans-serif; font-weight:200; font-stretch:normal; font-size: 48px; }
		</style>
		<style type="text/css" class="init"></style>
		<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script class="init">
			$(document).ready(function() {
			$('#example').DataTable( {
				"paging": false,
				"info": false,
				"order": [[<?php if ( $detect->isMobile()) { echo '3'; } else { echo '5'; } ?>,"desc"]],
				"ajax": "<?php echo $datafile; ?>",
				"columns": [<?php if ( $detect->isMobile()) { echo $mobile_columns; } else { echo $all_columns; } ?>]
				});
			});
		</script>

  </head>
  <body class="wide comments example">
  	<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->
		<!-- Main table -->
		<table cellspacing="0" width="100%">
			<tr>
				<td>
					<!-- Header table-->
					<table class="display" cellspacing="0">
						<tr>
							<td class="total">$<?php echo number_format($total_usd,2,'.',','); ?></td>
						</tr>
					</table>
					<!-- End header table -->
					<!-- Content table -->
					<table id="example" class="display" cellspacing="0" width="100%">
						<thead>
							<tr> <?php if ( $detect->isMobile()) { echo $html_mobile; } else { echo $html_all; } ?>
							</tr>
						</thead>
					</table>
					<!-- End content table -->
					<!-- Footer table -->
					<table width="100%">
						<tr>
						<td style="text-align: left">as of <em><?php echo date("M j, Y H:i:s O"); ?></em></td>
						<td style="font-size: 14px; text-align:right;" align="right"><em><?php echo $state . ' ' . number_format($perc,2); ?>% from <?php echo $ago; ?> ago.</em></td>
						</tr>
					</table>
					<!-- End footer table -->
				</td>
			</tr>
		</table>
		<!-- End main table -->
	</body>
</html>
