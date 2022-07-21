<?php
class Album
{
    private $con;
    private $id;
    private $title;
    private $artistId;
    private $genre;
    private $artworkPath;


    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id = $id;
        $albumQuery = $this->con->query("SELECT * FROM albums WHERE id='$this->id'");
        $album = $albumQuery->fetch(PDO::FETCH_ASSOC);
        $this->title = $album['title'];
        $this->artistId = $album['artist'];
        $this->genre = $album['genre'];
        $this->artworkPath = $album['artworkPath'];
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getArtworkPath()
    {
        return $this->artworkPath;
    }
    public function getArtist()
    {
        return new Artist($this->con, $this->artistId);
    }
    public function getGenre()
    {
        return $this->genre;
    }
    public function getNumberOfSongs()
    {
        $query = $this->con->query("SELECT id FROM songs WHERE album='$this->id'");
        return $query->rowCount();
    }

    public function getSongIds()
    {
        $query = $this->con->query("SELECT id FROM songs WHERE album ='$this->id' ORDER BY albumOrder ASC ");
        $array = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            array_push($array, $row['id']);
        }
        return $array;
    }
}
