<?php 

namespace App\Controllers;

use App\Core\Form;
use App\Models\Session;
use App\Models\ContactModel;
use App\Models\SuperGlobal;
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';

class ContactController extends Controller
{
    public function index()
    {
        $superGlobal = new SuperGlobal;
        $session = new Session;
        if(Form::validate($superGlobal->getGlobalPost(), ['name', 'email', 'message']))
        {
            $name = strip_tags($superGlobal->getPost('name'));
            $email = strip_tags($superGlobal->getPost('email'));
            $message = strip_tags($superGlobal->getPost('message'));

            $contact = new ContactModel;
            $contact->setName($name)
                    ->setEmail($email)
                    ->setMesssage($message);

            $contact->create();

            $session->put('message', "Votre message a été transmis avec succès");

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '5bbbcb571bd83b';
            $mail->Password = '8a6bb8470e7a93';

            //Recipients
            $mail->setFrom('no-reply@edouard.com', 'php blog');
            $mail->addAddress('plantevin.contact@gmail.com');

            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = 'Demande de contact';
            $mail->Body    = "<p>$message</p>";

            $mail->send();
            
            $this->redirectToRoute("/Blog/public/");
        }
        else 
        {
            $session->put('error', !empty($superGlobal->getGlobalPost()) ? "Le formulaire est incomplet" : '');
            $name = $superGlobal->getPost('name') !== null ? strip_tags($superGlobal->getPost('name')) : '';
            $email = $superGlobal->getPost('email') !== null ? strip_tags($superGlobal->getPost('email')) : '';
            $message = $superGlobal->getPost('message') !== null ? strip_tags($superGlobal->getPost('message')) : '';
        }

        $form = new Form();

        $form->startForm()
        ->addLabel('name', 'Nom/Prénom')
        ->addInput('text', 'name', [
            'id' => 'name', 
            'class' => 'form-control',
            'value' => $name,
        ])
        ->addLabel('email', 'Email')
        ->addInput('text', 'email', [
            'id' => 'email',
            'class' => 'form-control',
            'value' => $email
        ])
        ->addLabel('message', 'Message')
        ->addTextarea('message', $message, [
            'id' => 'message', 
            'class' => 'form-control',
            'value' => $message
        ])
        ->addBtn('submit', 'Envoyer', ['class' => 'btn btn-primary mt-2'])
        ->endForm();

        $this->render('contact/contact', [
            'form' => $form,
            'session' => $session
        ]);
    }
}