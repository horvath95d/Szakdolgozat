<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="sticky-top pt-3">
                <h5><i class="fas fa-users mr-2"></i><?=lang('link_class')?></h5>
                <?php include_once "nav.php" ?>
            </div>
        </div>
        <div class="col-9">
            <div class="card mt-3">
                <div class="card-body">
                    <form method="post" accept-charset="utf-8">
                        <table>
                            <tr>
                                <th><?=lang('name')?></th>
                                <th><?=lang('headteacher')?></th>
                                <th><?=lang('classroom')?></th>
                                <th style="width: 100px"><?=lang('class_members')?></th>
                                <th></th>
                            </tr>
                        
                            <?php if (empty($classes)): ?>
                            <tr>
                                <td>
                                    <input type="text" name="name[]" maxlength="15" autofocus>
                                </td>
                                <td>
                                    <select name="teacher_id[]">
                                        <option></option>
                                        <?php foreach ($teachers as $teacher): ?>
                                            <option value="<?=$teacher['id']?>"><?=$teacher['name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td>
                                    <select name="room_id[]">
                                        <option></option>
                                        <?php foreach ($rooms as $room): ?>
                                            <option value="<?=$room['id']?>"><?=$room['name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="members[]>" min="1" value="1">
                                </td>
                                <td></td>
                            </tr>
                            <?php else: foreach ($classes as $class): ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="id[]" value="<?=$class['id']?>">
                                    <input type="text" name="name[]" maxlength="15" value="<?=$class['name']?>" required>
                                </td>
                                <td>
                                    <select name="teacher_id[]">
                                        <option></option>
                                        <?php foreach ($teachers as $teacher): ?>
                                            <option value="<?=$teacher['id']?>" <?php if ($class['teacher_id'] == $teacher['id']) echo "selected";?>><?=$teacher['name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td>
                                    <select name="room_id[]">
                                        <option></option>
                                        <?php foreach ($rooms as $room): ?>
                                            <option value="<?=$room['id']?>"<?php if ($class['room_id'] == $room['id']) echo "selected";?>><?=$room['name']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="members[]>" min="1" value="<?=$class['members']?>">
                                </td>
                                <td>
                                    <a href="<?=site_url('?teacher=&class='.$class['id'].'&room=')?>" title="<?=lang('btn_jump_timetable')?>">
                                        <img src="<?=site_url('assets/img/icons/table.png')?>" alt="<?=lang('btn_jump_timetable')?>"></a>
                                    <a href="<?=site_url('school/delete/class/'.$class['id'])?>" title="<?=lang('btn_remove')?>" onclick="return confirm('<?=lang('btn_confirm_remove')?>')">
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