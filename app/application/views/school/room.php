<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="sticky-top pt-3">
                <h5><i class="fas fa-door-open mr-2"></i><?=lang('link_room')?></h5>
                <?php include "nav.php" ?>
            </div>
        </div>
        <div class="col-9">
            <div class="card my-3">
                <div class="card-body">
                    <form method="post" accept-charset="utf-8">
                        <table>
                            <tr>
                                <th><?=lang('name_or_number')?></th>
                                <th style="width:30%"><?=lang('link_subject')?></th>
                                <th><?=lang('room_members')?></th>
                                <th></th>
                            </tr>
                                
                            <?php if (empty($rooms)): ?>
                            <tr>
                                <td>
                                    <input type="text" name="name[]" maxlength="25" autofocus>
                                </td>
                                <td>
                                    <input type="hidden" name="room_id[0][]">
                                    <select name="subject_id[0][]">
                                        <option></option>
                                        <?php foreach ($subjects as $subject): ?>
                                        <option value="<?=$subject['id']?>"><?=$subject['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="members[]>" min="1" value="1">
                                </td>
                                <td>
                                    <a href="#" onclick="insertSubjectSelect(this); return false;" title="<?=lang('btn_insert_subject_title')?>">
                                        <img src="<?=site_url('assets/img/icons/insert.png')?>" alt="<?=lang('btn_insert_subject_title')?>">
                                    </a>
                                </td>
                            </tr>
                            <?php else: $i=0; foreach($rooms as $room): ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="id[]" value="<?=$room['id']?>">
                                    <input type="text" name="name[]" maxlength="25" value="<?=$room['name']?>" required>
                                </td>
                                <td>
                                <?php if (roomHaveSubject($room['id'])):
                                    foreach ($rooms_subjects as $room_subject):
                                        if ($room_subject['room_id'] == $room['id']): ?>
                                            <input type="hidden" name="room_subject_id[<?=$i?>][]" value="<?=$room_subject['id']?>">
                                            <input type="hidden" name="room_id[<?=$i?>][]" value="<?=$room['id']?>">
                                            <select name="subject_id[<?=$i?>][]">
                                                <option></option>
                                                <?php foreach ($subjects as $subject): ?>
                                                <option value="<?=$subject['id']?>" <?=$subject['id'] == $room_subject['subject_id'] ? 'selected' : ''?>><?=$subject['name']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endif;
                                    endforeach;
                                else: ?>
                                    <input type="hidden" name="room_id[<?=$i?>][]" value="<?=$room['id']?>">
                                    <select name="subject_id[<?=$i?>][]">
                                        <option></option>
                                        <?php foreach ($subjects as $subject): ?>
                                        <option value="<?=$subject['id']?>"><?=$subject['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                                </td>
                                <td>
                                    <input type="number" name="members[]>" min="1" value="<?=$room['members']?>">
                                </td>
                                <td>
                                    <a href="<?=site_url('?teacher=&class=&room='.$room['id'])?>" title="<?=lang('btn_jump_timetable')?>">
                                        <img src="<?=site_url('assets/img/icons/table.png')?>" alt="<?=lang('btn_jump_timetable')?>"></a>
                                    <a href="#" onclick="insertSubjectSelect(this); return false;" title="<?=lang('btn_insert_subject_title')?>">
                                        <img src="<?=site_url('assets/img/icons/insert.png')?>" alt="<?=lang('btn_insert_subject_title')?>"></a>
                                    <a href="<?=site_url('school/delete/room/'.$room['id'])?>" title="<?=lang('btn_remove')?>" onclick="return confirm('<?=lang('btn_confirm_remove')?>')">
                                        <img src="<?=site_url('assets/img/icons/drop.png')?>" alt="<?=lang('btn_remove')?>">
                                    </a>
                                </td>
                            </tr>
                            <?php  $i++; endforeach; endif; ?>
                        </table>
                        <?php include_once "application/views/template/operations.php" ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>