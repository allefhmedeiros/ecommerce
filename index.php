<?php 
    
    session_start();
    require_once("vendor/autoload.php");
    
    use \Slin\Slin;
    use\Hcode\Page;
    use \Hcode\PageAdmin;
    use\Hcode\Model\User;    
    
    $app = new \Slim\Slim();
    $app->config('debug', true);
    
    //Rota de Renderização:: Site
    $app->get('/', function() {
            $page = new Hcode\Page();
            $page->setTpl("index");
    });
    
    //Rota de Renderização:: Administração do site
    $app->get('/admin', function() {
            User::verifyLogin();
            $page = new Hcode\PageAdmin();
            $page->setTpl("index");
    });

     //Rota de Renderização:: Administração do site - Login
    $app->get('/admin/login', function() {
            $page = new Hcode\PageAdmin([
                "header"=>false,
                "footer"=>false
            ]);
            $page->setTpl("login");
    });
    
     //Rota de Renderização:: Administração do site - ValidaçãoLogin
    $app->post('/admin/login', function() {
            User::login($_POST["login"], $_POST["password"]);
            header("Location: /admin");
            exit;
    });

    $app->get('/admin/logout', function(){
            User::logout();
            header("Location: /admin/login");
            exit;
    });
    
    $app->run();
 ?>