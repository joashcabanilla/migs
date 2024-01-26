<!-- Config -->
<div class="modal fade" id="config">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Configuration</b></h4>
            </div>
            <div class="modal-body">
              <div class="text-center">
                <?php
                  $parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
                  $title = $parse['election_title'];
                  $start_time = $parse['election_start_time'];
                  $end_time = $parse['election_end_time'];
	              $ips = json_decode($parse['f2f_ip']);
	              $system_stat = $parse['system_status'];
                  $textArea = '';
                  foreach($ips as $key => $value) :
                    end($ips);
                    $textArea .= $value . ($key === key($ips) ? "": ","); 
                  endforeach
                ?>
                <form class="form-horizontal" method="POST" action="config_save.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>">
                  <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="start_time" class="col-sm-3 control-label">Start</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="start_time" name="start_time" value="<?php echo $start_time; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="end_time" class="col-sm-3 control-label">End</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="end_time" name="end_time" value="<?php echo $end_time; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="end_time" class="col-sm-3 control-label">F2F IP</label>
                    <div class="col-sm-9">
                      <span class="text-danger">Note: comma-separated + new line</span>
                      <textarea name="f2f" class="col-sm-3 form-control" cols="30" rows="5" placeholder="180.191.51.17,
180.190.51.24"><?= $textArea?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="end_time" class="col-sm-3 control-label">Election System</label>
                    <div class="col-sm-9">
                      <select name="system_stat" class="form-control">
                        <option value="UP" <?php echo $system_stat == 'UP' ? 'selected' : null ?>>UP</option>
                        <option value="DOWN" <?php echo $system_stat == 'DOWN' ? 'selected' : null ?>>DOWN</option>
                      </select>
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>