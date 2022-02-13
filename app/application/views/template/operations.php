<div class="text-right mt-3">
    <a href="#" id="insert" class="mr-2" title="<?=lang('btn_insert_title')?>">
        <img src="<?=site_url('assets/img/icons/edit.png')?>" alt="<?=lang('btn_insert')?>">
        <?=lang('btn_insert')?>
    </a>
    <a href="#" id="export" class="mr-2" title="<?=lang('btn_export_title')?>" download="<?=$school['short_name']?>-<?=$title?>.xls">
        <img src="<?=site_url('assets/img/icons/export.png')?>" alt="<?=lang('btn_export')?>">
        <?=lang('btn_export')?>
    </a>
</div>
<div class="text-center">
    <button type="submit" class="btn btn-1"><?=lang('btn_save')?></button>
</div>