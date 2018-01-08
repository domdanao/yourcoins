<?php

// For jQuery portion of the code
// All columns
$all_columns = '
  { "data": "account" },
  { "data": "name" },
  { "data": "symbol" },
  { "data": "price_usd" },
  { "data": "holding" },
  { "data": "holding_value_usd" },
  { "data": "percentage" },
  { "data": "percent_change_1h" },
  { "data": "percent_change_24h" },
  { "data": "percent_change_7d" }';

// For mobile version of your coins
$mobile_columns ='
  { "data": "account" },
  { "data": "price_usd" },
  { "data": "holding" },
  { "data": "holding_value_usd" }';


// HTML portion of the code
// All columns
$html_all = '
  <th>Acct</th>
  <th>Name</th>
  <th>Symbol</th>
  <th>$/Coin</th>
  <th>Holding</th>
  <th>$ Value</th>
  <th>%</th>
  <th>CHG 1H</th>
  <th>CHG 24H</th>
  <th>CHG 7D</th>
  ';

// Mobile columns
$html_mobile = '
  <th>Acct</th>
  <th>$/Coin</th>
  <th>Holding</th>
  <th>$ Value</th>
  ';
?>