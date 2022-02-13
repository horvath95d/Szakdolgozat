                <?php if (strpos($_SERVER['PHP_SELF'], 'topic') !== false) : ?>
                <div class="mt-3">Ha nem sikerült megoldani a problémát vagy vannak még kérdései, <a href="<?=site_url('help/contact')?>">írjon nekünk.</a></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <footer class="mt-3 mb-5">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 font-weight-bold">
                    <ul>
                        <li class="float-left mr-3"><a href="<?=site_url('help/about')?>">rólunk</a></li>
                        <li class="float-left mr-3"><a href="<?=site_url('help/policies/terms')?>">felhasználási feltétlek</a></li>
                        <li class="float-left mr-3"><a href="<?=site_url('help/policies/privacy')?>">adatvédelem</a></li>
                        <li class="float-left mr-3"><a href="<?=site_url('help/policies/cookies')?>">cookie</a></li>
                    </ul>
                    <div class="float-right">&copy; <?=date("Y")?> Horváth Dániel</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul>
                        <li class="float-left mr-3"><a href="<?=site_url('home/lang/hungarian')?>">magyar</a></li>
                        <li class="float-left mr-3"><a href="<?=site_url('home/lang/english')?>">english</a></li>
                        <li class="float-left mr-3"><a href="#">deutsch</a></li>
                        <li class="float-left mr-3"><a href="#">français</a></li>
                        <li class="float-left mr-3"><a href="#">español</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery, Bootstrap, JavaScript -->
    <script src="<?=site_url('assets/vendor/jquery/jquery-3.4.1.min.js')?>"></script>
    <script src="<?=site_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?=site_url('assets/js/help.js')?>"></script>
</body>
</html>