<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?=site_url('assets/img/template/logo.png')?>" type="image/icon">
    <title><?=lang('site_name')?> - <?=$title?></title>
    <!-- Bootstrap, fontawesome, CSS -->
    <link rel="stylesheet" href="<?=site_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/vendor/fontawesome/css/all.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/style.css')?>">
</head>

<body class="bg-smoke">
    <header>
        <nav>
            <div class="container d-flex justify-content-between">
                <div>
                    <i class="fas fa-user mr-1"></i>
                    <span><?=$user->username.' - '.$school['short_name'].' '.$school['year']?></span> 
                    <?=get_instance()->check_active()
                    ? '<a href="'.site_url('settings/active').'">['.lang('active').']</a>'
                    : '<a href="'.site_url('settings/active').'" class="text-danger">['.lang('inactive').']</a>' ?>
                </div>
                <div>
                    <a href="<?=site_url('help')?>" title="<?=lang('link_help')?>"><i class="far fa-question-circle mr-1"></i></a>
                    <a href="<?=site_url('settings')?>" title="<?=lang('link_settings')?>"><i class="fas fa-cog mr-1"></i></a>
                    <span>
                        <a href="#" data-toggle="dropdown" title="<?=lang('link_language')?>"><i class="far fa-flag"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?=site_url('home/lang/hungarian')?>"><?=lang('hun')?></a>
                            <a href="<?=site_url('home/lang/english')?>"><?=lang('eng')?></a>
                        </div>
                    </span>
                </div>
            </div>
        </nav>
        <div class="banner"></div>
        <nav>
            <div class="container">
                <ul>
                    <li><a href="<?=site_url()?>"><?=lang('link_timetable')?></a></li>
                    <li class="dropdown">
                        <a><?=lang('link_school')?></a>
                        <ul class="dropdown-list">
                            <li><a href="<?=site_url("school/subject")?>"><?=lang('link_subject')?></a></li>
                            <li><a href="<?=site_url("school/teacher")?>"><?=lang('link_teacher')?></a></li>
                            <li><a href="<?=site_url("school/class")?>"><?=lang('link_class')?></a></li>
                            <li><a href="<?=site_url("school/room")?>"><?=lang('link_room')?></a></li>
                        </ul>
                    </li>
                    <li><a href="<?=site_url('lesson/no')?>"><?=lang('link_lesson')?></a></li>
                    <li class="dropdown">
                        <a><?=lang('link_control')?></a>
                        <ul class="dropdown-list">
                            <li><a href="<?=site_url("control/school")?>"><?=lang('link_school')?></a></li>
                            <li><a href="<?=site_url("control/lesson")?>"><?=lang('link_lesson')?></a></li>
                            <li><a href="<?=site_url("control/timetable")?>"><?=lang('link_timetable')?></a></li>
                        </ul>
                    </li>
                    <li><a href="<?=site_url('calendar')?>"><?=lang('link_calendar')?></a></li>
                    <li><a href="<?=site_url('logout')?>"><?=lang('link_logout')?></a></li>
                </ul>
            </div>
        </nav>
    </header>