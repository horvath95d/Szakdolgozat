<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="sticky-top pt-3">
                <h5><i class="fas fa-book mr-2"></i><?=lang('link_subject')?></h5>
                <?php include_once "nav.php" ?>
            </div>
        </div>
        <div class="col-9">
            <div class="card my-3">
                <div class="card-body">
                    <form method="post" accept-charset="utf-8">
                        <table>
                            <tr>
                                <th><?=lang('name')?></th>
                                <th>Rövidítés</th>
                                <th><?=lang('importance')?> (1-5)</th>
                                <th>Szín</th>
                                <th></th>
                            </tr>
                            
                            <?php if (empty($subjects)): ?>
                            <tr>
                                <td>
                                    <input type="text" name="name[]" maxlength="25" autofocus>
                                </td>
                                <td>
                                    <input type="text" name="short[]" maxlength="4">
                                </td>
                                <td>
                                    <input type="range" class="custom-range" name="importance[]" min="1" max="5">
                                </td>
                                <td>
                                    <input type="color" name="color[]" value="#ffa500">
                                </td>
                                <td></td>
                            </tr>
                            <?php else: foreach ($subjects as $subject): ?>
                            <tr>
                                <input type="hidden" name="id[]" value="<?=$subject['id']?>">
                                <td>
                                    <input type="text" name="name[]" maxlength="25" value="<?=$subject['name']?>" required>
                                </td>
                                <td>
                                    <input type="text" name="short[]" maxlength="4" value="<?=$subject['short']?>">
                                </td>
                                <td>
                                    <input type="range" class="custom-range" name="importance[]" min="1" max="5" value="<?=$subject['importance']?>">
                                </td>
                                <td>
                                    <input type="color" name="color[]" value="<?=$subject['color']?>">
                                </td>
                                <td>
                                    <a href="<?=site_url('school/delete/subject/'.$subject['id'])?>" title="<?=lang('btn_remove')?>" onclick="return confirm('<?=lang('btn_confirm_remove')?>')">
                                        <img src="<?=site_url('assets/img/icons/drop.png')?>" alt="<?=lang('btn_remove')?>">
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; endif; ?>
                        </table>
                        <?php include_once "application/views/template/operations.php" ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>