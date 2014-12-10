<?php

//Comment whichever one isn't being used.
require_once '../Data/DataAccessPDOMySQL.php';
//require_once '../Data/DataAccessPDOSQLite.php';

abstract class aDataAccess
{
    private static $m_DataAccess;

    public static function getInstance()
    {
        // singleton
        if(self::$m_DataAccess == null)
        {
            self::$m_DataAccess = new DataAccessPDOMySQL();
            //self::$m_DataAccess = new DataAccessPDOSQLite();
        }
        return self::$m_DataAccess;
    }

    public abstract function connectToDB();

    public abstract function closeDB();

    public abstract function selectTracks($start,$count);

    public abstract function fetchTracks();

    public abstract function selectAllTracks();

    public abstract function selectTrackById($trackId);


    // Fetch individual columns
    public abstract function fetchTrackID($row);

    public abstract function fetchTrackName($row);

    public abstract function fetchTrackAlbum($row);

    public abstract function fetchTrackArtist($row);

    public abstract function fetchTrackMediaType($row);

    public abstract function fetchTrackGenre($row);

    public abstract function fetchTrackComposer($row);

    public abstract function fetchTrackLength($row);

    public abstract function fetchTrackSize($row);

    public abstract function fetchTrackPrice($row);

}
