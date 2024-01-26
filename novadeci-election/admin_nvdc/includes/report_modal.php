<div class="modal fade" id="reportWithTicketModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">CUSTOM REPORT PRINTING</h4>
            </div>
            <form action="report_result.php" method="post" target="_blank">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-2">
                            <label>Branch</label>
                            <select name="branchToPrint" class="form-control">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Date Voted</label>
                            <select name="dateToPrint" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-2">
                            <label>From</label>
                            <select name="fromTime" class="form-control">
                                <option value="All">All</option>
                                <option value="07:00:00">07:00:00</option>
                                <option value="08:00:00">08:00:00</option>
                                <option value="09:00:00">09:00:00</option>
                                <option value="10:00:00">10:00:00</option>
                                <option value="11:00:00">11:00:00</option>
                                <option value="12:00:00">12:00:00</option>
                                <option value="13:00:00">13:00:00</option>
                                <option value="14:00:00">14:00:00</option>
                                <option value="15:00:00">15:00:00</option>
                                <option value="16:00:00">16:00:00</option>
                                <option value="17:00:00">17:00:00</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>To</label>
                            <select name="toTime" class="form-control">
                                <option value="All">All</option>
                                <!--<option value="07:00:00">07:00:00</option>-->
                                <option value="08:00:00">08:00:00</option>
                                <option value="09:00:00">09:00:00</option>
                                <option value="10:00:00">10:00:00</option>
                                <option value="11:00:00">11:00:00</option>
                                <option value="12:00:00">12:00:00</option>
                                <option value="13:00:00">13:00:00</option>
                                <option value="14:00:00">14:00:00</option>
                                <option value="15:00:00">15:00:00</option>
                                <option value="16:00:00">16:00:00</option>
                                <option value="17:00:00">17:00:00</option>
                                <option value="18:00:00">18:00:00</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" name="toPrintPage" class="btn btn-success btn-flat"><i class="fa fa-eye"></i> Result</button>
                </div>
           </form>
        </div>
    </div>
</div>