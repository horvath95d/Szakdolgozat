<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="sticky-top pt-3">
                <h5><i class="fas fa-school mr-2"></i><?=lang('link_school')?></h5>
                <?php include_once 'nav.php'; ?>
            </div>
        </div>
        <div class="col-9">
            <div class="card my-3">
                <h5 class="card-header"><i class="fas fa-book mr-2"></i><?=lang('link_subject')?></h5>
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('subjectUniqueName')?></div>
                        <div class="col-4 py-2"><?=verify('subjectUniqueName')?></div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('subjectHaveTeacher')?></div>
                        <div class="col-4 py-2"><?=verify('subjectHaveTeacher')?></div>
                    </div>
                    <div class="row">
                        <div class="col-8 py-2 border-right"><?=lang('subjectHaveLesson')?></div>
                        <div class="col-4 py-2"><?=verify('subjectHaveLesson')?></div>
                    </div>
                </div>
            </div>

            <div class="card my-3">
                <h5 class="card-header"><i class="fas fa-user-graduate mr-2"></i><?=lang('link_teacher')?></h5>
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('teacherUniqueName')?></div>
                        <div class="col-4 py-2"><?=verify('teacherUniqueName')?></div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('teacherHaveSubject')?></div>
                        <div class="col-4 py-2"><?=verify('teacherHaveSubject')?></div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('teacherHaveLesson')?></div>
                        <div class="col-4 py-2"><?=verify('teacherHaveLesson')?></div>
                    </div>
                    <div class="row">
                        <div class="col-8 py-2 border-right"><?=lang('teacherMaxLesson')?></div>
                        <div class="col-4 py-2"><?=verify('teacherMaxLesson')?></div>
                    </div>
                </div>
            </div>

            <div class="card my-3">
                <h5 class="card-header"><i class="fas fa-users mr-2"></i><?=lang('link_class')?></h5>
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('classUniqueName')?></div>
                        <div class="col-4 py-2"><?=verify('classUniqueName')?></div>
                    </div>
                    <div class="row">
                        <div class="col-8 py-2 border-right"><?=lang('classMissingData')?></div>
                        <div class="col-4 py-2"><?=verify('classMissingData')?></div>
                    </div>
                    <!--
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right">Minden osztálynak az osztályfőnöke és a terme egyedi</div>
                        <div class="col-4 py-2"></div>
                    </div>
                    -->
                </div>
            </div>

            <div class="card my-3">
                <h5 class="card-header"><i class="fas fa-door-open mr-2"></i><?=lang('link_room')?></h5>
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('roomUniqueName')?></div>
                        <div class="col-4 py-2"><?=verify('roomUniqueName')?></div>
                    </div>
                    <div class="row">
                        <div class="col-8 py-2 border-right"><?=lang('roomHaveLesson')?></div>
                        <div class="col-4 py-2"><?=verify('roomHaveLesson')?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>