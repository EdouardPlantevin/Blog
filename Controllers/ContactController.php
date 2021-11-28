<?php 

namespace App\Controllers;

use App\Core\Form;
use App\Models\Session;
use App\Models\ContactModel;
use App\Models\SuperGlobal;

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
            header('Location: /Blog/public/');
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