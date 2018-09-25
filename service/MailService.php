<?php

class MailService{
    function sendMail($from, $subject, $title, $info){
        // To
        $to = "[YOUR-MAIL]";

        // Subject
        $sujet = $subject;

        // Message
        $contenu = "";
        $contenu .= "<html> \n";
        $contenu .= "<head> \n";
        $contenu .= "<title> ".$subject."</title> \n";
        $contenu .= "</head> \n";
        $contenu .= "<body> \n";
        $contenu .= '<strong>'.$title.'</strong>
			 <br>
			 '.$info.'
			 <br>';
        $contenu .= "</body> \n";
        $contenu .= "</html> \n";

        // Headers
        $headers = 'From: '.$from.''."\r\n";
        $headers .= 'X-Mailer: PHP'."\r\n";
        $headers .= 'Mime-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
        $headers .= "\r\n";

        //Send Mail
        $verif_envoi_mail = TRUE;
        $verif_envoi_mail = @mail ($to, $sujet, $contenu, $headers);
        if ($verif_envoi_mail === FALSE) echo " ### Verification Envoi du Mail=$verif_envoi_mail - Erreur envoi mail <br> \n";
        else echo " *** Verification Envoi du Mail=$verif_envoi_mail - Mail envoy&eacute; avec succ&egrave;s de $to vers $from <br> avec comme sujet: $sujet \n";

    }
}