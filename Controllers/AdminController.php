<?php 

namespace App\Controllers;

use DateTime;
use App\Core\Form;
use App\Models\ArticleModel;
use App\Models\AnnoncesModel;
use App\Models\CommentModel;
use App\Models\ContactModel;
use App\Models\Session;
use App\Models\SuperGlobal;
use App\Models\UsersModel;

class AdminController extends Controller
{
    public function index()
    {
        if($this->isAdmin())
        {

            $userModel = new UsersModel;
            $users = $userModel->getCount();

            $articleModel = new ArticleModel;
            $articles = $articleModel->getCount();

            $contactModel = new ContactModel;
            $contacts = $contactModel->getCount();


            $this->render('admin/index', [
                'articles' => $articles,
                'users' => $users,
                'contacts' => $contacts,
                'session' => $this->session()
            ], 'admin');
        }
    }

    private function isAdmin()
    {
        if (($this->session()->get('user') != null) && in_array("ROLE_ADMIN", $this->session()->get('user')['roles']))
        {
            return true;
        }
        else 
        {
            $this->session()->put('error', 'Vous n\'avez pas accès à cette page');
            $this->redirectToRoute("/Blog/public/");
            exit;
        }
    }

    //Articles
    public function articles()
    {
        if($this->isAdmin())
        {
            $articleModel = new ArticleModel;
            $articles = $articleModel->findAll();

            $this->render('admin/articles/articles', [
                'articles' => $articles,
                'session' => $this->session()
            ], 'admin');
        }
    }

    public function activeArticle(int $id)
    {
        if($this->isAdmin())
        {
            $articleModel = new ArticleModel;
            $articleArray = $articleModel->find($id);

            if($articleArray)
            {
                $article = $articleModel->hydrate($articleArray);
                $article->setActive($article->getActive() ? 0 : 1);
                $article->update();
            }
        }   
    }

    public function addArticle()
    {
        if($this->isAdmin()) {
            if(Form::validate($this->superGlobal()->getGlobalPost(), ['title', 'content']))
            {
                $title = strip_tags($this->superGlobal()->getPost('title'));
                $content = strip_tags($this->superGlobal()->getPost('content'));
                $shortDescription = strip_tags($this->superGlobal()->getPost('short_description'));

                move_uploaded_file($this->superGlobal()->getFile()["image"]["tmp_name"], "/Applications/MAMP/htdocs/Blog/public/assets/images/" . $this->superGlobal()->getFile()["image"]["name"]);

                $article = new ArticleModel;
                $article->setTitle($title)
                        ->setContent($content)
                        ->setAuthorId($this->session()->get('user')['id'])
                        ->setShortDescription($shortDescription)
                        ->setImage($this->superGlobal()->getFile()['image']['name'])
                        ->setActive(true);

                $article->create();
                
                $this->session()->put('message', 'Votre article a été enregistrée avec succès');
                $this->redirectToRoute("/Blog/public/");
                exit;
            }
            else 
            {
                if($this->superGlobal()->getGlobalPost() != null)
                {
                    $this->session()->put('error', 'Le formulaire est incomplet');
                }
                $title = ($this->superGlobal()->getPost('title') != null) ? strip_tags($this->superGlobal()->getPost('title')) : '';
                $content = ($this->superGlobal()->getPost('content') != null) ? strip_tags($this->superGlobal()->getPost('content')) : '';
                $shortDescription = ($this->superGlobal()->getPost('short_description') != null) ? strip_tags($this->superGlobal()->getPost('short_description')) : '';
            }

            $form = new Form();

            $form->startForm('post', '#', [
                "enctype" => "multipart/form-data"
            ])
            ->addLabel('title', 'Titre de l\'article')
            ->addInput('text', 'title', [
                'id' => 'title', 
                'class' => 'form-control',
                'value' => $title,
            ])
            ->addLabel('content', 'Texte de l\'article')
            ->addTextarea('content', $content, [
                'id' => 'content', 
                'class' => 'form-control'
            ])
            ->addLabel('short_description', 'Description courte de l\'article')
            ->addTextarea('short_description', $shortDescription, [
                'id' => 'short_description', 
                'class' => 'form-control'
            ])
            ->addLabel('image', 'Image')
            ->addInput('file', 'image', [
                'id' => 'image',
                'class' => 'form-control',
                'accept' => 'image/*'
            ])
            ->addBtn('submit', 'Créer', ['class' => 'btn btn-primary mt-2'])
            ->endForm();

            $this->render('admin/articles/add-article', [
                'form' => $form->create(),
                'session' => $this->session()
            ], 'admin');
        }
    }

