<div class="container my-3">
    <div class="row">
        <div class="col-3">
            <h5><i class="fas fa-coins mr-2"></i><?=lang('link_active')?></h5>
            <?php include "nav.php" ?>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <form action="active" method="post" accept-charset="utf-8">
                        <div class="row text-center border-bottom m-0">
                            <div class="col-3 pt-5 pb-3 border-right radio">
                                <input type="radio" name="active" id="1" class="d-none" value="1">
                                <label for="1">
                                    <i class="fas fa-check d-none"></i>
                                    <h4>1 <?=lang('package_month')?></h4>
                                    <p>FREE</p>
                                </label>
                            </div>
                            <div class="col-3 pt-5 pb-3 border-right radio">
                                <input type="radio" name="active" id="3" class="d-none" value="3">
                                <label for="3">
                                    <i class="fas fa-check d-none"></i>
                                    <h4>3 <?=lang('package_month')?></h4>
                                    <p><?=lang('package1_price')?></p>
                                </label>
                            </div>
                            <div class="col-3 pt-5 pb-3 border-right radio">
                                <input type="radio" name="active" id="6" class="d-none" value="6" checked>
                                <label for="6">
                                    <i class="fas fa-check d-none"></i>
                                    <h4>6 <?=lang('package_month')?></h4>
                                    <p><?=lang('package2_price')?></p>
                                </label>
                            </div>
                            <div class="col-3 pt-5 pb-3 radio">
                                <input type="radio" name="active" id="12" class="d-none" value="12">
                                <label for="12">
                                    <i class="fas fa-check d-none"></i>
                                    <h4>12 <?=lang('package_month')?></h4>
                                    <p><?=lang('package3_price')?></p>
                                </label>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <button class="btn btn-1"><?=lang('btn_buy')?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>