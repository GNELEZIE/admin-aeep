<?php
class Miss {
    public  function  __construct(){
        $this->bdd = bdd();
    }

    // Read
    public function getAllMiss(){
        $query = "SELECT * FROM miss ORDER BY note DESC";
        $rs = $this->bdd->query($query);
        return $rs;
    }
    public function getMissBySlug($slg){
        $query = "SELECT * FROM miss
        WHERE slug = :slg";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "slg" => $slg
        ));

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
    public function updateData($propriete,$val,$id){
        $query = "UPDATE miss
            SET $propriete = :val
            WHERE id_miss = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;
    }

    // Delete
    public function deleteMiss($id){

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