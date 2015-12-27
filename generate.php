<?php
$language = "en";

function startsWith($haystack, $needle) {
  return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

$string = file_get_contents("titles.json");
$json_input = json_decode($string, true);

$keys = $_GET['POIs'];
?>


<html>
<style>
html { font-family: sans-serif; }
h1 { text-align: center; }
img.qr { width: 60%; margin: 17% 20% 3% 20%; }
div.logo { font-weight: bold; }
div.logo img, div.logo span { vertical-align: middle; }
div.logo img { height: 8em; }
div.logo span { font-size: 5em; }
div.generatorLink { text-align: center; margin-top: 80px; font-size: 0.7em; }
@media print {
  div.page { page-break-before: always; }
}
</style>
<body>

<?php
$firstPage = true;
foreach ($keys as $key) {
  if ($firstPage) {
    echo "<div>\n";
    $firstPage = false;
  } else {
    echo "<div class=\"page\">\n";
  }
  echo "<div class=\"logo\"><img src=\"https://c3nav.de/static/img/logo.png\"><span>32c3nav</span></div>\n";
  $navUrl = urlencode("https://c3nav.de/o$key");
  $imgUrl = "https://chart.googleapis.com/chart?cht=qr&chl=$navUrl&chs=545x545&choe=UTF-8&chld=L|2";
  echo "  <img src=\"$imgUrl\" class=\"qr\">\n";
  $titleDE = $json_input[$key]["de"];
  $titleEN = $json_input[$key]["en"];
  echo "  <h1>$titleDE</h1>\n";
  echo "  <h1>$titleEN</h1>\n";
  echo "  <div class=\"generatorLink\">Generate QR for your assembly at http://timbodeit.de/c3navQR</div>";
  echo "</div>\n";
}
?>

</body>
</html>
