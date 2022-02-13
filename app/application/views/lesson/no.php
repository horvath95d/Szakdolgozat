<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="sticky-top py-3">
                <h5><i class="far fa-calendar-times mr-2"></i><?=lang('link_no')?></h5>
                <?php include_once "nav.php" ?>
            </div>
        </div>
        <div class="col-9">
            <div class="card my-3">
                <div class="card-body">
                    <form method="post" accept-charset="utf-8">
                        <table>
                            <tr>
                                <th><?=lang('teacher')?></th>
                                <th><?=lang('times_week')?></th>
                                <th></th>
                            </tr>

                            <?php if (empty($lessons)): ?>
                            <tr>
                                <td>
                                    <select name="teacher_id[]" autofocus>
                                        <option></option>
                                        <?php foreach ($teachers as $teacher): ?>
                                        <option value="<?=$teacher['id']?>"><?=$teacher['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="count[]" min="1" value="1">
                                </td>
                                <td></td>
                            </tr>
                            <?php else: foreach ($lessons as $lesson):?>
                            <tr>
                                <td>
                                    <input type="hidden" name="id[]" value="<?=$lesson['id']?>">
                                    <select name="teacher_id[]" required>
                                        <?php foreach ($teachers as $teacher): ?>
                                            <option value="<?=$teacher['id']?>" <?php if ($lesson['teacher_id'] == $teacher['id']) echo "selected";?>><?=$teacher['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="count[]" value="<?=$lesson['count']?>" min="1">
                                </td>
                                <td>
                                    <a href="<?=site_url('lesson/delete/'.$lesson['id'])?>" title="<?=lang('btn_remove')?>">
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