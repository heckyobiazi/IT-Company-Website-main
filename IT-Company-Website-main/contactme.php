<?php   
    require("./mailing/mailfunction.php");

    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $body = "<ul><li>Name: ".$name."</li><li>Phone: ".$phone."</li><li>Email: ".$email."</li><li>Message: ".$message."</li></ul>";

    $status = mailfunction("info@akglobalservices.org", "Company", $body); //reciever
    if($status)
        echo '<center><h1>Thanks! We will contact you soon.</h1></center>';
    else {
    echo '<center><h1>Error sending message! Please try again.</h1></center>';
    echo '<p style="color:red;">' . $mail->ErrorInfo . '</p>'; // <-- print the real reason
}
?>