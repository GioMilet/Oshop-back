<?php

namespace App\Controllers;

class CoreController {

    public function __construct()
    {
        //to check the route where we are
        global $match;
       
        //get the name of the route
        $currentRouteName = $match['name'];
        
        //for all the routes name, define which role can access to the route
        $acl = [
            // everyone can access to the login page
            'user-login' => 'anonymous',
            'main-home' => ['admin', 'catalog-manager'],
            'user-logout' => ['admin', 'catalog-manager'],
            'user-list' => ['admin'],
            'user-add' => ['admin'],
            'product-add' => ['admin', 'catalog-manager'],
            'product-update' => ['admin', 'catalog-manager'],
            'product-list' => ['admin', 'catalog-manager'],
            'category-add' => ['admin', 'catalog-manager'],
            'category-update' => ['admin', 'catalog-manager'],
            'category-list' => ['admin', 'catalog-manager'],
            'main-accueil'=>'anonymous'
        ];

        //if current page is not in the ACL, you have to add it
        if (!array_key_exists($currentRouteName, $acl)){
            
            die('That road is not in your ACL !');
        }

        $allowedRoles = $acl[$currentRouteName];
        if ($allowedRoles !== 'anonymous'){
            //call the method which check if access is granted
            $this->checkAuthorization($allowedRoles);
        }
    }

    protected function checkAuthorization($allowedRoles = [])
    {
        //if user is not connected
        if (empty($_SESSION['userObject'])){
            
            $_SESSION['alert'] = "Veuillez vous connecter d'abord !";
            $this->redirectToRoute("user-login");
        }
        //if user is connected
        else {
            $user = $_SESSION['userObject'];
            $role = $user->getRole();
        
            if (!in_array($role, $allowedRoles)){

                $errorController = new ErrorController();
                $errorController->err403();

                die();
            }
        }
    }

    protected function show(string $viewName, $viewVars = []) {
        global $router;

        $viewVars['currentPage'] = $viewName; 

        // define absolute url for assets
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . '/assets';
        
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        //protection against CSRF attacks
        $csrfToken = bin2hex(random_bytes(32));
        
        $_SESSION['csrfToken'] = $csrfToken;

        //The extract function allow to create variable for each element in the array $viewVars
        extract($viewVars);
    

        require_once __DIR__.'/../views/layout/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/layout/footer.tpl.php';
    }

    
    public function redirectToRoute($route, $urlParams = [])
    {
         //redirection
         global $router;
         header("Location: " . $router->generate($route, $urlParams));
         die();
    }
}