<?php

class Playlist
{

    private $con;
    private $id;
    private $name;
    private $owner;
    public function __construct($con, $data)
    {

        if (!is_array($data)) {
            // Data is an id (string)
            $query = $con->query("SELECT * FROM playlists WHERE id='$data' ");
            $data = $query->fetch(PDO::FETCH_ASSOC);
        }
        $this->con = $con;
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->owner = $data['owner'];
    }


    public function getName()
    {
        return $this->name;
    }

    public function getOwner()
    {
        return $this->owner;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getNumberOfSongs()
    {
        $query = $this->con->query("SELECT songId FROM playlistsongs WHERE playListId =
         '$this->id'");
        return $query->rowCount();
    }


    public function getSongIds()
    {
        $query = $this->con->query("SELECT songId FROM playlistsongs WHERE playlistId ='$this->id' ORDER BY playlistOrder ASC ");
        $array = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            array_push($array, $row['songId']);
        }
        return $array;
    }

    public static function getPlayListsDropdown($con, $username)
    {
        $dropdown = '<select class="item playlist">
        <option value="">Ajouter au liste de lecture</option>';

        $query = $con->query("SELECT id, name FROM playlists WHERE owner ='$username' ");

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $name = $row['name'];
            $dropdown = $dropdown . "<option value='$id'>$name</option>";
        }

        return $dropdown . " </select>";
    }
}
