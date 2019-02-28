<?php
require_once __DIR__ . '/_header.php';
?>

<h1>Error</h1>

the following errors occurred:
<br>

<?php
    foreach($errors as $error){
        print "- $error <br>";
    }
?>

<?php
require_once __DIR__ . '/_footer.php';
?>