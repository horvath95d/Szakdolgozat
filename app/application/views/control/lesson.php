<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="sticky-top pt-3">
                <h5><i class="fas fa-chalkboard-teacher mr-2"></i><?=lang('link_lesson')?></h5>
                <?php include_once 'nav.php'; ?>
            </div>
        </div>
        <div class="col-9">
            <div class="card my-3">
                <h5 class="card-header"><i class="far fa-calendar-times mr-2"></i><?=lang('link_no')?></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 py-2 border-right"><?=lang('noLessonHaveTime')?></div>
                        <div class="col-4 py-2"><?=verify('noLessonHaveTime')?></div>
                    </div>
                </div>
            </div>

            <div class="card my-3">
                <h5 class="card-header"><i class="fas fa-users mr-2"></i><?=lang('lessons_of_years')?> / <?=lang('lessons_of_classes')?></h5>
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('classHaveLesson')?></div>
                        <div class="col-4 py-2"><?=verify('classHaveLesson')?></div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-8 py-2 border-right"><?=lang('lessonHaveTeacher')?></div>
                        <div class="col-4 py-2"><?=verify('lessonHaveTeacher')?></div>
                    </div>
                    <div class="row">
                        <div class="col-8 py-2 border-right"><?=lang('lessonTeacherSubject')?></div>
                        <div class="col-4 py-2"><?=verify('lessonTeacherSubject')?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>