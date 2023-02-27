<?php
class Carte {
    public  function  __construct(){
        $this->bdd = bdd();
    }





    // Read
    public function getAllCarte(){
        $query = "SELECT * FROM carte ORDER BY id_carte DESC";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    public function getUserBySlug($slg){
        $query = "SELECT * FROM carte
        WHERE slug = :slg";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "slg" => $slg
        ));

        return $rs;
    }
    public function getCarteById($id){
        $query = "SELECT * FROM carte
        WHERE id_carte = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        return $rs;
    }


// Count
    public function getNbAllCarteValid(){
        $query = "SELECT COUNT(*) as nb FROM carte
                  WHERE statut = 1";
        $rs = $this->bdd->query($query);

        return $rs;
    }
    public function getNbAllCarteEnAttent(){
        $query = "SELECT COUNT(*) as nb FROM carte
                  WHERE statut = 0";
        $rs = $this->bdd->query($query);

        return $rs;
    }
    public function getNbAllCarte(){
        $query = "SELECT COUNT(*) as nb FROM carte";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    // Update

    public function updateValider($etat,$id){
        $query = "UPDATE carte
            SET statut = :etat
            WHERE id_carte = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "etat" => $etat,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }
    public function updateEtat($etat,$id){
        $query = "UPDATE carte
            SET etat = :etat
            WHERE id_carte = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "etat" => $etat,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }
    // Delete
    public function deleteCarte($id){

        $query = "DELETE  FROM carte WHERE id_carte  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }


    // Verification valeur existant
    public function verifUtilisateur($propriete,$val){

        $query = "SELECT * FROM admin WHERE $propriete = :val";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val
        ));

        return $rs;
    }


    // update




    public function updateData2($propriete1,$val1,$propriete2,$val2,$id){
        $query = "UPDATE carte
            SET $propriete1 = :val1, $propriete2 = :val2
            WHERE id_carte = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val1" => $val1,
            "val2" => $val2,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;
    }



}
// Instance

$carte = new Carte();