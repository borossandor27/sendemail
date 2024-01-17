<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'localhost';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
    $mail->Username   = 'postmaster';                     //SMTP username
    $mail->Password   = '1234';                               //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 25;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('tanulo@127.0.0.1', 'Tanulo');
    $mail->addAddress('postmaster@localhost', 'Joe User');     //Add a recipient
    $mail->addAddress('postmaster@localhost');               //Name is optional
    $mail->addReplyTo('postmaster@localhost', 'Information');
    $mail->addCC('postmaster@localhost');
    $mail->addBCC('postmaster@localhost');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(false);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helyi levelezés beállítása a XAMPP-ban</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" integrity="sha512-72OVeAaPeV8n3BdZj7hOkaPSEk/uwpDkaGyP4W2jSzAC8tfiO4LMEDWoL3uFp5mcZu+8Eehb4GhZWFwvrss69Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js" integrity="sha512-Sct/LCTfkoqr7upmX9VZKEzXuRk5YulFoDTunGapYJdlCwA+Rl4RhgcPCLf7awTNLmIVrszTPNUFu4MSesep5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /></head>

<body>
    <div class="container">
        <section>
            <h1>Helyi levelezés beállítása a XAMPP-ban</h1>
            <p>A XAMPP-ban található Mercury levelező szerver felhasználható az alkalmazásunk levelező funkciójának a tesztelésére.</p>
            <ol>
                <li>Indítsuk el a Mercury levelező szerver szolgáltatást a XAMPP Control Panel-ben</li>
                <li>Indítsuk el a Mercury levelező adminisztrációs felületét a XAMPP Control Panel-ben <a href="images/xamppControlPanel.png" target="_blank"><i class="fa-solid fa-magnifying-glass"></i></a></li>
                <li><code>Configuration -> Protocol Modules.../</code>-ban kapcsoljuk le a Mercury HTTP szerverét
                    <ul>
                        <li>Tiltsa le a "MercuryB HTTP webszerver" jelölőnégyzetet</li>
                    </ul>
                </li>
                <li><code>Configuration -> Mercury Core Modul</code>-ban<ul>
                        <li>"Internet name for this system : localhost"</li>
                    </ul>
                </li>
                <li><code>Configuration -> Manage local user...</code></li>
                <ul>
                    <li>Állítsunk be mindenkinek jelszót</li>
                    <li>ha akarunk hozzunk létre új felhasználót</li>
                </ul>
                <li><code>Configuration -> MercuryS SMTP Server</code>
                    <ul>
                        <li>General lapon -> "Announce myself as": localhost</li>
                        <li>"Listen on TCP/IP port" -> "25"</li>
                        <li>Connection control lapon -> Add restriction to 127.0.0.1:127.0.0.1</li>
                    </ul>
                </li>
                <li><code>Configuration -> MercuryP POP3 Server</code>
                    <ul>
                        <li>"Listen on TCP port" -> "110"</li>
                        <li>"IP interface to use" -> "127.0.0.1"</li>
                        <li>Connection control lapon -> Add restriction to 127.0.0.1:127.0.0.1</li>
                    </ul>
                </li>
                <li><code>File -> Send mail message...</code></li>

            </ol> <p>Az adminisztrációs felüleleten látható a küldés, de az üzenet elolvasásához levelező kliensre van szükség. (<i>pl.: <a href="https://www.pmail.com/downloads_s3_t.htm" target="_blank">Pegasus Mail</a> vagy <a href="https://www.thunderbird.net/hu/" target="_blank">Thunderbird</a> vagy ...</i>)</p>
        </section>
    </div>
</body>

</html>