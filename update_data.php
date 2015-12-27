<?php
file_put_contents("titles.json", fopen("https://raw.githubusercontent.com/NoMoKeTo/c3nav/master/src/projects/32c3/titles.json", 'r'));

header("Location: index.php");
die();
?>
