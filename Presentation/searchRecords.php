<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/app.css"/>
        <link rel="stylesheet" href="css/jquery.dataTables.min.css"/>
        <script src="js/jquery.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/myGrid.js"></script>
    </head>
    <body>
        <h1>Available Tracks:</h1>
        <?php session_start(); ?>
        <h3><a href="ShoppingCart.php">View Cart</a> - <?php
            if (isset($_SESSION['authenticated'])) {
                echo ("Welcome, " . $_SESSION['accountName']);
            } else {
                echo ("<a href=\"loginAccount.php\">Please log in</a>");
            }
            ?></h3>
        <section>
            <table id="grid">
                <thead>
                    <tr>
                        <th colspan="11">
                            Available Music
                        </th>
                    </tr>
                    <tr>
                        <th>Track ID</th>
                        <th>Name</th>
                        <th>Album</th>
                        <th>Artist</th>
                        <th>Media Type</th>
                        <th>Genre</th>
                        <th>Composer(s)</th>
                        <th>Milliseconds</th>
                        <th>Bytes</th>
                        <th>Unit Price</th>
                        <th>Add to Cart</th>
                    </tr>
                </thead>

                <tbody>

                <?php

                if (isset($_SESSION['cart'])) {
                    $cart = $_SESSION['cart'];
                } else {
                    $cart[] = "";
                }

                require("../Business/Track.php");
                $arrayOfTracks = Track::retrieveAll();

                foreach($arrayOfTracks as $track):
                    ?>
                    <tr>
                        <td class="id"><?php echo $track->getID(); ?></td>
                        <td><?php echo $track->getName(); ?></td>
                        <td><?php echo $track->getAlbum(); ?></td>
                        <td><?php echo $track->getArtist(); ?></td>
                        <td><?php echo $track->getMediaType(); ?></td>
                        <td><?php echo $track->getGenre(); ?></td>
                        <td><?php echo $track->getComposers(); ?></td>
                        <td><?php echo $track->getMilliseconds(); ?></td>
                        <td><?php echo $track->getBytes(); ?></td>
                        <td><?php echo $track->getUnitPrice(); ?></td>
                        <td><button class=<?php echo (in_array($track->getID(), $cart) ? "\"add\" disabled>In Cart" : "\"add enabled\">Add to Cart" ) ?></button></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </section>
    </body>
</html>