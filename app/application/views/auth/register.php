<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card my-3">
                <h5 class="card-header"><i class="fas fa-sign-in-alt mr-2"></i>Regisztráció</h5>
                <div class="card-body">
                    <form method="post" accept-charset="utf-8" novalidate>
                        <div class="row border-bottom m-0">
                            <div class="col-3 py-2 border-right">
                                <label for="username">Felhasználónév</label>
                            </div>
                            <div class="col-9 py-2">
                                <input type="text" id="username" class="form-control form-control-sm w-75" name="username" required>
                                <div class="invalid-feedback">Már regisztráltak ezzel az felhasználó névvel!</div>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-3 py-2 border-right">
                                <label for="email">E-mail</label>
                            </div>
                            <div class="col-9 py-2">
                                <input type="email" id="email" class="form-control form-control-sm w-75" name="email" required>
                                <div class="invalid-feedback">Hibás vagy már használt email cím!</div>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-3 py-2 border-right">
                                <label for="password">Jelszó</label>
                            </div>
                            <div class="col-9 py-2">
                                <input type="password" id="password" class="form-control form-control-sm w-75" name="password" pattern="^.{8}.*$" required>
                                <span class="small text-muted">Legalább 8 karakter hosszú.</span>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-3 py-2 border-right">
                                <label for="confirm-password">Jelszó újra</label>
                            </div>
                            <div class="col-9 py-2">
                                <input type="password" id="confirm-password" class="form-control form-control-sm w-75" name="confirm-password" pattern="^.{8}.*$" required>
                                <div class="invalid-feedback">Nem egyezik a két jelszó!</div>
                            </div>
                        </div>

                        <div class="row border-bottom m-0">
                            <div class="col-12 text-center py-2">
                                <input type="checkbox" id="checkbox" name="checkbox">
                                <label for="checkbox">
                                    <span>Új iskola létrehozása</span>
                                    <span class="slider"></span>
                                    <span>Csatlakozás meglévő iskolához</span>
                                </label>
                            </div>
                        </div>

                        <div class="row border-bottom m-0">
                            <div class="col-3 py-2 border-right">
                                <label for="full_name">Iskola teljes neve</label>
                            </div>
                            <div class="col-9 py-2">
                                <input type="text" id="full_name" class="form-control form-control-sm w-75" name="full_name" required>
                                <div class="invalid-feedback">Ez a név már létezik</div>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-3 py-2 border-right">
                                <label for="short_name">Iskola rövid neve</label>
                            </div>
                            <div class="col-9 py-2">
                                <input type="text" id="short_name" class="form-control form-control-sm w-75" name="short_name" required>
                                <div class="invalid-feedback">Ez a név már létezik</div>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-3 py-2 border-right">
                                <label for="year1">Tanítási év</label>
                            </div>
                            <div class="col-9 py-2">
                                <div class="input-group input-group-sm w-50">
                                    <input type="number" id="year1" class="form-control" name="year1" min="2000" max="2100" value="<?=date("Y")?>" required>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">/</div>
                                    </div>
                                    <input type="number" id="year2" class="form-control" name="year2" min="2000" max="2100" value="<?=date("Y")+1?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-3 py-2 border-right">
                                <label for="days">Tanítási napok száma</label>
                            </div>
                            <div class="col-9 py-2">
                                <input type="number" id="days" class="form-control form-control-sm w-50" name="days" min="1" max="7" value="5" required>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-3 py-2 border-right">
                                <label for="times">Napi óra szám</label>
                            </div>
                            <div class="col-9 py-2">
                                <input type="number" id="times" class="form-control form-control-sm w-50" name="times" min="1" max="10" value="7" required>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-3 py-2 border-right">
                                <label for="code">Kód</label><span id="eye" class="ml-2"><i class="far fa-eye-slash"></i></span>
                            </div>
                            <div class="col-9 py-2">
                                <input type="password" id="code" class="form-control form-control-sm w-75" name="code" maxlength="25" required>
                                <span id="code-tip" class="small text-muted">Ezt a kódot kell megadni, ha egy új felhasználó csatlakozni akar az iskolához.</span>
                            </div>
                        </div>
                        
                        <div class="row border-bottom m-0">
                            <div class="col-lg-3 pt-5 pb-3 radio border-right">
                                <input type="radio" id="1" name="active" value="1">
                                <label for="1">
                                    <i class="fas fa-check"></i>
                                    <h4>1 <?=lang('package_month')?></h4>
                                    <p>Ingyenes</p>
                                </label>
                            </div>
                            <div class="col-lg-3 pt-5 pb-3 radio border-right">
                                <input type="radio" id="3" name="active" value="3">
                                <label for="3">
                                    <i class="fas fa-check"></i>
                                    <h4>3 <?=lang('package_month')?></h4>
                                    <p><?=lang('package1_price')?></p>
                                </label>
                            </div>
                            <div class="col-lg-3 pt-5 pb-3 radio border-right">
                                <input type="radio" id="6" name="active" value="6" checked>
                                <label for="6">
                                    <i class="fas fa-check"></i>
                                    <h4>6 <?=lang('package_month')?></h4>
                                    <p><?=lang('package2_price')?></p>
                                </label>
                            </div>
                            <div class="col-lg-3 pt-5 pb-3 radio">
                                <input type="radio" id="12" name="active" value="12">
                                <label for="12">
                                    <i class="fas fa-check"></i>
                                    <h4>12 <?=lang('package_month')?></h4>
                                    <p><?=lang('package3_price')?></p>
                                </label>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-12 py-2">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="accept" required>
                                    <label class="custom-control-label ml-4" for="accept">Elfogadom a felhasználási feltételeket.</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-2">
                            <button class="btn btn-1">Regisztráció</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery, Bootstrap, JavaScript -->
<script src="<?=site_url('assets/vendor/jquery/jquery-3.4.1.min.js')?>"></script>
<script src="<?=site_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?=site_url('assets/js/register.js')?>"></script>