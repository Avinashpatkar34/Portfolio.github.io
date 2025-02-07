<?php
  // Set your receiving email address
  $receiving_email_address = 'patkaravinash9@gmail.com';

  // Check if the PHP Email Form library exists
  if (file_exists($php_email_form = __DIR__ . '/../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
  } else {
    die('Error: Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  $contact->to = $receiving_email_address;

  // Validate and set sender details
  if (isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    $contact->from_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $contact->from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $contact->subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);

    // Add message details
    $contact->add_message($contact->from_name, 'From');
    $contact->add_message($contact->from_email, 'Email');
    $contact->add_message(filter_var($_POST['message'], FILTER_SANITIZE_STRING), 'Message', 10);

    // Uncomment below if you want to use SMTP
    /*
    $contact->smtp = array(
      'host' => 'smtp.example.com',
      'username' => 'your_username',
      'password' => 'your_password',
      'port' => '587'
    );
    */

    echo $contact->send();
  } else {
    die('Error: All form fields are required!');
  }
?>
