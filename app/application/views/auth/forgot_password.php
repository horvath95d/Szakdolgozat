<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <h5 class="card-header"><i class="fas fa-question mr-2"></i>Elfelejtett jelszó</h5>
                <div class="card-body text-center">
                    <div id="infoMessage"><?php echo $message;?></div>
                    <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

                    <form action="forgot_password" method="post" accept-charset="utf-8" class="w-75 m-auto">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text icon-form"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control" name="identity" placeholder="E-mail">
                        </div>
                        <button type="submit" class="btn btn-1">Küldés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>