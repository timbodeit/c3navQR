<?php
$language = "en";

function startsWith($haystack, $needle) {
  return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

$string = file_get_contents("titles.json");
$json_input = json_decode($string, true);
$keys = [];
$titles = [];

foreach ($json_input as $key => $array) {
  if (startsWith($key,":")) {
    continue;
  }
  $keys[] = $key;
  $titles[$key] = $array[$language];
}
?>

<html>
<head>
<style>
html { font-family: sans-serif; }
</style>
</head>
<body>
<h1>32c3nav QR code generator</h1>
<p>Use this site to generate QR codes for c3nav with pre-filled origin</p>
<p><a href="update_data.php">Click here</a> to update the database of available POIs.</p>
<select name="POIs[]" form="poiSelection" style="height:70vh;" multiple>

<?php
foreach ($keys as $key) {
  $title = htmlspecialchars($titles[$key]);
  echo "<option value=\"$key\">$title</option>\n";
}
?>

</select>
<form action="generate.php" id="poiSelection">
  <input type="submit" value="Generate" style="margin-top: 10px;">
</form>
</body>
</html>
