<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Email extends CI_Controller {
        function __construct(){
            parent::__construct();
            $this->load->library('phpmailer');
        }

        function send_email() {
            $response = false;
            //$mail = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail = new PHPMailer();
            $subject = 'Test subject';
            $body = 'Hi there, <strong>Carl</strong> here.<br/> This is our email body.';
            $email = 'karansachrani.cs14@iba-suk.edu.pk';


            $mail->CharSet = 'UTF-8';
            $mail->SetFrom('localhostlocal4','Testing Mail');

            //You could either add recepient name or just the email address.
            //$mail->AddAddress($email,"ABC");
            $mail->AddAddress($email);

            //Address to which recipient will reply
            $mail->addReplyTo("localhostlocal4","Reply");
            //$mail->addCC("cc@example.com");
            //$mail->addBCC("bcc@example.com");

            //Add a file attachment
            //$mail->addAttachment("file.txt", "File.txt");        
            //$mail->addAttachment("images/profile.png"); //Filename is optional

            //You could send the body as an HTML or a plain text
            $mail->IsHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $body;

            //Send email via SMTP
            $mail->IsSMTP();
            $mail->SMTPAuth   = true; 
            $mail->SMTPSecure = "ssl";  //tls
            $mail->Host       = "smtp.googlemail.com";
            $mail->Port       = 465; //you could use port 25, 587, 465 for googlemail
            //$mail->Username   = "yourlessenabledaccount@gmail.com";
            //$mail->Password   = "yourpassword";
            $mail->Username   = "Testing Mail";
            $mail->Password   = "4localhostlocal";

            if(!$mail->send()){
                $response['message'] = 'Email has been sent successfully';
            }
            else{
                $response['message'] = 'Oops! Something went wrong while trying to send your email.';
            }
            echo json_encode($response);
        }
    }