    public function editArticle(int $id)
    {
        if($this->isAdmin()) {
            if(($this->session()->get('user') != null) && ($this->session()->get('user')['id'] != null)) 
            {
    
                $articleModel = new ArticleModel;
                $article = $articleModel->find($id);
    
                if(!$article)
                {
                    http_response_code(404);
                    $this->session()->put('error', 'L\'article recherchée n\'existe pas');
                    $this->redirectToRoute("/Blog/public/articles");
                    exit;
                }
    
                if($article->author_id != $this->session()->get('user')['id'])
                {
                    if(!in_array('ROLE_ADMIN', $this->session()->get('user')['roles']))
                    {
                        $this->session()->put('error', 'Vous n\'avez pas accès à cette page');
                        $this->redirectToRoute("/Blog/public/articles");
                        exit;
                    }
                }
    
                if(Form::validate($this->superGlobal()->getGlobalPost(), ['title', 'content']))
                {
                    $title = strip_tags($this->superGlobal()->getPost('title'));
                    $content = strip_tags($this->superGlobal()->getPost('content'));
                    $shortDescription = strip_tags($this->superGlobal()->getPost('short_description'));
    
                    move_uploaded_file($this->superGlobal()->getFile()["image"]["tmp_name"], "/Applications/MAMP/htdocs/Blog/public/assets/images/" . $this->superGlobal()->getFile()["image"]["name"]);
    
                    $articleEdit = new ArticleModel;
                    $articleEdit->setId($article->id)
                                ->setTitle($title)
                                ->setShortDescription($shortDescription)
                                ->setImage($this->superGlobal()->getFile()['image']['name'])
                                ->setContent($content);
    
                    $articleEdit->update();
    
                    $this->session()->put('message', 'Votre article a été modifiée avec succès');
                    $this->redirectToRoute("/Blog/public/");
                    exit;
                }
    
                $form = new Form;
    
                $form->startForm('post', '#', [
                    "enctype" => "multipart/form-data"
                ])
                ->addLabel('title', 'Titre de l\'article')
                ->addInput('text', 'title', [
                    'id' => 'title', 
                    'class' => 'form-control',
                    'value' => $article->title,
                ])
                ->addLabel('content', 'Texte de l\'article')
                ->addTextarea('content', $article->content, [
                    'id' => 'content', 
                    'class' => 'form-control'
                ])
                ->addLabel('short_description', 'Description courte de l\'article')
                ->addTextarea('short_description', $article->short_description, [
                    'id' => 'short_description', 
                    'class' => 'form-control'
                ])
                ->addLabel('image', 'Image')
                ->addInput('file', 'image', [
                    'id' => 'image',
                    'class' => 'form-control',
                    'accept' => 'image/*'
                ])
                ->addBtn('submit', 'Modifier', ['class' => 'btn btn-primary mt-2'])
                ->endForm();
    
                $this->render('admin/articles/edit-article', [
                    'form' => $form->create(),
                    'session' => $this->session()
                ], 'admin');
    
            }
            else 
            {
                $this->session()->put('error', 'Vous devez être connecté(e) pour accéder à cette page');
                $this->redirectToRoute("/Blog/public/users/login");
                exit;
            }

        }

    }

    public function deleteArticle(int $id)
    {
        if($this->isAdmin())
        {
            $article = new ArticleModel;

            $article->delete($id);
            $this->session()->put('message', 'Votre article a été supprimé avec succès');
            $this->redirectToRoute($this->superGlobal()->getServer('HTTP_REFERER'));
        }
    }

    //Contact
    public function contacts()
    {
        if($this->isAdmin()) 
        {
            $contact = new ContactModel;
    
            $contacts = $contact->findAll();
    
            $this->render('admin/contacts/contacts', [
                'contacts' => $contacts,
                'session' => $this->session()
            ], 'admin');
        }
    }

    public function deleteContact(int $id)
    {
        if($this->isAdmin())
        {
            $contact = new ContactModel;
    
            $contact->delete($id);
    
            $this->session()->put('message', 'Le contact a été supprimé avec succès');
            $this->redirectToRoute($this->superGlobal()->getServer('HTTP_REFERER'));
        }

    }

    //Comments

    public function comments()
    {
        if($this->isAdmin())
        {
            $commentModel = new CommentModel;
    
            $comments = $commentModel->findBy(['active' => 0]);
    
            $this->render('admin/comments/index', [
                'comments' => $comments,
                'session' => $this->session()
            ], 'admin');
        }

    }

    public function activeComment(int $id)
    {
        if($this->isAdmin())
        {
            $commentModel = new CommentModel;
            $comment = $commentModel->find($id);

            $commentEdit = new CommentModel;

            $commentEdit->setId($comment->id)
                        ->setActive(1);
            $commentEdit->update();

            $this->render('admin/comments/index', [
                'comments' => $commentModel->findBy(['active' => 0]),
                'session' => $this->session()
            ], 'admin');
        }   
    }


    public function deleteComment(int $id)
    {
        if($this->isAdmin())
        {
            $comment = new CommentModel;

            $comment->delete($id);
            $this->session()->put('message', 'Le commentaire a été supprimé avec succès');
            $this->redirectToRoute($this->superGlobal()->getServer('HTTP_REFERER'));
        }
    }
    

}