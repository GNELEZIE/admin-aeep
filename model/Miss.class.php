<?php
class Miss {
    public  function  __construct(){
        $this->bdd = bdd();
    }

    // Read
    public function getAllQuestion(){
        $query = "SELECT * FROM miss ORDER BY id_miss DESC";
        $rs = $this->bdd->query($query);
        return $rs;
    }
// Count

    public function getNbAllCarteEnAttent(){
        $query = "SELECT COUNT(*) as nb FROM miss
                  WHERE ty = 0";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    // Update


    // Delete
    public function deleteQuestion($id){

        $query = "DELETE  FROM miss WHERE id_miss  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }


    // Verification valeur existant


    // update



}
// Instance

$miss = new Miss();