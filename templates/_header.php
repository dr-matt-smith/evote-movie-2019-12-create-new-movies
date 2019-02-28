<?php
if(empty($pageTitle)){
    $pageTitle = '';
}

if(empty($homePageStyle)) $homePageStyle = '';
if(empty($aboutPageStyle)) $aboutPageStyle = '';
if(empty($contactPageStyle)) $contactPageStyle = '';
if(empty($sitemapPageStyle)) $sitemapPageStyle = '';
if(empty($listPageStyle)) $listPageStyle = '';
?>
<!doctype html>
<html lang="en">
<head>
    <title>EVOTE MOVIE - <?= $pageTitle ?> page</title>
    <meta charset="utf-8">
    <style>
        @import "/css/basic.css";
        @import "/css/nav.css";
        @import "/css/footer.css";
    </style>
</head>
<body>

<header>
    <img src="/images/smithit_logo.gif" alt="logo">
</header>


<nav>
    <ul>
        <li>
            <a href="index.php" class="<?= $homePageStyle ?>">Home</a>
        </li>

        <li>
            <a href="index.php?action=about"  class="<?= $aboutPageStyle ?>">About Us</a>
        </li>

        <li>
            <a href="index.php?action=list"  class="<?= $listPageStyle ?>">Movie ratings</a>
        </li>

        <li>
            <a href="index.php?action=contact"  class="<?= $contactPageStyle ?>">Contact Us</a>
        </li>

        <li>
            <a href="index.php?action=sitemap"  class="<?= $sitemapPageStyle ?>">Site Map</a>
        </li>
    </ul>
</nav>
