<div class="font-weight-bold"><?=lang('user_settings')?></div>
<ul class="left-nav">
    <li><a href="<?=site_url('settings')?>"><?=lang('link_general')?></a></li>
    <li><a href="<?=site_url('settings/security')?>"><?=lang('link_security')?></a></li>
    <li><a href="<?=site_url('settings/active')?>"><?=lang('link_active')?></a></li>
</ul>

<?php if ($school['owner_id'] == $user->id): ?>
<div class="font-weight-bold"><?=lang('school_settings')?></div>
<ul class="left-nav">
	<li><a href="<?=site_url('settings/school')?>"><?=lang('link_general')?></a></li>
	<li><a href="<?=site_url('settings/time')?>"><?=lang('link_time')?></a></li>
</ul>
<?php endif; ?>

<div class="font-weight-bold"><?=lang('datas')?></div>
<div class="settings-datas">
	<div class="row">
		<div class="col-4"><?=lang('username')?>:</div>
		<div class="col-8"><?=$user->username?></div>
	</div>
	<div class="row">
		<div class="col-4"><?=lang('email')?>:</div>
		<div class="col-8"><?=$user->email?></div>
	</div>
	<div class="row">
		<div class="col-4"><?=lang('created_on')?>:</div>
		<div class="col-8"><?=$user->created_on?></div>
	</div>
	<div class="row">
		<div class="col-4"><?=lang('active_end')?>:</div>
		<div class="col-8"><?=$user->active_end?></div>
	</div>
</div>