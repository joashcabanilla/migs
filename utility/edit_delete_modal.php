<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Update Request Status</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="edit.php">
				<input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
				<input type="hidden" class="form-control" name="verified" value="1">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Status:</label>
					</div>
					<div class="col-sm-10">
            <select name="verification_stat" class="form-control">
              <option value="Verified" style="font-size:18px;" <?php if($row['verification_stat'] == "Verified"){echo "selected";}?>>Verified</option>
              <option value="Pending" style="font-size:18px;" <?php if($row['verification_stat'] == "Pending"){echo "selected";}?>>Pending</option>
            </select>
					</div>
				</div>

			</div>
            <div class="modal-footer">
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</a>
			</form>
            </div>

        </div>
    </div>
</div>
