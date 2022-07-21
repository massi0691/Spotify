<?php
class Song
{
    private $con;
    private $id;
    private $queryData;
    private $title;
    private $artistId;
    private $albumId;
    private $genre;
    private $duration;
    private $path;



    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id = $id;
        $query = $this->con->query("SELECT * FROM songs WHERE id='$this->id'");
        $this->queryData = $query->fetch(PDO::FETCH_ASSOC);
        $this->title = $this->queryData['title'];
        $this->artistId = $this->queryData['artist'];
        $this->albumId = $this->queryData['album'];
        $this->genre = $this->queryData['genre'];
        $this->duration = $this->queryData['duration'];
        $this->path = $this->queryData['path'];
    }


    public function getTitle()
    {
        return $this->title;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getArtist()
    {
        return new Artist($this->con, $this->artistId);
    }


    public function getAlbum()
    {
        return new Album($this->con, $this->albumId);
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getDuration()
    {
        return $this->duration;
    }
    public function getPath()
    {
        return $this->path;
    }
    public function getQueryData()
    {
        return $this->queryData;
    }
}
