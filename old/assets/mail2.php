<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = strip_tags(trim($_POST["name"]));
        $name2 = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone"]);

        // $subject = trim($_POST["subject"]);

        // $message = trim($_POST["message"]);

        // $checkbox = trim($_POST["checkbox"]);

        $recipient = "md@qamrintl.com";
        // $bcc = "";

        // Check that data was sent to the mailer.

        if ( empty($name)or empty($phone) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Set a 400 (bad request) response code and exit.

            http_response_code(400);

            echo "Please complete the form and try again.";

            exit;

        }


        // Subject
        $subject = "New enquiry from Qamrhr.com contact us by $name2";

        //Email Header
        $head = " New Contact Enquiry ";

        // Build the email content.

        $email_content = "$head\n\n\n";

        $email_content .= "Name: $name\n";

        $email_content .= "Email: $email\n\n";

        $email_content .= "Phone: $phone\n\n";

        $email_content .= "Subject: $subject\n\n";

        $email_content .= "Message:\n$message\n";

        // $email_content .= "Checkbox:\n$checkbox\n";

        // Build the email headers.

        $email_headers = "From: $name <$email>";
        $email_headers .= "Cc: qamrweb@gmail.com\r\n";
        $email_headers .= "Bcc: khan786info@gmail.com\r\n";

        // Send the email

        if (mail($recipient, $subject, $email_content, $email_headers)) {
            http_response_code(200);

            echo "Thank You! Your message has been sent.";
        }else{
            http_response_code(500);

            echo "Oops! Something went wrong and we couldn't send your message.";
        }
    }else{
        http_response_code(403);

        echo "There was a problem with your submission, please try again.";
    }

?>