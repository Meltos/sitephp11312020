<?php
session_start();
require_once __DIR__.'/vendor/autoload.php';
@define('ABSPATH', str_replace('\\', '/', dirname(__FILE__)));

$loader = new \Twig\Loader\FilesystemLoader(ABSPATH.'/tpl');
$twig = new \Twig\Environment($loader);

$navigation =array(
    array(
         'href'=>'home',
         'class'=>false,
         'caption'=>'Главная'
     ),
     array(
         'href'=>'about',
         'class'=>false,
         'caption'=>'Обо мне'
     ),
     array(
         'href'=>'feedback',
         'class'=>false,
        'caption'=>'Контакты'
     ),
     array(
         'href'=>'blog',
         'class'=>false,
         'caption'=>'Блог'
     ),
    array(
        'href'=>'update',
        'class'=>false,
        'caption'=>'Обновления'
    )
 );

$content_dir = __DIR__.'/content';

$helper = new  \Lid\Helper();
$content = new \Lid\Content($content_dir);

$category_list = $content->getDirList($content_dir);
$page_list = $content->getFileList($content_dir);
$page_list_suffix = $content->getFileListSuffix($content_dir);
$uri = $helper->GetURI();
$parseuri = $helper->ParseURI($uri);

$newNavigation = array();

foreach ($navigation as $nav)
{
    if ($nav['href'] == $parseuri[0])
    {
        $nav['class'] = true;
    }
    else
    {
        $nav['class'] = false;
    }
    array_push($newNavigation, $nav);
}

$proverka = false;

if ($parseuri[0]=='' or $parseuri[0]== null)
{
    $content->GetContent($content_dir.'/home');
    $page_content = array(
        'title'=>$content->page_header,
        'content'=>$content->page_content
    );
}
else {
    $parseurisuffix = $parseuri[0].'.php';
    if (in_array($parseuri[0], $page_list) and in_array($parseurisuffix, $page_list_suffix)) {
        $content->GetContent($content_dir.'/'.$parseurisuffix);
        $page_content = array('title'=>$content->page_header, 'content'=>$content->page_content);
    }
    elseif (in_array($parseuri[0], $page_list))
    {
        $content->GetContent($content_dir.'/'.$parseuri[0]);
        $page_content = array('title'=>$content->page_header, 'content'=>$content->page_content);
    }
    elseif (in_array($parseuri[0], $category_list))
    {
        $content_dir_new = __DIR__.'/content/'.$parseuri[0];

        $page_list_new = $content->getFileList($content_dir_new);
        $page_list_new = $content->getNoExtraFile($page_list_new);
        $page_list_suffix_new = $content->getFileListSuffix($content_dir_new);
        $page_list_suffix_new = $content->getNoExtraFile($page_list_suffix_new);

        if (count ($parseuri) < 2 )
        {
            $proverka = true;
            $page_content_list = array();
            if ($parseuri[0] == 'update')
            {
                $page_title = 'Обновления';
            }
            elseif ($parseuri[0] == 'blog')
            {
                $page_title = 'Блог';
            }
            foreach ($page_list_new as $page)
            {
                $page_content_blog = array('title'=>"$parseuri[0]", 'content'=>"$page");
                array_push($page_content_list, $page_content_blog);
            }

            echo $twig->render('blog.twig',['navigation'=>$newNavigation, 'page_content_list'=>$page_content_list, 'page_title'=>$page_title]);

        }
        elseif (count ($parseuri) > 2 )
        {
            $page_content = array('title'=>'404', 'content'=>'Ошибка 404');
        }
        else
        {
            $parseurisuffix_new = $parseuri[1].'.php';
            $helper->dbg($page_list_suffix_new);
            if (in_array($parseuri[1], $page_list_new) and in_array($parseurisuffix_new, $page_list_suffix_new))
            {

                $content->GetContent($content_dir.'/'.$parseuri[0].'/'.$parseurisuffix_new);

                $page_content = array('title'=>$content->page_header, 'content'=>$content->page_content);
            }
            elseif (in_array($parseuri[1], $page_list_new))
            {
                $content->GetContent($content_dir.'/'.$parseuri[0].'/'.$parseuri[1]);
                $page_content = array('title'=>$content->page_header, 'content'=>$content->page_content);
            }
            else{
                $page_content = array('title'=>'404', 'content'=>'Ошибка 404');
            }
        }
    }
    else{
        $page_content = array('title'=>'404', 'content'=>'Ошибка 404');
    }
}

if ($proverka == false)
{
    echo $twig->render('main.twig',['navigation'=>$newNavigation, 'page_content'=>$page_content]);
}
