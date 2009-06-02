<?php if(!defined('KLONDIKE_VER')) die("Access denied!"); ?>
<?php
    interface EmailProvider {
        function Send($from, $fromName, $to, $subject, $body);
    }
    
    class Email {
        public static $Provider=NULL;
        public static function Send($from, $fromName, $to, $subject, $body) {
            if(isset(Email::$Provider))
                Email::$Provider->Send($from, $fromName, $to, $subject, $body);
        }
    }
    
    class SendMailProvider implements EmailProvider {
        public function Send($from, $fromName, $to, $subject, $body) {
            global $_SETTINGS;
            $fd = popen($_SETTINGS['email']['path'],"w") or die("Couldn't Open Sendmail");
            fputs($fd, "MIME-Version: 1.0\n");
            fputs($fd, "Content-Type: text/html\n");
            fputs($fd, "To: $to \n");
            fputs($fd, "From: \"$fromName\" <$from> \n");
            fputs($fd, "Subject: $subject \n");
            fputs($fd, "X-Mailer: PHP3 \n\n");
            fputs($fd, "$body\n");
            pclose($fd);
        }
    }
    
    Email::$Provider = new SendMailProvider;
?>