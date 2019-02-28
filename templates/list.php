<?php
require_once __DIR__ . '/_header.php';
?>


<!-- start table for displaying DVD details -->
<h2>Lists of movies and their average votes</h2>

<table>
    <tr>
        <th> ID </th>
        <th> title </th>
        <th> price </th>
    </tr>

    <?php
        foreach($movies as $movie):
    ?>

            <tr>
                <td><?= $movie->getId() ?></td>
                <td><?= $movie->getTitle() ?></td>
                <td>&euro; <?= $movie->getPrice() ?></td>
            </tr>

    <?php
        endforeach;
    ?>

</table>

<hr>
<a href="index.php?action=newMovieForm">new movie form</a>

<?php
require_once __DIR__ . '/_footer.php';
?>