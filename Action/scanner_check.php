<?php
if(isset($_REQUEST['details'])){
    
    $vals = json_decode($_REQUEST['details']);
    $vals = json_decode($vals);
    
    if(!(isset($vals->fname) && isset($vals->lname) && isset($vals->house_no))){
        die("Error: Wrong user1");
    }
    
    $fname = $vals->fname;
    $lname = $vals->lname;
    $house_no = $vals->house_no;
    
    // DB connect
    $db = "u846092839_Entry_pass";
    $uname = "u846092839_person";
    $upass = "HelloWorld1234";
    $server_name = "localhost";
    
    $conn = new mysqli($server_name, $uname, $upass, $db);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $query = "SELECT person_id FROM persons WHERE fname = ? AND lname = ? AND house_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $fname, $lname, $house_no);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if($result->num_rows >= 1){
        echo "Verified user";
    }
    else{
        echo "Error: Wrong user2";
    }
    
    $conn->close();
    
}
else{
    die("Something went wrong");
}

?>