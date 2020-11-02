<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="tpl/css/style.css"/>
    <title>Обновление Квин</title>
  </head>
  <body>
  <div class="wrapper">
      <header class="header">
          <nav class="navbar navbar-expand-lg navbar-dark bg-brown fixed-top">
            <a class="navbar-brand text-uppercase h5" href="https://albiononline.com/ru/home">Главная</a>
            <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div id="my-nav" class="collapse navbar-collapse justify-content-center">
              <ul class="navbar-nav ">
                <li class="nav-item li-hidden">
                  <a class="nav-link h5 text-uppercase" href="https://albiononline.com/ru/home">Главная</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link h5 text-uppercase" href="https://albiononline.com/ru/news">Новости</a>
                </li>
                <li class="{{ navfeedback }}">
                  <a class="nav-link h5 text-uppercase" href="index.php?pagenum=2">Сообщество</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link h5 text-uppercase" href="https://albiononline.com/ru/videos">Видео</a>
                </li>
                <li class="{{ navupdate }}">
                  <a class="nav-link h5 text-uppercase" href="index.php?pagenum=1">Обновления</a>
                </li>
              </ul>
            </div>
          </nav>
      </header>
