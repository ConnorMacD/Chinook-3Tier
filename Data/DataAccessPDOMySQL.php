<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 12/4/2014
 * Time: 11:03 AM
 */

require_once 'aDataAccess.php';
class DataAccessPDOMySQL extends aDataAccess
{

    private $dbConnection;
    private $result;
    private $stmt;


    public function connectToDB() {
        try
        {
            $this->dbConnection = new PDO("mysql:host=localhost;dbname=chinook","chinchompa","7wSArtq9X6ADvZud");
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex)
        {
            die('Could not connect to the Chinook Database via PDO: ' . $ex->getMessage());
        }
    }

    public function closeDB()
    {
        // set a PDO connection object to null to close it
        $this->dbConnection = null;
    }

    public function selectTracks($start,$count)
    {
        try {


            $this->stmt = $this->dbConnection->prepare('SELECT track.TrackId, track.Name, album.Title AS trackAlbum,artist.Name as trackArtist, mediatype.Name as mediaType,genre.Name as genreName, track.Composer, track.Milliseconds,track.Bytes, track.UnitPrice FROM track
                JOIN album JOIN mediatype JOIN artist JOIN genre WHERE track.MediaTypeId = mediatype.MediaTypeId AND track.genreId = genre.GenreId AND track.AlbumId = album.AlbumId AND album.ArtistId = artist.ArtistId ORDER BY track.TrackId ASC LIMIT :start, :count');
            $this->stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $this->stmt->bindParam(':count', $count, PDO::PARAM_INT);

            $this->stmt->execute();
        } catch (PDOException $ex) {
            die('Could not select records from Chinook Database via PDO: ' . $ex->getMessage());
        }
    }

    public function fetchTracks()
    {
        try
        {
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            return $this->result;
        }
        catch(PDOException $ex)
        {
            die('Could not retrieve from Chinook Database via PDO: ' . $ex->getMessage());
        }
    }

    public function selectAllTracks() {
        try {
            $this->stmt = $this->dbConnection->prepare('SELECT track.TrackId, track.Name, album.Title AS trackAlbum,artist.Name as trackArtist, mediatype.Name as mediaType,genre.Name as genreName, track.Composer, track.Milliseconds,track.Bytes, track.UnitPrice FROM track
                JOIN album JOIN mediatype JOIN artist JOIN genre WHERE track.MediaTypeId = mediatype.MediaTypeId AND track.genreId = genre.GenreId AND track.AlbumId = album.AlbumId AND album.ArtistId = artist.ArtistId ORDER BY track.TrackId');
            $this->stmt->execute();
        } catch (PDOException $ex) {
            die('Could not select records from Chinook Database via PDO: ' . $ex->getMessage());
        }
    }

    public function fetchTrackID($row)
    {
        return $row['TrackId'];
    }

    public function fetchTrackName($row)
    {
        return $row['Name'];
    }

    public function fetchTrackAlbum($row)
    {
        return $row['trackAlbum'];
    }

    public function fetchTrackArtist($row)
    {
        return $row['trackArtist'];
    }

    public function fetchTrackMediaType($row) {
        return $row['mediaType'];
    }

    public function fetchTrackGenre($row) {
        return $row['genreName'];
    }

    public function fetchTrackComposer($row)
    {
        return $row['Composer'];
    }

    public function fetchTrackLength($row)
    {
        return $row['Milliseconds'];
    }

    public function fetchTrackSize($row)
    {
        return $row['Bytes'];
    }

    public function fetchTrackPrice($row)
    {
        return $row['UnitPrice'];
    }

//    public function insertCustomer($firstName,$lastName)
//    {
//        try
//        {
//            $this->stmt = $this->dbConnection->prepare('INSERT INTO customer(store_id,first_name,last_name,address_id) VALUES(1, :firstName, :lastName, 1)');
//            $this->stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
//            $this->stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
//
//            $this->stmt->execute();
//
//            return $this->stmt->rowCount();
//        }
//        catch(PDOException $ex)
//        {
//            die('Could not insert record into ChinooDatabase via PDO: ' . $ex->getMessage());
//        }
//
//    }

}

?>
