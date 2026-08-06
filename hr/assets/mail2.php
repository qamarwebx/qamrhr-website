<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = strip_tags(trim($_POST["name"]));
    $name2 = str_replace(array("\r","\n"),array(" "," "),$name);

    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);

    $recipient = "md@qamrintl.com";

    if (empty($name) || empty($phone) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    $subject = "New enquiry from Qamrhr.com contact us by $name2";

    $email_content = "New Contact Enquiry\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";

    $email_headers = "From: QamrHR <no-reply@qamrhr.com>\r\n";
    $email_headers .= "Reply-To: $email\r\n";
    $email_headers .= "Cc: qamrweb@gmail.com\r\n";
    $email_headers .= "Bcc: khan786info@gmail.com\r\n";
    $email_headers .= "MIME-Version: 1.0\r\n";
    $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($recipient, $subject, $email_content, $email_headers)) {

        http_response_code(200);
        header("Location: ../success");
        exit;

    } else {

        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {

    http_response_code(403);
    echo "There was a problem with your submission.";

}

?>