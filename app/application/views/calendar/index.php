<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="sticky-top pt-3">
                <div class="card">
                    <h5 class="card-header"><i class="far fa-calendar-plus mr-2"></i><?=lang('new_event')?></h5>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="name"><?=lang('name')?></label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="start"><?=lang('start')?></label>
                                <input type="date" name="start" id="start" class="form-control" onchange="addSelect()" required>
                            </div>
                            <div class="form-group">
                                <label for="end"><?=lang('end')?></label>
                                <input type="date" name="end" id="end" class="form-control" onchange="addSelect()">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-form"><?=lang('add')?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9 my-3">
            <div class="card">
                <h5 class="card-header"><i class="far fa-calendar-alt mr-2"></i><?=lang('link_calendar')?></h5>
                <div class="card-body">
                    <table id="calendar">
                        <thead>
                            <tr>
                                <th colspan="6" id="month"></th>
                                <th>
                                    <a href="#" title="<?=lang('prev_month')?>" onclick="previous(); return false"><i class="fas fa-arrow-left"></i></a>
                                    <a href="#" title="<?=lang('this_month')?>" onclick="showToday(); return false"><i class="far fa-dot-circle"></i></a>
                                    <a href="#" title="<?=lang('next_month')?>" onclick="next(); return false"><i class="fas fa-arrow-right"></i></a>
                                </th>
                            </tr>
                            <tr>
                                <th><?=lang('monday')?></th>
                                <th><?=lang('tuesday')?></th>
                                <th><?=lang('wednesday')?></th>
                                <th><?=lang('thursday')?></th>
                                <th><?=lang('friday')?></th>
                                <th><?=lang('saturday')?></th>
                                <th><?=lang('sunday')?></th>
                            </tr>
                        </thead>
                        <tbody id="calendar-body"></tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <a href="pdf/calendar" target="_blank" class="float-right" title="<?=lang('print_title')?>">
                        <img src="assets/img/icons/print.png" alt="<?=lang('print')?>">
                        <span>&nbsp;<?=lang('print')?></span>
                    </a>
                    <h5 class="m-0"><i class="fas fa-glass-cheers mr-2"></i><?=lang('events')?></h5>
                </div>
                <div class="card-body">
                    <?php if (empty($events)): ?>
                        <div class="text-center">Még nem hoztál létre eseményeket! </div>
                    <?php endif; foreach ($events as $event): ?>
                        <div class="row border-bottom">
                            <div class="col-4 py-2 border-right"><?=$event['start']; echo ($event['end'] != NULL) ? ' - '.$event['end'] :''?></div>
                            <div class="col-7 py-2"><?=$event['name']?></div>
                            <div class="col-1 py-2 text-right">
                                <a href="calendar/delete/<?=$event['id']?>" title="<?=lang('btn_remove')?>">
                                    <img src="<?=site_url('assets/img/icons/drop.png')?>" alt="<?=lang('btn_remove')?>">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>