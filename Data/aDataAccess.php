<?php

//Comment whichever one isn't being used.
//require_once '../Data/DataAccessPDOMySQL.php';
//require_once '../Data/DataAccessPDOSQLite.php';

abstract class aDataAccess
{
    private static $m_DataAccess;

    public static function getInstance()
    {
        // singleton
        if(self::$m_DataAccess == null)
        {
            //self::$m_DataAccess = new DataAccessPDOMySQL();
            //self::$m_DataAccess = new DataAccessPDOSQLite();
        }
        return self::$m_DataAccess;
    }

    public abstract function connectToDB();

    public abstract function closeDB();

    public abstract function selectTracks($start,$count);

    public abstract function fetchTracks();


    // Fetch individual columns
    public abstract function fetchSongID($row);

    public abstract function fetchSongName($row);

    public abstract function fetchSongAlbum($row);

    public abstract function fetchSongArtist($row);

    public abstract function fetchSongMediaType($row);

    public abstract function fetchSongGenre($row);

    public abstract function fetchSongComposers($row);

    public abstract function fetchSongMilliseconds($row);

    public abstract function fetchSongBytes($row);

    public abstract function fetchSongUnitPrice($row);

}
