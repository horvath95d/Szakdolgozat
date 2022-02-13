<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?=site_url('assets/img/template/logo_small.jpg')?>" type="image/ico">
    <title><?=lang('site_name')?></title>
    <!-- Bootstrap, fontawesome, CSS -->
    <link rel="stylesheet" href="<?=site_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=site_url('assets/vendor/fontawesome/css/all.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=site_url('assets/css/style.css')?>">
</head>
<body>

<section class="banner-part">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="mb-3">
                    <h1 class="banner-h1 mt-5"><?=lang('site_name')?></h1>
                    <p class="banner-p mb-5"><?=lang('slogan')?></p>
                    <a href="register" class="btn btn-1 border-white"><?=lang('btn_register')?></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="loginform">
                    <div class="loginform-logo">
                        <img src="<?=site_url('assets/img/template/logo.png')?>" alt="logo" class="small_logo">
                    </div>
                    <h2><?=lang('login_heading')?></h2>
                    <form action="login" method="post" accept-charset="utf-8">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text loginform-icon"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="identity" placeholder="<?=lang('login_identity_label')?>" required>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text loginform-icon"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="<?=lang('login_password_label')?>" required>
                        </div>
                        <div class="custom-checkbox mb-2">    
                            <input type="checkbox" class="custom-control-input" name="remember" value="1" id="remember">
                            <label class="custom-control-label ml-4" for="remember"><?=lang('login_remember_label')?></label>
                        </div>
                        <button type="submit" class="btn btn-form my-2"><?=lang('login_submit_btn')?></button>
                    </form>
                    <a href="forgot_password"><?=lang('login_forgot_password')?></a>
                    <?php if (isset($_SESSION['message'])) echo "<div>".$_SESSION['message']."</div>"?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <div class="h-100">
                    <h2><?=lang('how_to_start')?></h2>
                    <p><?=lang('how_to_start_text')?></p>
                    <a href="help" class="btn btn-1"><?=lang('btn_read_more')?></a>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="far fa-clock fa-2x"></i>
                        <h5 class="my-2"><?=lang('feature_title_1')?></h5>
                        <p><?=lang('feature_text_1')?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="far fa-edit fa-2x"></i>
                        <h5 class="my-2"><?=lang('feature_title_2')?></h5>
                        <p><?=lang('feature_text_2')?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="far fa-file-alt fa-2x"></i>
                        <h5 class="my-2"><?=lang('feature_title_3')?></h5>
                        <p><?=lang('feature_text_3')?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="assets/img/about_img.png" alt="" class="w-100 mb-3">
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <h2>Hello World!</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non nulla arcu. Maecenas eget ex tortor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce vel congue ante, in egestas ligula. Aenean pulvinar varius est. Vestibulum auctor diam ut viverra feugiat. Donec finibus rhoncus velit sit amet consectetur.</p>
                    <p>Mauris fringilla tincidunt orci, non hendrerit augue consequat eget. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Pellentesque varius hendrerit tortor quis congue. Quisque et nisl lectus. Nullam iaculis, tellus non interdum tempor, dui leo congue nibh, ut porttitor velit erat a turpis. Quisque pulvinar at ex id cursus. Etiam feugiat posuere velit, eu fringilla arcu iaculis vel. Maecenas dictum velit et blandit laoreet.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="parallax">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3 mb-md-0">
                    <i class="fas fa-school"></i>
                    <h2><?=$number[0]?></h2>
                    <h4><?=lang('number_text_1')?></h4>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <i class="fas fa-user-tie"></i>
                    <h2><?=$number[1]?></h2>
                    <h4><?=lang('number_text_2')?></h4>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h2><?=$number[2]?></h2>
                    <h4><?=lang('number_text_3')?></h4>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <i class="fas fa-child"></i>
                    <h2><?=$number[3]?></h2>
                    <h4><?=lang('number_text_4')?></h4>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <h5 class="text-center">Az oldal fejlesztés/tesztelés fázisban van, a regisztráció ingyenes!</h5>
        <div class="row justify-content-center text-center">
            <div class="col-lg-3 p-lg-0">
                <div class="mt-lg-4 mb-3">
                    <h4 class="bg-secondary text-white py-3">3 <?=lang('package_month')?></h4>
                    <div class="bg-light pb-3">
                        <h3><?=lang('package1_price')?></h3>
                        <p><?=lang('package_text_1')?></p>
                        <p><?=lang('package_text_2')?></p>
                        <p><?=lang('package_text_3')?></p>
                        <p><?=lang('package_text_4')?></p>
                        <a href="/register" class="btn btn-1"><?=lang('btn_register')?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 p-lg-0" style="z-index:1">
                <div class="border border-white pb-3 box-shadow mb-3">
                    <h4 class="bg-primary text-white py-3">6 <?=lang('package_month')?></h4>
                    <div class="pb-4">
                        <h3><?=lang('package2_price')?></h3>
                        <p><?=lang('package_text_1')?></p>
                        <p><?=lang('package_text_2')?></p>
                        <p><?=lang('package_text_3')?></p>
                        <p><?=lang('package_text_4')?></p>
                        <a href="/register" class="btn btn-1 mt-4"><?=lang('btn_register')?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 p-lg-0">
                <div class="mt-lg-4 mb-3">
                    <h4 class="bg-secondary text-white py-3">12 <?=lang('package_month')?></h4>
                    <div class="bg-light pb-3">
                        <h3><?=lang('package3_price')?></h3>
                        <p><?=lang('package_text_1')?></p>
                        <p><?=lang('package_text_2')?></p>
                        <p><?=lang('package_text_3')?></p>
                        <p><?=lang('package_text_4')?></p>
                        <a href="/register" class="btn btn-1"><?=lang('btn_register')?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>