<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="sticky-top py-3">
                <h5><i class="fas fa-chalkboard-teacher mr-2"></i><a href="<?=site_url('?teacher=&class='.$id.'&room=')?>"><?=$title?></a></h5>
                <?php include_once "nav.php"; ?>
            </div>
        </div>
        <div class="col-9">
            <div class="card my-3">
                <div class="card-body">
                    <form method="post" accept-charset="utf-8">
                        <input type="hidden" name="class_id" value="<?=$id?>">
                        <table>
                            <tr>
                                <th><?=lang('subject')?></th>
                                <th><?=lang('teacher')?></th>
                                <th><?=lang('times_week')?></th>
                                <th></th>
                            </tr>

                            <?php if (empty($lessons)): ?>
                            <tr>
                                <td>
                                    <select name="subject_id[]" onchange="changeTeacherList(this)" autofocus>
                                        <option></option>
                                        <?php foreach ($subjects as $subject): ?>
                                        <option value="<?=$subject['id']?>"><?=$subject['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="teacher_id[]">
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
                            <?php else: foreach ($lessons as $lesson): ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="id[]" value="<?=$lesson['id']?>">
                                    <select name="subject_id[]" onchange="changeTeacherList(this)" required>
                                        <?php foreach ($subjects as $subject): ?>
                                        <option value="<?=$subject['id']?>" <?php if ($lesson['subject_id'] == $subject['id']) echo "selected"?>><?=$subject['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="teacher_id[]" required>
                                        <option></option>
                                        <?php foreach ($teachers as $teacher): if (teacherHaveSubject2($teacher['id'], $lesson['subject_id'])): ?>
                                        <option value="<?=$teacher['id']?>" <?php if ($lesson['teacher_id'] == $teacher['id']) echo "selected";?>><?=$teacher['name']?></option>
                                        <?php endif; endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="count[]" min="1" value="<?=$lesson['count']?>">
                                </td>
                                <td>
                                    <a href="<?=site_url('lesson/delete/'.$lesson['id'])?>" title="<?=lang('btn_remove')?>" onclick="return confirm('<?=lang('btn_confirm_remove')?>')">
                                        <img src="<?=site_url('assets/img/icons/drop.png')?>" alt="<?=lang('btn_remove')?>">
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; endif; ?>
                        </table>
                        <?php include "application/views/template/operations.php" ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>