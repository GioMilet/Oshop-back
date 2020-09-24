<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController 
{
    public function add()
    {
        $errorsList = [];

        if (!empty($_POST)){

            $csrfTokenFromForm = filter_input(INPUT_POST, 'csrf_token');
            if ($csrfTokenFromForm !== $_SESSION['csrfToken']){
                $errorController = new ErrorController();
                return $errorController->err403();
            }

            $email = trim(strip_tags(filter_input(INPUT_POST, 'email')));
            $password = filter_input(INPUT_POST, 'password');
            $firstname = strip_tags(filter_input(INPUT_POST, 'firstname'));
            $lastname = strip_tags(filter_input(INPUT_POST, 'lastname'));
            $role = strip_tags(filter_input(INPUT_POST, 'role'));
            $status = strip_tags(filter_input(INPUT_POST, 'status'));

            if (empty($email)){
                $errorsList['email'] = "Veuillez renseigner l'email !";
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errorsList['email'] = "L'email n'est pas valide dude !";
            }

            if (empty($password)){
                $errorsList['password'] = "Veuillez renseigner un mot de passe !";
            }
            elseif(mb_strlen($password) < 8){
                $errorsList['password'] = "Votre mot de passe est trop court !";
            }

            elseif(!preg_match("/\d/", $password)){
                $errorsList['password'] = "Votre mdp doit contenir au moins un chiffre !";
            }
            elseif(!preg_match("/[A-Z]/", $password)){
                $errorsList['password'] = "Votre mdp doit contenir au moins une majuscule !";
            }

            if (empty($errorsList)){
                $user = new AppUser();

                $hash = password_hash($password, PASSWORD_DEFAULT);

                $user->setPassword($hash);
                $user->setEmail($email);
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setRole($role);
                $user->setStatus($status);

                $user->insert();
            }
        }

        $this->show('user/add', ['errorsList' => $errorsList]);
    }

    public function list()
    {
        $users = AppUser::findAll();
        $this->show('user/list', ["users" => $users]);
    }

    public function logout()
    {

        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);

        $this->redirectToRoute('user-login');
    }


    public function login()
    {
        $errorsList = [];

        if (!empty($_POST)){
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');

            $foundUser = AppUser::findByEmail($email);
            
            if ($foundUser){
                if (password_verify($password, $foundUser->getPassword())){
                
                    $_SESSION['userId'] = $foundUser->getId();
                    $_SESSION['userObject'] = $foundUser;

                    $this->redirectToRoute("main-home");
                }
                else {
                    $errorsList['password'] = "mauvais mdp !";
                }
            }
            else {
                $errorsList['email'] = "mauvais email !";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errorsList['email'] = "Votre email est mal formé !";
            }
        }

        $this->show('user/login', ["errorsList" => $errorsList]);
    }
}