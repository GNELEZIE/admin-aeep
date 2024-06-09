<?php
class Reunion {
    public  function  __construct(){
        $this->bdd = bdd();
    }


    public function inscritsForSortie(){
        $query = "SELECT * FROM sortie ORDER BY id_sortie DESC";
        $rs = $this->bdd->query($query);

        return $rs;
    }
    public function deleteSortie($id){

        $query = "DELETE  FROM sortie WHERE id_sortie  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }
    public function updateEtatSortie($propriete1,$val1,$id){
        $query = "UPDATE sortie
            SET $propriete1 = :val1 WHERE id_sortie  = :id ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val1" => $val1,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;

    }

    public function getAllINscrits(){
        $query = "SELECT * FROM reunion ORDER BY id_reunion DESC";
        $rs = $this->bdd->query($query);

        return $rs;
    }





    public function getMembreByEmail($mail){

        $query = "SELECT * FROM reunion
        WHERE email = :mail";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "mail" => $mail
        ));

        return $rs;
    }
    public function getMmembreById($id){

        $query = "SELECT * FROM membre
        WHERE id_membre = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id
        ));

        return $rs;
    }

    //Count

    public function nbrMmembre(){
        $query = "SELECT COUNT(*) as nb FROM membre";
        $rs = $this->bdd->query($query);
        return $rs;
    }
    public function nbSortie(){
        $query = "SELECT COUNT(*) as nb FROM sortie
                  WHERE etat = 1";
        $rs = $this->bdd->query($query);
        return $rs;
    }






}
// Instance

$reunion = new Reunion();