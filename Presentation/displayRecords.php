<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 12/3/2014
 * Time: 6:25 PM
 */

?>
<html>

    <head>
        <title>Chinook Database</title>
        <link rel="stylesheet" href="css/app.css"/>
    </head>

    <body>
        <h1>Current Tracks:</h1>
        <table border="1">
            <thead>
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
            
                (isset($_GET['num']) ? $limit = (int)$_GET['num'] : $limit = 0);
            
                require("../Business/Track.php");
                $arrayOfTracks = Track::retrieveSome($limit,10);
            
                foreach($arrayOfTracks as $track):
            ?>
            <tr>
                <td><?php echo $track->getID(); ?></td>
                <td><?php echo $track->getName(); ?></td>
                <td><?php echo $track->getAlbum(); ?></td>
                <td><?php echo $track->getArtist(); ?></td>
                <td><?php echo $track->getMediaType(); ?></td>
                <td><?php echo $track->getGenre(); ?></td>
                <td><?php echo $track->getComposers(); ?></td>
                <td><?php echo $track->getMilliseconds(); ?></td>
                <td><?php echo $track->getBytes(); ?></td>
                <td><?php echo $track->getUnitPrice(); ?></td>
                <td><a href="cart.php?add=<?php echo $track->getID(); ?>">Add to Cart</a></td>
            </tr>
            <?php endforeach;?>
                <tr>
                    <td colspan="11">
                        <a href="displayRecords.php?num=<?php echo ($limit != 0 ? $limit - 10 : $limit)?>" class="left">Previous 10 Songs</a>
                        <a href="displayRecords.php?num=<?php echo ($limit + 10); ?>" class="right">Next 10 Songs</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>