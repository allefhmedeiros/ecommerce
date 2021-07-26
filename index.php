<?php 

    require_once("vendor/autoload.php");
    $app = new \Slim\Slim();
    $app->config('debug', true);
    
    //Rota de Renderização:: Site
    $app->get('/', function() {
            $page = new Hcode\Page();
            $page->setTpl("index");
    });
    
    //Rota de Renderização:: Administração do site
    $app->get('/admin', function() {
            $page = new Hcode\PageAdmin();
            $page->setTpl("index");
    });    
    $app->run();
 ?>