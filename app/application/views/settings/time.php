<div class="container my-3">
    <div class="row">
        <div class="col-3">
            <h5><i class="far fa-clock mr-2"></i><?=lang('link_time')?></h5>
            <?php include 'nav.php' ?>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <form action="time" method="post" accept-charset="utf-8">
                        <table id="time">
                            <tr>
                                <th><?=lang('time_number')?></th>
                                <th><?=lang('start')?></th>
                                <th><?=lang('end')?></th>
                                <th></th>
                            </tr>
                            
                            <?php if (empty($times)): ?>
                            <tr>
                                <td>
                                    <div>1</div>
                                </td>
                                <td>
                                    <input type="time" name="start[]" autofocus>
                                </td>
                                <td>
                                    <input type="time" name="end[]">
                                </td>
                                <td></td>
                            </tr>
                            <?php else: $i=1; foreach($times as $time): ?>
                            <tr>
                                <input type="hidden" name="id[]" value="<?=$time['id']?>">
                                <td>
                                    <div><?=$i?></div>
                                </td>
                                <td>
                                    <input type="time" name="start[]" value="<?=$time['start']?>" required>
                                </td>
                                <td>
                                    <input type="time" name="end[]" value="<?=$time['end']?>" required>
                                </td>
                                <td>
                                    <a href="<?=site_url('edit/delete/time/'.$time['id'])?>" title="<?=lang('btn_remove')?>" onclick="return confirm('<?=lang('btn_confirm_remove')?>')">
                                        <img src="<?=site_url('assets/img/icons/drop.png')?>" alt="<?=lang('btn_remove')?>">
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; endforeach; endif; ?>                    
                        </table>
                        <?php include_once "application/views/template/operations.php" ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>