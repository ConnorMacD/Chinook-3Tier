<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 12/9/2014
 * Time: 2:36 PM
 */

require_once 'aDataAccess.php';
class DataAccessPDOSQLite extends aDataAccess {

    private $dbConnection;
    private $result;
    private $stmt;


    public function connectToDB() {
        try {
            $this->dbConnection = new PDO("sqlite:db/mydb.sqlite");
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die('Could not connect to the Chinook Database via PDO: ' . $ex->getMessage());
        }
    }

    public function closeDB() {
        // set a PDO connection object to null to close it
        $this->dbConnection = null;
    }

    public function selectTracks($start, $count) {
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

    public function fetchTracks() {
        try {
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            return $this->result;
        } catch (PDOException $ex) {
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

    public function selectTrackById($trackId) {
        try {
            $this->stmt = $this->dbConnection->prepare('SELECT track.TrackId, track.Name, album.Title AS trackAlbum,artist.Name as trackArtist, mediatype.Name as mediaType,genre.Name as genreName, track.Composer, track.Milliseconds,track.Bytes, track.UnitPrice FROM track
                JOIN album JOIN mediatype JOIN artist JOIN genre WHERE track.MediaTypeId = mediatype.MediaTypeId AND track.genreId = genre.GenreId AND track.AlbumId = album.AlbumId AND album.ArtistId = artist.ArtistId AND track.TrackId = :trackId ORDER BY track.TrackId');
            $this->stmt->bindParam(':trackId', $trackId, PDO::PARAM_INT);
            $this->stmt->execute();
        } catch (PDOException $ex) {
            die('Could not select records from Chinook Database via PDO: ' . $ex->getMessage());
        }
    }

    public function fetchTrackID($row) {
        return $row['TrackId'];
    }

    public function fetchTrackName($row) {
        return $row['Name'];
    }

    public function fetchTrackAlbum($row) {
        return $row['trackAlbum'];
    }

    public function fetchTrackArtist($row) {
        return $row['trackArtist'];
    }

    public function fetchTrackMediaType($row) {
        return $row['mediaType'];
    }

    public function fetchTrackGenre($row) {
        return $row['genreName'];
    }

    public function fetchTrackComposer($row) {
        return $row['Composer'];
    }

    public function fetchTrackLength($row) {
        return $row['Milliseconds'];
    }

    public function fetchTrackSize($row) {
        return $row['Bytes'];
    }

    public function fetchTrackPrice($row) {
        return $row['UnitPrice'];
    }

}