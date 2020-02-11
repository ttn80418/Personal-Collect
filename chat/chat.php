<?php
    $db = mysqli_connect('localhost', 'root', '', 'chat');
    if($db->connect_error){
        die("Connection Fail:". $db->connect_error);
    }

    $result = array();
    $message = isset($_POST['message']) ? $_POST['message']: null;//?和if類似 判斷
    $from = isset($_POST['from']) ? $_POST['from'] : null;

    if(!empty($message) && !empty($from)){
        $sql = "INSERT INTO  `chat` (  `message`,  `from`) Values ('".$message. "', '" . $from . "')";//將table用反引號 `  否則會報錯
        //echo $sql;
        $result['send_status'] = $db->query($sql);
    }

//print message
    $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
    $items = $db->query("SELECT * FROM `chat` WHERE `id` >" . $start);
    while($row = $items->fetch_assoc()){
        $result['items'][] = $row;
    }


    $db->close();

    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    echo json_encode($result);
?>