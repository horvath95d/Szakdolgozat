<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?=site_url('assets/img/template/logo.png')?>" type="image/icon">
    <title><?=lang('site_name')?> - <?=lang('link_help')?></title>
    <!-- Bootstrap, fontawesome, CSS -->
    <link rel="stylesheet" href="<?=site_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/vendor/fontawesome/css/all.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/help.css')?>">
</head>
<body>
    <header class="mb-3">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-3 align-self-end text-lg-left my-2">
                    <a href="<?=site_url('help')?>">
                        <img src="<?=site_url('assets/img/template/logo.png')?>" alt="logo" class="small-logo">
                        <span class="ml-3"><?=lang('link_help')?></span>
                    </a>
                </div>
                <div class="col-lg-6 my-lg-2">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" placeholder="Keresés">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-form"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 align-self-end text-lg-right my-2">
                    <a href="/"><i class="fas fa-sign-out-alt"></i> Vissza az órarend tervezőbe</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?php $explode = explode('/', $_SERVER['PHP_SELF']); $page = end($explode);?>
                <ul class="topic-list mb-3">
                    <li><a href="<?=site_url('help')?>" <?=($page == 'help') ? 'class="active"':''?>><?=lang('link_home')?></a></li>
                    <li>
                        <a href="#list3" class="topic <?=in_array($page, array('stepbystep', 'calendar')) ? '':'collapsed'?>" data-toggle="collapse">Oldal használata<i class="fas fa-angle-down"></i></a>
                        <ul id="list3" class="collapse  <?=in_array($page, array('stepbystep', 'calendar')) ? 'show':''?>">
                            <li><a href="<?=site_url('help/topic/stepbystep')?>" <?=($page == 'stepbystep') ? 'class="active"':''?>>Órarend készítés lépései</a></li>
                            <li><a href="<?=site_url('help/topic/calendar')?>" <?=($page == 'calendar') ? 'class="active"':''?>>Oktatási naptár</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#list1" class="topic <?=(in_array($page, array('start', 'data', 'lesson', 'timetable', 'control', 'print'))) ? '':'collapsed'?>" data-toggle="collapse">Órarend készítés<i class="fas fa-angle-down"></i></a>
                        <ul id="list1" class="collapse <?=(in_array($page, array('start', 'data', 'lesson', 'timetable', 'control', 'print'))) ? 'show':''?>">
                            <li><a href="<?=site_url('help/topic/data')?>" <?=($page == 'data') ? 'class="active"':''?>>Adatok megadása</a></li>
                            <li><a href="<?=site_url('help/topic/lesson')?>" <?=($page == 'lesson') ? 'class="active"':''?>>Tanóra típusok</a></li>
                            <li><a href="<?=site_url('help/topic/timetable')?>" <?=($page == 'timetable') ? 'class="active"':''?>>Órarend szerkesztése</a></li>
                            <li><a href="<?=site_url('help/topic/control')?>" <?=($page == 'control') ? 'class="active"':''?>>Ellenőrzés</a></li>
                            <li><a href="<?=site_url('help/topic/print')?>" <?=($page == 'print') ? 'class="active"':''?>>Nyomtatás</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#list2" class="topic <?=(in_array($page, array('register', 'settings'))) ? '':'collapsed'?>" data-toggle="collapse">Fiók kezelése<i class="fas fa-angle-down"></i></a>
                        <ul id="list2" class="collapse <?=(in_array($page, array('register', 'settings'))) ? 'show':''?>">
                            <li><a href="<?=site_url('help/topic/register')?>" <?=($page == 'register') ? 'class="active"':''?>>Regisztráció és aktiválás</a></li>
                            <li><a href="<?=site_url('help/topic/settings')?>" <?=($page == 'settings') ? 'class="active"':''?>>Felhasználó beállítások</a></li>
                        </ul>
                    </li>
                    <li><a href="<?=site_url('help/about')?>" <?=($page == 'about') ? 'class="active"':''?>>Rólunk</a></li>
                    <li><a href="<?=site_url('help/news')?>" <?=($page == 'news') ? 'class="active"':''?>>Hírek</a></li>
                </ul>
            </div>
            <div class="col-lg-9">