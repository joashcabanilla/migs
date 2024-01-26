<!-- Config -->
<div class="modal fade" id="raffle">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Raffle Sequence</b></h4>
            </div>
            <div class="modal-body">
              <div class="text-center">
                <form class="form-horizontal" method="POST" action="sequence_update.php">
                  <input type="hidden" name="url">
                  <div class="form-group">
                    <label for="seqPrefix" class="col-sm-3 control-label">Prefix</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="seqPrefix">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="seqNo" class="col-sm-3 control-label">Sequence</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="seqNo">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="seqLength" class="col-sm-3 control-label">Length</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="seqLength">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="seqFill" class="col-sm-3 control-label">Fill</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="seqFill">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="seqOutput" class="col-sm-3 control-label">Output</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="seqOutput" readonly>
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