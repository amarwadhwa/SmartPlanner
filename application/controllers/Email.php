<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Email extends CI_Controller {
        function __construct(){
            parent::__construct();
            //$this->load->library('phpmailer');
        }

        function send_email() {
          require 'application_resources/PHPMailer/PHPMailerAutoload.php';


            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'localhostlocal4';                 // SMTP username
            $mail->Password = '4localhostlocal';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            $mail->setFrom('admin@equeet.com', 'Mailer');
            $mail->addAddress('rockiing.aakash@gmail.com', 'Aakash');     // Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
    }
}