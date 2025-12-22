<?php   
    require("./mailing/mailfunction.php");

    $name    = htmlspecialchars(trim($_POST['name']));
    $phone   = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $email   = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));


    $body = "<ul><li>Name: ".$name."</li><li>Phone: ".$phone."</li><li>Email: ".$email."</li><li>Message: ".$message."</li></ul>";

    $status = mailfunction("info@ak-globalservices.org", "Company", $body); //reciever
    if($status)
        echo "<script>
            alert('Thanks! We will contact you soon.');
            window.location.href = 'contact.html";
    else {
    echo "<script>
            alert('Error sending message. Please try again.');
            window.location.href = 'contact.html';
        </script>";
    echo '<p style="color:red;">' . $mail->ErrorInfo . '</p>'; // <-- print the real reason
}
?>