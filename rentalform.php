<?php
if (isset($_GET['service'])) {
    $service = $_GET['service'];
    // $service is an array of selected values
}


$Name = Trim(stripslashes($_GET['Name'])); 
$Phone = Trim(stripslashes($_GET['Phone'])); 
$Email = Trim(stripslashes($_GET['Email'])); 
$Message = Trim(stripslashes($_GET['Message'])); 


$EmailFrom = $Email;
$EmailTo = "courthendricks@gmail.com";
$Subject = "Fairgrounds Rental Request Form";

$headers .='X-Mailer: PHP/' . phpversion();
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 


// validation
$validationOK=true;
if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.htm\">";
  exit;
}

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $Name;
$Body .= "\n";
$Body .= "\n";
$Body .= "Phone: ";
$Body .= $Phone;
$Body .= "\n";
$Body .= "\n";
$Body .= "Email: ";
$Body .= $Email;
$Body .= "\n";
$Body .= "\n";
$Body .= "Message: ";
$Body .= $Message;
$Body .= "\n";
$Body .= "\n";


// send email 
$success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");

// redirect to success page 
if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=rentalsuccess.html\">";	
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=404.html\">";
}
?>