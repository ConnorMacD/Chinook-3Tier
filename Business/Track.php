<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 12/4/2014
 * Time: 10:34 AM
 */

require_once '../Business/iBusinessObject.php';
require_once '../Data/aDataAccess.php';

class Track implements iBusinessObject {
    private $m_trackId;
    private $m_name;


    private $m_album;
    private $m_artist;
    private $m_mediaType;
    private $m_genre;
    private $m_composers;
    private $m_milliseconds;
    private $m_bytes;
    private $m_unitPrice;


    public function __construct($name, $mediaType, $composers, $milliseconds, $bytes, $unitPrice, $album, $artist, $genre) {
        $this->m_name = $name;
        $this->m_album = $album;
        $this->m_artist = $artist;
        $this->m_mediaType = $mediaType;
        $this->m_genre = $genre;
        $this->m_composers = $composers;
        $this->m_milliseconds = $milliseconds;
        $this->m_bytes = $bytes;
        $this->m_unitPrice = $unitPrice;
    }

    public function getID() {
        return ($this->m_trackId);
    }

    public function getName() {
        return $this->m_name;
    }

    public function getAlbum() {
        return ($this->m_album);
    }

    public function getArtist() {
        return ($this->m_artist);
    }

    public function getMediaType() {
        return ($this->m_mediaType);
    }

    public function getGenre() {
        return ($this->m_genre);
    }

    public function getComposers() {
        return ($this->m_composers);
    }

    public function getMilliseconds() {
        return ($this->m_milliseconds);
    }

    public function getBytes() {
        return ($this->m_bytes);
    }

    public function getUnitPrice() {
        return ($this->m_unitPrice);
    }

    public static function retrieveSome($start,$count)
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectTracks($start,$count);

        //fix this
        while($row = $myDataAccess->fetchTracks())
        {
            $currentTrack = new self($myDataAccess->fetchTrackName($row), $myDataAccess->fetchTrackMediaType($row),
                                        $myDataAccess->fetchTrackComposer($row), $myDataAccess->fetchTrackLength($row),
                                        $myDataAccess->fetchTrackSize($row), $myDataAccess->fetchTrackPrice($row),
                                        $myDataAccess->fetchTrackAlbum($row), $myDataAccess->fetchTrackArtist($row),
                                        $myDataAccess->fetchTrackGenre($row));

            $currentTrack->m_trackId = $myDataAccess->fetchTrackID($row);
            $arrayOfTrackObjects[] = $currentTrack;
        }

        $myDataAccess->closeDB();

        return $arrayOfTrackObjects;
    }
    public static function retrieveAll()
    {
        $myDataAccess = aDataAccess::getInstance();
        $myDataAccess->connectToDB();

        $myDataAccess->selectAllTracks();

        //fix this
        while($row = $myDataAccess->fetchTracks())
        {
            $currentTrack = new self($myDataAccess->fetchTrackName($row), $myDataAccess->fetchTrackMediaType($row),
                $myDataAccess->fetchTrackComposer($row), $myDataAccess->fetchTrackLength($row),
                $myDataAccess->fetchTrackSize($row), $myDataAccess->fetchTrackPrice($row),
                $myDataAccess->fetchTrackAlbum($row), $myDataAccess->fetchTrackArtist($row),
                $myDataAccess->fetchTrackGenre($row));

            $currentTrack->m_trackId = $myDataAccess->fetchTrackID($row);
            $arrayOfTrackObjects[] = $currentTrack;
        }

        $myDataAccess->closeDB();

        return $arrayOfTrackObjects;
    }


    public function save()
    {
        //to update at a later date
//        $myDataAccess = aDataAccess::getInstance();
//        $myDataAccess->connectToDB();
//
//        $recordsAffected = $myDataAccess->insertCustomer($this->m_firstName,$this->m_lastName);
//
//        $myDataAccess->closeDB();
//
//        return "$recordsAffected row(s) affected!";

    }

}