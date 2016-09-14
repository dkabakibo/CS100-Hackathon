<?php
echo "<p>Please wait while your messages are being sent.</p>";
    $senemail = $_POST['senemail'];
    $carrier = $_POST['carrier'];
    $num = $_POST['num'];
    $messubject = "SPAM";
    $fromemail = "minihackathon@cs100.edu";
    $messagetrue = $_POST['mestext'];
    $ctr = 0;
    $boo = TRUE;

    if($boo)
        for($i=0;$i<$num;$i++)
        {
        $ctr++;
        $to      = $senemail . $carrier;
        $subject = $messubject . $ctr;
        $message = $messagetrue;
        $headers = 'From: '.  $fromemail . "\r\n" .
            'Reply-To: $fromemail' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        }

    echo "<p><b>Sent a total of <span style=\"color:red\">[$ctr]</span> messages!</b></p>";

?>
