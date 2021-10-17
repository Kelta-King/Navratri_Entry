<?php

if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['house_no'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $house_no = $_POST['house_no'];

    $obj = new StdClass;
    $obj->fname = $fname;
    $obj->lname = $lname;
    $obj->house_no = $house_no;

    $json_details = json_encode($obj);

    // DB connect
    $db = "u846092839_Entry_pass";
    $uname = "u846092839_person";
    $upass = "HelloWorld1234";
    $server_name = "localhost";
    
    $conn = new mysqli($server_name, $uname, $upass, $db);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 

    $query = "SELECT person_id from persons WHERE house_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $house_no);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows >= 1){
        $err = "This house number is already registered";
    }
    else{
        $query = "INSERT INTO persons (fname, lname, house_no) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $fname, $lname, $house_no);
        $stmt->execute();

        $name = $fname." ".$lname;
        $file_name = $name."_pass";
        $obj = new StdClass;
        $obj->fname = $fname;
        $obj->lname = $lname;
        $obj->house_no = $house_no;

        $json_details = json_encode($obj);

    }

    // DB end
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="CSS/form.css">
</head>
<body class='w3-light-gray'>
     <div class='w3-top w3-green w3-padding w3-large'>
        Navaratri Entry registration
    </div>
    <div class='w3-content'>
        <div class='w3-padding w3-round w3-white' style="margin-top:100px;">
            <div class="w3-center w3-padding">
                <b> Please fill the following form to register </b>
            </div>
            <form method="post" id="vals">
                <div class="w3-center w3-text-red" id="error_field"><?php echo $err ?></div>
                <div class='w3-section'>
                    <div class='w3-row'>
                        <div class='w3-col l6 m6 s6'>
                            <div class='w3-padding'>
                                <label for="fname"> First name </label>
                                <input type="text" value="" class='w3-input w3-round w3-border' id="fname"
                                placeholder="First name" required>
                            </div>
                        </div>
                        <div class='w3-col l6 m6 s6'>
                            <div class='w3-padding'>
                                <label for="lname"> Last name </label>
                                <input type="text" value="" class='w3-input w3-round w3-border' id="lname"
                                placeholder="Last name" required>
                            </div>
                        </div>
                    </div>
                    <div class="w3-section">
                        <div class="w3-padding">
                            <label for="house_no"> House No. </label>
                            <input type="text" id="house_no" value="" class="w3-input w3-round w3-border"
                            placeholder="House number" required>
                        </div>
                    </div>
                    <div class='w3-section w3-center'>
                        <button id="register_btn" class="w3-button w3-round w3-blue w3-hover-green">
                            <i class="fa fa-plus"></i> Register </button>
                    </div>
                </div>
            </form>
            <?php
                if(isset($name) && isset($json_details)){
            ?>
            <div class="w3-padding-16"></div>
            <div class="w3-border w3-round w3-margin" id="qrcode">
        
                <div class="w3-content w3-border w3-round w3-padding-32 w3-margin-top" id="code" style="max-width:500px;">
                    <div class="w3-center">
                        Here is your <br> <b> Digital QR code pass </b>
                    </div>
                    <div class="w3-center">
                    <img src='https://keltaedu.tech/qr_code.php?name=<?php echo $json_details ?>' class="w3-image">
                    </div>
                    <div class="w3-padding w3-large w3-margin-bottom w3-center">
                        <b> <?php echo $name ?> </b>
                    </div>
                </div>
                <div class="w3-center w3-padding">
                    <button class="w3-button w3-round w3-green w3-hover-blue" onclick="divToPdf('code', '<?php echo $file_name ?>')"> 
                        <i class='fa fa-download'></i> Download PDF
                    </button>
                </div>
                
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    <script src="Js/form.js"></script>
</body>
</html>