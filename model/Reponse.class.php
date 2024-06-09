<?php
class Reponses {
    public  function  __construct(){
        $this->bdd = bdd();
    }


    public function addReponse($question_id,$reponse_s,$point){
        $query = "INSERT INTO reponses(question_id,reponse_s,point)
            VALUES (:question_id,:reponse_s,:point)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "question_id" => $question_id,
            "reponse_s" => $reponse_s,
            "point" => $point
        ));

        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }


    // Read
    public function getAllQuestion(){
        $query = "SELECT * FROM reponses ORDER BY id_reponses DESC";
        $rs = $this->bdd->query($query);
        return $rs;
    }
// Count
    public function getRepByQuId($Qid){
        $query = "SELECT * FROM reponses
        WHERE question_id = :Qid";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "Qid" => $Qid
        ));

        return $rs;
    }

    public function nbRepByQuId($Qid){
        $query = "SELECT COUNT(*) as nb FROM reponses
        WHERE question_id = :Qid";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "Qid" => $Qid
        ));

        return $rs;
    }



    // Delete
    public function deleteRepByQid($id){

        $query = "DELETE  FROM reponses WHERE question_id  = :id";
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

$reponses = new Reponses();