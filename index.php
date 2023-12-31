<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Stock Info</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
</head>

<?php
$ENDPOINT = 'http://api.marketstack.com/v1/intraday/latest?access_key=43fe2c22f995701b5b0e448e847d5ec2&symbols=AAPL';

$curl = curl_init($ENDPOINT);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);

if ($response === false) {
    die('cURL Error ' . curl_error($curl));
}

curl_close($curl);

$data = json_decode($response, true);

if ($data && isset($data['data'])) {
  $quote = $data['data'][0];
  $open = $quote['open'];
  $high = $quote['high'];
  $low = $quote['low'];
  $last = $quote['last'];
  $close = $quote['close'];
  $volume = $quote['volume'];
  $symbol = $quote['symbol'];
} else {
  echo "Failed to get data.";
}

?>


<body>
  <header>
  </header>
  <main>
    <h2><?php echo $symbol; ?></h2>
    <div id="stock-info">
      <table>
        <tr>
          <th>Last Trade</th>
          <td><?php echo $last; ?></td>
        </tr>
        <tr>
          <th>Previous Close</th>
          <td><?php echo $close; ?></td>
        </tr>
        <tr>
          <th>Open</th>
          <td><?php echo $open; ?></td>
        </tr>
      </table>
      <table>
        <tr>
          <th>Day's High</th>
          <td><?php echo $high; ?></td>
        </tr>
        <tr>
          <th>Day's Low</th>
          <td><?php echo $low; ?></td>
        </tr>
        <tr>
          <th>Volume</th>
          <td><?php echo $volume; ?></td>
        </tr>
      </table>
    </div>

  </main>
  <footer>
    <div class="footer">
        <div class="allrights">© Seisuke Yamada All rights reserved.</div>
    </div>
  </footer>
</body>



</html>