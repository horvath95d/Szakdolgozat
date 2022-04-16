<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="sticky-top pt-3">
                <h5><i class="fas fa-user-graduate mr-3"></i><?=lang('link_teacher')?></h5>
                <?php include "nav.php" ?>
            </div>
        </div>
        <div class="col-9">
            <div class="card my-3">
                <div class="card-body">
                    <form method="post" accept-charset="utf-8">
                        <table>
                            <tr>
                                <th><?=lang('name')?></th>
                                <th style="width:220px"><?=lang('link_subject')?></th>
                                <th><?=lang('max_lesson_number')?></th>
                                <th></th>
                            </tr>
                            
                            <?php if (empty($teachers)): ?>
                            <tr>
                                <td>
                                    <input type="text" name="name[]" maxlength="25" autofocus>
                                </td>
                                <td>
                                    <input type="hidden" name="teacher_id[0][]">
                                    <select name="subject_id[0][]">
                                        <option></option>
                                        <?php foreach ($subjects as $subject): ?>
                                        <option value="<?=$subject['id']?>"><?=$subject['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="lesson_number[]" min="1" value="1">
                                </td>
                                <td>
                                    <a href="#" onclick="insertSubjectSelect(this); return false;" title="<?=lang('btn_insert_subject_title')?>">
                                        <img src="<?=site_url('assets/img/icons/insert.png')?>" alt="<?=lang('btn_insert_subject_title')?>">
                                    </a>
                                </td>
                            </tr>
                            <?php else: $i=0; foreach ($teachers as $teacher):?>
                            <tr>
                                <td>
                                    <input type="hidden" name="id[]" value="<?=$teacher['id']?>">
                                    <input type="text" name="name[]" maxlength="25" value="<?=$teacher['name']?>" required>
                                </td>
                                <td>
                                <?php if (teacherHaveSubject($teacher['id'])):
                                    foreach ($teachers_subjects as $teacher_subject):
                                        if ($teacher_subject['teacher_id'] == $teacher['id']): ?>
                                            <input type="hidden" name="teacher_subject_id[<?=$i?>][]" value="<?=$teacher_subject['id']?>">
                                            <input type="hidden" name="teacher_id[<?=$i?>][]" value="<?=$teacher['id']?>">
                                            <select name="subject_id[<?=$i?>][]">
                                                <option></option>
                                                <?php foreach ($subjects as $subject): ?>
                                                <option value="<?=$subject['id']?>" <?php if ($subject['id'] == $teacher_subject['subject_id']) echo "selected";?>><?=$subject['name']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endif;
                                    endforeach;
                                else: ?>
                                    <input type="hidden" name="teacher_id[<?=$i?>][]" value="<?=$teacher['id']?>">
                                    <select name="subject_id[<?=$i?>][]">
                                        <option></option>
                                        <?php foreach ($subjects as $subject): ?>
                                        <option value="<?=$subject['id']?>"><?=$subject['name']?></option>
                                        <?php endforeach; ?>
                                    </select>                        
                                <?php endif; ?>
                                </td>
                                <td>
                                    <input type="number" name="lesson_number[]" min="1" value="<?=$teacher['lesson_number']?>">
                                </td>
                                <td>
                                    <a href="<?=site_url('?teacher='.$teacher['id'].'&class=&room=')?>" title="<?=lang('btn_jump_timetable')?>">
                                        <img src="<?=site_url('assets/img/icons/table.png')?>" alt="<?=lang('btn_jump_timetable')?>"></a>
                                    <a href="#" onclick="insertSubjectSelect(this); return false;" title="<?=lang('btn_insert_subject_title')?>">
                                        <img src="<?=site_url('assets/img/icons/insert.png')?>" alt="<?=lang('btn_insert_subject_title')?>"></a>
                                    <a href="<?=site_url('school/delete/teacher/'.$teacher['id'])?>" onclick="return confirm('<?=lang('btn_confirm_remove')?>')" title="<?=lang('btn_remove')?>">
                                        <img src="<?=site_url('assets/img/icons/drop.png')?>" alt="<?=lang('btn_remove')?>">
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; endforeach; endif; ?>
                        </table>
                        <?php include_once "application/views/template/operations.php" ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>