<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 12/9/2014
 * Time: 7:04 PM
 */
    session_start();
    if(!empty($_GET['addId'])) {
        $id = $_GET['addId'];
        $_SESSION['cart'][] = $id;
        die("Added!");
    }

//    if($_POST['destroy']) {
//        session_destroy();
//        header("Location: searchRecords.php");
//    }

?>


<html>

<head>
    <title>Chinook Database</title>
    <link rel="stylesheet" href="css/app.css"/>
</head>

<body>
<h1>Shopping Cart:</h1>
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
    </tr>
    </thead>

    <tbody>
    <?php if (isset($_SESSION['cart'])) :
        require("../Business/Track.php");

        $arrayOfIds = $_SESSION['cart'];
        $totalCost = 0.00;
        $tax = 1.15;

        foreach($arrayOfIds as $trackId):
            $track = Track::retrieveSpecific($trackId);
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
                <td><?php echo $track->getUnitPrice(); $totalCost += $track->getUnitPrice();?></td>
            </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="8">
        </td>
        <td colspan="2">
            <?php
                //TODO: Add "Clear Cart" function and Checkout page.
            ?>
            <form action="checkOut.php" method="post">
                Subtotal: <?php echo $totalCost; ?><br/>
                + Tax: <?php echo (($totalCost * ($tax - 1)));?><br/>
                <hr>
                Total: <?php echo ($totalCost * $tax); ?>
            </form>
        </td>
    </tr>
    <?php else:?>
    <tr>
        <td colspan="10">Nothing in cart!</td>
    </tr>
    <?php endif; ?>
    </tbody>
</table>


</body>
</html>

