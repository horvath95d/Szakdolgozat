<div class="container my-3">
    <div class="row">
        <div class="col-3">
            <h5><i class="fas fa-user-lock mr-2"></i><?=lang('link_security')?></h5>
            <?php include "nav.php" ?>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <form action="<?=site_url('settings/security')?>" method="post" accept-charset="utf-8" class="grid">
                        <input type="hidden" name="user_id" value="1" id="user_id">    
                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="new-password"><?=lang('new_password')?></label>
                            </div>
                            <div class="col-8 py-2">
                                <input type="password" class="form-control form-control-sm w-75" id="new-password" name="new-password" pattern="^.{8}.*$" required>
                                <span class="small text-muted"><?=lang('new_password_comment')?></span>
                            </div>
                        </div>

                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="confirm-password"><?=lang('confirm_password')?></label>
                            </div>
                            <div class="col-8 py-2">
                                <input type="password" class="form-control form-control-sm w-75" id="confirm-password" name="confirm-password" pattern="^.{8}.*$" required>
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