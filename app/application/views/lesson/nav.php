<div class="font-weight-bold"><?=lang('special_lessons')?></div>
<ul class="left-nav">
    <li><a href="<?=site_url('lesson/no')?>"><?=lang('link_no')?></a></li>
</ul>

<div class="font-weight-bold"><?=lang('lessons_of_years')?></div>
<ul class="left-nav">
    <?php foreach ($years as $year): ?>
    <li><a href="<?=site_url('lesson/year/'.$year['year'])?>"><?=$year['year']?>. éfolyam</a></li>
    <?php endforeach; ?>
</ul>

<div class="font-weight-bold"><?=lang('lessons_of_classes')?></div>
<ul class="left-nav">
    <?php foreach ($classes as $class): ?>
    <li><a href="<?=site_url('lesson/class/'.$class['id'])?>"><?=$class['name']?></a></li>
    <?php endforeach; ?>
</ul>