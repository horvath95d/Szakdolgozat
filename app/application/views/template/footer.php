    <footer>
        <div class="container">
            <ul class="list-style-none">
                <li class="float-left mr-2"><a href="help/contact"><?=lang('contact')?></a></li>
                <li class="float-left mr-2"><a href="help"><?=lang('link_help')?></a></li>
                <li class="float-left mr-2"><a href="help/policies/terms"><?=lang('policies_terms')?></a></li>
                <li class="float-left mr-2"><a href="help/policies/privacy"><?=lang('policies_privacy')?></a></li>
                <li class="float-left mr-2"><a href="help/policies/cookies"><?=lang('policies_cookie')?></a></li>
            </ul>
            <div class="float-right">&copy; <?=date("Y")?> Horváth Dániel</div>
        </div>
    </footer>
    <!-- jQuery, Bootstrap, JavaScript -->
    <script src="<?=site_url('assets/vendor/jquery/jquery-3.4.1.min.js')?>"></script>
    <script src="<?=site_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <?php
    switch ($this->router->class) {
        case 'home':
            echo "<script src=".site_url('assets/js/timetable.js')."></script>";
        break;

        case 'school':
            switch ($this->router->method) {
                case 'subject': echo "<script src=".site_url('assets/js/school/subject.js')."></script>"; break;
                case 'teacher': echo "<script src=".site_url('assets/js/school/teacher.js')."></script>"; break;
                case 'class': echo "<script src=".site_url('assets/js/school/class.js')."></script>"; break;
                case 'room': echo "<script src=".site_url('assets/js/school/room.js')."></script>"; break;
            }
            break;
            
        case 'lesson':
            switch ($this->router->method) {
                case 'no': echo "<script src=".site_url('assets/js/lesson/no.js')."></script>"; break;
                case 'class':
                case 'year': echo "<script src=".site_url('assets/js/lesson/class.js')."></script>"; break;
            }
            break;

        case 'calendar':
            echo "<script src=".site_url('assets/js/calendar.js')."></script>";
            break;

        case 'settings':
            echo "<script src=".site_url('assets/js/settings.js')."></script>";
            break;
    }
    ?>
    <script src="<?=site_url('assets/js/excel.js')?>"></script>
</body>
</html>