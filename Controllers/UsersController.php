<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\Session;
use App\Models\UsersModel;
use App\Models\SuperGlobal;

class UsersController extends Controller
{
    public function login()
    {

        $superGlobal = new SuperGlobal;
        $session = new Session;
        if(Form::validate($superGlobal->getGlobalPost(), ['email', 'password']))
        {
            $userModel = new UsersModel;
            $userArray = $userModel->findOneByEmail(strip_tags($superGlobal->getPost('email')));

            if(!$userArray)
            {
                $session->put('error', 'L\'adresse e-mail et/ou le mot de passe est incorrect');
                $this->redirectToRoute('/Blog/public/users/login');
            }

            $user = $userModel->hydrate($userArray);

            if(password_verify($superGlobal->getPost('password'), $user->getPassword()))
            {
                $user->setSession();
                $this->redirectToRoute('/Blog/public/');
            }
            else 
            {
                $session->put('error', 'L\'adresse e-mail et/ou le mot de passe est incorrect');
                $this->redirectToRoute('/Blog/public/users/login');
            }
        }

        $form = new Form;

        $form->startForm()
            ->addLabel('email', 'E-mail')
            ->addInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->addLabel('password', 'Mot de passe')
            ->addInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->addBtn('submit', 'Se connecter', ['class' => 'btn btn-primary'])
            ->endForm();

        $this->render('users/login', [
            'form' => $form->create(),
            'session' => $session
        ]);
    }

    public function register()
    {
        $superGlobal = new SuperGlobal;
        $session = new Session;

        if(Form::validate($superGlobal->getGlobalPost(), ['email', 'password', 'fullname']))
        {
            $email = strip_tags($superGlobal->getPost('email'));
            $fullname = strip_tags($superGlobal->getPost('fullname'));
            $password = password_hash($superGlobal->getPost('password'), PASSWORD_ARGON2I);


            $user = new UsersModel;
            $user->setEmail($email)
                ->setFullname($fullname)
                ->setPassword($password);

            $user->create();

            $this->redirectToRoute('/Blog/public/users/login');
        }

        $form = new Form();

        $form->startForm()
            ->addLabel('email', 'E-mail')
            ->addInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
            ->addLabel('fullname', 'Nom Pr??non')
            ->addInput('fullname', 'fullname', ['class' => 'form-control', 'id' => 'fullname'])
            ->addLabel('password', 'Mot de passe')
            ->addInput('password', 'password', ['class' => 'form-control', 'id' => 'password'])
            ->addBtn('submit', 'M\'inscrire', ['class' => 'btn btn-primary mt-2'])
            ->endForm();

        $this->render('users/register', [
            'form' => $form->create(),
            'session' => $session
        ]);
    }

    public function logout()
    {
        $superGlobal = new SuperGlobal;
        $session = new Session;
        $session->forget('user');
        $this->redirectToRoute($superGlobal->getServer('HTTP_REFERER'));
    }

}