<?php
class Questions {
    public  function  __construct(){
        $this->bdd = bdd();
    }


    public function addQuestion($date_questions,$quest_t){
        $query = "INSERT INTO questions(date_questions,quest_t)
            VALUES (:date_questions,:quest_t)";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "date_questions" => $date_questions,
            "quest_t" => $quest_t
        ));

        $nb = $rs->rowCount();
        if($nb > 0){
            $r = $this->bdd->lastInsertId();
            return $r;
        }
    }


    // Read
    public function getQById($Qid){
        $query = "SELECT * FROM questions
        WHERE id_questions = :Qid";
        $rs = $this->bdd->prepare($query);
        $rs->execute(array(
            "Qid" => $Qid
        ));

        return $rs;
    }
    public function getAllQuestion(){
        $query = "SELECT * FROM questions ORDER BY id_questions DESC";
        $rs = $this->bdd->query($query);
        return $rs;
    }
// Count

    public function getNbAllCarteEnAttent(){
        $query = "SELECT COUNT(*) as nb FROM questions
                  WHERE ty = 0";
        $rs = $this->bdd->query($query);

        return $rs;
    }

    // Update


    // Delete
    public function deleteQuestion($id){

        $query = "DELETE  FROM questions WHERE id_questions  = :id";
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

$questions = new Questions();