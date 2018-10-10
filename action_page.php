<?php
/* Set e-mail recipient */
$myemail  = "noreply@stormcoastdesign.com";

/* Check all form inputs using check_input function */
$yourname = check_input($_POST['yourname'], "  Please enter your name");
$email    = check_input($_POST['email'], "Please enter your email");
$website  = check_input($_POST['website']);
$comments = check_input($_POST['comments']);
$today = date("d/m/Y");
$subject = "Contact Form Submission";

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* If URL is not valid set $website to empty */
if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
{
    $website = '';
}

/* Prepare message for the e-mail */
$message = "$today:

Your contact form has been submitted by:

Name: $yourname
E-mail: $email
URL: $website

Comments:
$comments

End of message
";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: thanks.htm');
exit();

/* Functions used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>
