<div class="container">
    <div class="card my-3">
        <div class="card-body">
            <form method="get" class="form-inline">
                <select name="teacher" class="form-control form-control-sm mr-2">
                    <option value=""><?=lang('teacher')?></option>
                    <?php foreach ($teachers as $teacher): ?>
                        <option value="<?=$teacher['id']?>" <?=isset($_GET['teacher']) && $_GET['teacher'] == $teacher['id'] ? 'selected' : ''?>><?=$teacher['name']?></option>
                    <?php endforeach; ?>
                </select>

                <select name="class" class="form-control form-control-sm mr-2">
                    <option value=""><?=lang('class')?></option>
                    <?php foreach ($classes as $class): ?>
                        <option value="<?=$class['id']?>" <?=isset($_GET['class']) && $_GET['class'] == $class['id'] ? 'selected' : ''?>><?=$class['name']?></option>
                    <?php endforeach; ?>
                </select>

                <select name="room" class="form-control form-control-sm mr-2">
                    <option value=""><?=lang('room')?></option>
                    <?php foreach ($rooms as $room): ?>
                        <option value="<?=$room['id']?>" <?=isset($_GET['room']) && $_GET['room'] == $room['id'] ? 'selected' : ''?>><?=$room['name']?></option>
                    <?php endforeach; ?>
                </select>

                <button class="btn btn-sm btn-form w-auto"><?=lang('filtration')?></button>
            </form>
        </div>
    </div>
</div>

<div id="timetable-container">
    <?php $week = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
    if (empty($_GET['teacher']) && empty($_GET['class']) && empty($_GET['room'])): ?>
    <div class="container-fluid">
        <table class="timetable-sm my-3">
            <tr>
                <th></th>
                <?php for ($i=0; $i < $school['days']; $i++): ?>
                <th colspan="<?=count($times)?>"><?=lang($week[$i])?></th>
                <?php endfor; ?>
            </tr>
            <tr>
                <th></th>
                <?php for ($d=1; $d < $school['days']+1; $d++): for ($i=1; $i < count($times)+1; $i++): ?>
                <th><?=$i?></th>
                <?php endfor; endfor; ?>
            </tr>
            
            <?php foreach ($classes as $class): ?>
            <tr>
                <th><?=substr($class['name'], 0, 4)?></th>
                <?php for ($d=1; $d < $school['days']+1; $d++):
                    for ($i=1; $i < count($times)+1; $i++): ?>
                        <td id="<?=$d?>,<?=$i?>">
                            <?php foreach ($lessons as $lesson)
                                if (($class['id'] == $lesson['class_id'] || $class['year'] == $lesson['year'])
                                    && $lesson['day'] == $d && $lesson['time'] == $i)
                                    echo lesson_box_sm($lesson);
                            ?>
                        </td>
                <?php endfor; endfor; ?>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="container">
        <div class="card my-3">
            <table>
                <tr>
                    <td id="0,0" class="timeless card-body">
                        <?php $section = '';
                            foreach ($lessons as $lesson) {
                                if ($lesson['day'] == 0 && $lesson['time'] == 0) {
                                
                                    if ($lesson['class_id'] == NULL && $section != $lesson['year']) {
                                        $section = $lesson['year'];
                                        echo '<div class="section">'.$lesson['year'].' .évfolyam</div>';
                                    
                                    } elseif ($lesson['class_id'] != NULL && $section != $lesson['class_id']) {
                                        $section = $lesson['class_id'];
                                        echo '<div class=section>'.getClassName($section).'</div>';
                                    }
                                    echo lesson_box_sm($lesson);
                                }
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <?php else: ?>
    <div class="container">
        <table class="timetable my-3">
            <tr>
                <th></th>
                <?php for ($i=0; $i < $school['days']; $i++): ?>
                <th><?=lang($week[$i])?></th>
                <?php endfor; ?>
            </tr>
            
            <?php for ($i=1; $i < count($times)+1; $i++): ?>
            <tr>
                <th><?=$times[$i-1]['start']?> - <?=$times[$i-1]['end']?></th>
                <?php for ($d=1; $d < $school['days']+1; $d++): ?>
                <td id="<?=$d?>,<?=$i?>">
                    <?php foreach ($lessons as $lesson)
                        if ($lesson['day'] == $d && $lesson['time'] == $i)
                            echo lesson_box($lesson);
                    ?>
                </td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        </table>
    </div>

    <div class="container">
        <div class="card my-3">
            <table>
                <tr>
                    <td id="0,0" class="timeless card-body">
                        <?php
                            foreach ($lessons as $lesson)                            
                                if ($lesson['day'] == 0 && $lesson['time'] == 0)
                                    echo lesson_box($lesson);
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php endif;?>
</div>

<div class="container">
    <div class="card my-3">
        <div class="card-body">
            <a href="home/generate" class="mr-2" title="<?=lang('generate_title')?>">
                <img src="<?=site_url("assets/img/icons/insert.png")?>" alt="<?=lang('generate_title')?>">
                <?=lang('generate')?>
            </a>
            <a href="#" id="export" class="mr-2" title="<?=lang('btn_export_title')?>" download="<?=$school['short_name']?>-<?=$title?>.xls">
                <img src="<?=site_url('assets/img/icons/export.png')?>" alt="<?=lang('btn_export_title')?>">
                <?=lang('btn_export')?>
            </a>
            <a href="pdf<?=isset($_GET['teacher']) ? '/?teacher='.$_GET['teacher'].'&class='.$_GET['class'].'&room='.$_GET['room']:''?>" target="_blank" class="mr-2" title="<?=lang('print_title')?>">
                <img src="assets/img/icons/print.png" alt="<?=lang('print_title')?>">
                <?=lang('print')?>
            </a>
            <br>
            <a href="home/fixRoomsRemove" class="mr-2" title="<?=lang('fixRoomsRemove_title')?>" onclick="return confirm('<?=lang('fixRoomsRemove_confirm')?>')">
                <img src="<?=site_url("assets/img/icons/roomoff.png")?>" alt="<?=lang('fixRoomsRemove_title')?>">
                <?=lang('fixRoomsRemove')?>
            </a>
            <a href="home/fixTimeRemove" class="mr-2" title="<?=lang('fixTimeRemove_title')?>" onclick="return confirm('<?=lang('fixRoomsRemove_confirm')?>')">
                <img src="<?=site_url("assets/img/icons/empty.png")?>" alt="<?=lang('fixTimeRemove_title')?>">
                <?=lang('fixTimeRemove')?>
            </a>
            <a href="home/emptying" class="mr-2" title="<?=lang('removeLessons_title')?>" onclick="return confirm('<?=lang('removeLessons_confirm')?>')">
                <img src="<?=site_url("assets/img/icons/emptying.png")?>" alt="<?=lang('removeLessons_title')?>">
                <?=lang('removeLessons')?>
            </a>
        </div>
    </div>
</div>