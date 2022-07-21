<?php
class Artist
{
    private $con;
    private $id;

    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        $artistQuery = $this->con->query("SELECT name FROM artists  WHERE id='$this->id'");
        $artist = $artistQuery->fetch(PDO::FETCH_ASSOC);
        return $artist['name'];
    }
    public function getSongIds()
    {
        $query = $this->con->query("SELECT id FROM songs WHERE artist ='$this->id' ORDER BY plays ASC ");
        $array = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            array_push($array, $row['id']);
        }
        return $array;
    }
}
