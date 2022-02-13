<div class="row">
    <div class="m-auto">
        <div><i class="fas fa-home"></i>&nbsp;<?=lang('location')?></div>
        <div><i class="fas fa-envelope"></i>&nbsp;<?=lang('mail')?></div>
    </div>
</div>
<div class="row">
    <div class="col-10 m-auto">
        <h2 class="text-center text-blue my-4"><?=lang('write_us')?></h2>
        <form action="email" method="POST">
            <div class="row mb-2">
                <div class="col-6">
                    <input type="text" class="form-control" name="name" placeholder="<?=lang('name')?>" required <?php if (isset($user)) echo "value=".$user->username?>>
                </div>
                <div class="col-6">
                    <input type="text" class="form-control" name="email" placeholder="<?=lang('email')?>" required <?php if (isset($user)) echo "value=".$user->email?>>
                </div>
            </div>

            <input type="text" class="form-control mb-2" name="subject" placeholder="<?=lang('subject')?>" required>
            <textarea class="form-control mb-2" name="message" placeholder="<?=lang('message')?>" rows="6" required></textarea>
            <button class="btn btn-form w-100"><?=lang('send')?>&nbsp;<i class="fas fa-arrow-right"></i></button>
        </form>
    </div>
</div>