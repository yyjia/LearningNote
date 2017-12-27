<?php

class Article{
    private $title = "This is an article";
}

class Post{
    private $title = "This is a post";
}

class Template{

    function render($context, $tpl){

        $closure = function($tpl){
            ob_start();
            include $tpl;
            return ob_end_flush();
        };

        $closure = $closure->bindTo($context, $context);
        $closure($tpl);

    }

}

$art = new Article();
$post = new Post();
$template = new Template();

$template->render($art, 'tpl.php');
$template->render($post, 'tpl.php');
?>

