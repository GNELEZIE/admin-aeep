<?php
class Resultats {
    public  function  __construct(){
        $this->bdd = bdd();
    }


    public function getNote($miss_id){
        $query = "SELECT SUM(not_es) as solde FROM resultats
        WHERE  miss_id = :miss_id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "miss_id" => $miss_id
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


    public function deleteResult($id){

        $query = "DELETE  FROM resultats WHERE miss_id  = :id";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "id" => $id

        ));

        $nb = $rs->rowCount();
        return $nb;

    }


}
// Instance

$resultats = new Resultats();