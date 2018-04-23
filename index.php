<?php

require __DIR__ . '/vendor/autoload.php';

use App\DomainAvailability;

?>

<html>
<head>
    <title>Domain Availability</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<form action="<?=$_SERVER['PHP_SELF'];?>">
    <p><b><label for="domain">Domain/IP Address:</label></b>
        <input type="text" name="domain" id="domain" value="<?php echo @$_GET['domain']; ?>">
        <input type="submit" value="Submit"></p>
</form>
<?php
if (isset($_GET['domain'])) {
    $domain = trim($_GET['domain']);

    if (substr(strtolower($domain), 0, 7) == "http://") {
        $domain = substr($domain, 7);
    }
    if (substr(strtolower($domain), 0, 4) == "www.") {
        $domain = substr($domain, 4);
    }

    $domain_availability = new DomainAvailability();

    if ($domain_availability->ValidateIP($domain)) {
        $result = $domain_availability->LookupIP($domain);
    }
    elseif ($domain_availability->ValidateDomain($domain)) {
        $result = $domain_availability->LookupDomain($domain);
    }
    else die("Invalid Input!");
    echo "<pre>\n" . $result . "\n</pre>\n";
}
?>
</body>
</html>