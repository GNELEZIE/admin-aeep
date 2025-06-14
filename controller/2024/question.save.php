<?php

if(isset($_SESSION['useraeep']) and isset($_SESSION['myformkey']) and isset($_POST['formkey']) and $_SESSION['myformkey'] == $_POST['formkey']) {
    extract($_POST);

    $question_ = htmlentities(trim(addslashes(strip_tags($question_))));
    $addQuest = $questions->addQuestion($dateGmt,$question_);

    if($addQuest > 0){
        echo 'ok';
    }

}
