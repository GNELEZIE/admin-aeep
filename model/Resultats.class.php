<?php
class Resultats {
    public  function  __construct(){
        $this->bdd = bdd();
    }


    public function getNote($miss_id){
        $query = "SELECT SUM(not_es) as solde FROM resultats
        WHERE  miss_id = :miss_id AND checked = 1";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "miss_id" => $miss_id
        ));
        return $rs;
    }

    public function getMissByQId22($q_id){
        $query = "SELECT DISTINCT q_id FROM resultats WHERE q_id = :q_id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "q_id" => $q_id
        ));

        return $rs;
    }



    public function getMissByQId($q_id){
        $query = "SELECT * FROM resultats WHERE q_id = :q_id AND checked  = 1";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "q_id" => $q_id
        ));

        return $rs;
    }
    public function getMissById_2($miss_id){
        $query = "SELECT DISTINCT q_id FROM resultats
        WHERE miss_id = :miss_id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "miss_id" => $miss_id
        ));

        return $rs;
    }

    public function getMissByRepId($rep_id,$id_reponses){
        $query = "SELECT * FROM resultats
                  INNER JOIN reponses ON id_reponses = rep_id
        WHERE rep_id = :rep_id AND id_reponses =:id_reponses ";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "rep_id " => $rep_id,
            "id_reponses " => $id_reponses
        ));

        return $rs;
    }

    public function getMissById($miss_id){
        $query = "SELECT * FROM resultats
                  INNER JOIN questions ON id_questions = q_id
        WHERE miss_id = :miss_id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "miss_id" => $miss_id
        ));

        return $rs;
    }

    public function getAllResult(){
        $query = "SELECT * FROM resultats WHERE checked  = 1 ORDER BY id_resultats DESC ";
        $rs = $this->bdd->query($query);
        return $rs;
    }

    public function deleteResult($id){

        $query = "DELETE  FROM resultats WHERE miss_id  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }

    public function updateData2($propriete,$val,$id){
        $query = "UPDATE resultats
            SET $propriete = :val
            WHERE q_id = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;
    }

    public function updateData($propriete,$val,$id){
        $query = "UPDATE resultats
            SET $propriete = :val
            WHERE id_resultats = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "val" => $val,
            "id" => $id
        ));

        $nb = $rs->rowCount();
        return $nb;
    }

}
// Instance

$resultats = new Resultats();