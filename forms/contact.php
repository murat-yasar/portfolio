<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'contact@example.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();

// ALT METHOD
//
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
//     $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
//     $subject = filter_var(trim($_POST["subject"]), FILTER_SANITIZE_STRING);
//     $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

//     if (empty($name) || empty($email) || empty($subject) || empty($message)) {
//         http_response_code(400);
//         echo "Please fill in all fields.";
//         exit;
//     }
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         http_response_code(400);
//         echo "Invalid email address.";
//         exit;
//     }

//     $to = "dev.muratyasar@gmail.com";
//     $email_subject = "New contact from $name: $subject";
//     $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
//     $headers = "From: $name <$email>";

//     if (mail($to, $email_subject, $email_body, $headers)) {
//         http_response_code(200);
//         echo "Message sent successfully.";
//     } else {
//         http_response_code(500);
//         echo "Failed to send message.";
//     }
// } else {
//     http_response_code(403);
//     echo "Forbidden";
// }
?>