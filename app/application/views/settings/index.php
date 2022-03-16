<div class="container my-3">
    <div class="row">
        <div class="col-3">
            <h5><i class="fas fa-user mr-2"></i><?=lang('link_general')?></h5>
            <?php include "nav.php" ?>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <form action="settings/index" method="post" accept-charset="utf-8">
                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="username"><?=lang('username')?></label>
                            </div>
                            <div class="col-8 py-2">
                                <input type="text" class="form-control form-control-sm w-75" id="username" name="username" value="<?=$user->username?>">
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="email"><?=lang('email')?></label>
                            </div>
                            <div class="col-8 py-2">
                                <input type="email" class="form-control form-control-sm w-75" id="email" name="email" value="<?=$user->email?>">
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="current-password"><?=lang('current_password')?></label>
                            </div>
                            <div class="col-8 py-2">
                                <input type="password" class="form-control form-control-sm w-75" id="current-password" name="current-password" required>
                                <span class="small text-muted"><?=lang('current_password_comment')?></span>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <button class="btn btn-1"><?=lang('btn_save')?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>