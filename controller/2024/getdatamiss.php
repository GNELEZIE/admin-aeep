<?php
$option_data ='';
if(isset($_SESSION['useraeep']) and isset($_SESSION['myformkey']) and isset($_POST['token']) and $_SESSION['myformkey'] == $_POST['token']) {
    $qust = $questions->getAllQuestion();
    while($qustData = $qust->fetch()){
        $option_data .='<option value="'.$qustData['id_questions'].'">'.html_entity_decode(stripslashes($qustData['quest_t'])).'</option>';
    }


}



$output = array(
    'option_data' => $option_data
);
echo json_encode($output);