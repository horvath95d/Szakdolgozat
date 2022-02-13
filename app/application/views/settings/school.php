<div class="container my-3">
    <div class="row">
        <div class="col-3">
            <h5><i class="fas fa-school mr-2"></i><?=lang('link_school')?></h5>
            <?php include "nav.php" ?>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <form action="school" method="post" accept-charset="utf-8">
                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="full_name"><?=lang('full_name')?></label>
                            </div>
                            <div class="col-8 py-2">
                                <input type="text" class="form-control form-control-sm w-75" id="full_name" name="full_name" value="<?=$school['full_name']?>" required>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="short_name"><?=lang('short_name')?></label>
                            </div>
                            <div class="col-8 py-2">
                                <input type="text" class="form-control form-control-sm w-75" id="short_name" name="short_name" maxlength="15" value="<?=$school['short_name']?>" required>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="year1">Tanítási év</label>
                            </div>
                            <div class="col-8 py-2">
                                <div class="input-group input-group-sm w-75">
                                    <?php $year = explode('/', $school['year']); ?>
                                    <input type="number" id="year1" class="form-control" name="year1" min="2000" max="2100" value="<?=$year[0]?>" required>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">/</div>
                                    </div>
                                    <input type="number" id="year2" class="form-control" name="year2" min="2000" max="2100" value="<?=$year[1]?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="days"><?=lang('days')?></label>
                            </div>
                            <div class="col-8 py-2">
                                <input type="number" class="form-control form-control-sm w-25" id="days" name="days" min="1" max="7" value="<?=$school['days']?>">
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="emblem"><?=lang('emblem')?></label>
                            </div>
                            <div class="col-8 py-2">
                                <?php if (!empty($school['emblem'])) echo "<img src=".site_url('assets/img/emblem/'.$school['emblem'])."><br>" ?>
                                <input type="file" id="emblem" name="emblem" class="mt-2" value="<?=site_url('assets/img/emblem/'.$school['emblem'])?>">
                            </div>
                        </div>
                        <div class="row border-bottom m-0">
                            <div class="col-4 py-2 border-right">
                                <label for="code"><?=lang('code')?></label><span id="eye" class="ml-2"><i class="far fa-eye-slash"></i></span>
                            </div>
                            <div class="col-8 py-2">
                                <input type="password" class="form-control form-control-sm w-75" id="code" name="code" value="<?=$school['code']?>">
                                <span class="small text-muted"><?=lang('code_comment')?></span>
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
            <?php if (!empty($users)): ?>
            <div class="card my-3">
                <h5 class="card-header"><i class="fas fa-users mr-2"></i>Iskoládhoz csatlakozott felhasználók</h5>
                <div class="card-body">
                    <?php foreach ($users as $user) :?>
                    <div class="row border-bottom">
                        <div class="col-6 py-2 border-right"><?=$user['username']?></div>
                        <div class="col-6 py-2"><?=$user['email']?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
