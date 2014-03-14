<?php
file_put_contents("data/code", $_GET['code']);
$redirctUrl = 'getAccessToken.php';
echo "<script language=\"javascript\">";
echo "location.href=\"$redirctUrl\"";
echo "</script>";