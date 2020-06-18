<?php
if(isset($_POST['email'])) {
$email_to = "owais1998@live.com";
$email_subject = "Summarized propose of the email";
//Errors to show if there is a problem in form fields.
function died($error) {
    echo "We are sorry that we can procceed your request due to error(s)";
    echo "Below is the error(s) list <br /><br />";
    echo $error."<br /><br />";
    echo "Please go back and fix these errors.<br /><br />";
    die();
}
// validation expected data exists
if(!isset($_POST['first_name']) ||
       !isset($_POST['email']) ||
       !isset($_POST['subject']) ||
       !isset($_POST['message'])) {
    died('We are sorry to proceed your request due to error within form entries');   
}
$first_name = $_POST['name']; // required
$email_from = $_POST['email']; // required
   $subject = $_POST['subject']; // not required
$message = $_POST['message']; // required
$error_message = "";
$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 if(!preg_match($email_exp,$email_from)) {
$error_message .= 'You entered an invalid email<br />';
 }
$string_exp = "/^[A-Za-z .'-]+$/";
 if(!preg_match($string_exp,$name)) {
$error_message .= 'Invalid first name<br />';
 }
 if(strlen($subject) < 2) {
$error_message .= 'Invalid subject<br />';
 }
 if(strlen($error_message) > 0) {
   died($error_message);
 }
$email_message = "Form details below.\n\n";
function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}
$email_message .= "First Name: ".clean_string($first_name)."\n";
$email_message .= "Email: ".clean_string($email_from)."\n";
$email_message .= "Subject: ".clean_string($subject)."\n";
$email_message .= "Message: ".clean_string($message)."\n";
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>
