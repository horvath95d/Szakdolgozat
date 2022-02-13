<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="sticky-top pt-3">
                <h5><i class="far fa-calendar-alt mr-2"></i><?=lang('link_timetable')?></h5>
                <?php include_once 'nav.php'; ?>
            </div>
        </div>
        <div class="col-9">
            <div id="timetable" class="card my-3">
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('lessonHaveTime')?></div>
                        <div class="col-4 py-2"><?=verify('lessonHaveTime')?></div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('lessonHaveRoom')?></div>
                        <div class="col-4 py-2"><?=verify('lessonHaveRoom')?></div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('lessonMember')?></div>
                        <div class="col-4 py-2"><?=verify('lessonMember')?></div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('teacherOneLesson')?></div>
                        <div class="col-4 py-2"><?=verify('teacherOneLesson')?></div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('classOneLesson')?></div>
                        <div class="col-4 py-2"><?=verify('classOneLesson')?></div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('roomOneLesson')?></div>
                        <div class="col-4 py-2"><?=verify('roomOneLesson')?></div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right">Ha egy tantárgyból egy osztálynak maximum <?=$school['days']?> órája van, azok külön napokon vannak megtartva, kivéve ha fix beálítással mást nem adtunk meg</div>
                        <div class="col-4 py-2"><?=verify('oneSubjectPerDay')?></div>
                    </div>
                    <!--
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('classMissingLesson')?></div>
                        <div class="col-4 py-2"><?=''//verify('classMissingLesson')?></div>
                    </div>
                    <div class="row">
                        <div class="col-8 py-2 border-right"><?=lang('follow_same_lesson')?></div>
                        <div class="col-4 py-2"><?=''//verify('follow_same_lesson')?></div>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>