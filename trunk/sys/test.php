<?php
    define('KLONDIKE_VER', 1.0);
    $fd = popen("C:\\sendmail\sendmail.exe -t","w") or die("Couldn't Open Sendmail");
    fputs($fd, "To: admin@sattvik.info \n");
    fputs($fd, "From: \"Sattvik Chakravarthy\" <sattvik@gmail.com> \n");
    fputs($fd, "Subject: Test message from my web site \n");
    fputs($fd, "X-Mailer: PHP3 \n\n");
    fputs($fd, "Testing. \n");
    pclose($fd);  
?>
Success