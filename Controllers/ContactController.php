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
        if(Form::validate(SuperGlobal::getGlobalPost(), ['name', 'email', 'message']))
        {
            $name = strip_tags(SuperGlobal::getPost('name'));
            $email = strip_tags(SuperGlobal::getPost('email'));
            $message = strip_tags(SuperGlobal::getPost('message'));

            $contact = new ContactModel;
            $contact->setName($name)
                    ->setEmail($email)
                    ->setMesssage($message);

            $contact->create();
            
            Session::put('message', "Votre message a été transmis avec succès");
            header('Location: /Blog/public/');
            exit;
        }
        else 
        {
            Session::put('error', !empty(SuperGlobal::getGlobalPost()) ? "Le formulaire est incomplet" : '');
            $name = SuperGlobal::getPost('name') !== null ? strip_tags(SuperGlobal::getPost('name')) : '';
            $email = SuperGlobal::getPost('email') !== null ? strip_tags(SuperGlobal::getPost('email')) : '';
            $message = SuperGlobal::getPost('message') !== null ? strip_tags(SuperGlobal::getPost('message')) : '';
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
            'form' => $form->create(),
            'session' => new Session
        ]);
    }
}