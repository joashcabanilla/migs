<div class="modal fade updateBdayModal" id="update_modal<?php echo $data['id']?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" class="updateBdayForm">
				<div class="modal-header"><label>Update member's birth date:</label>
					<h3 class="modal-title" style="color:green;text-align:center">&nbsp;&nbsp;&nbsp;<?php echo $data['firstname']." ". $data['middlename']." ". $data['lastname']?></h3>
				</div>
				<div class="modal-body">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="form-group">
							<input type="hidden" name="id" value="<?php echo $data['id']?>"/>
							Birth date: MM/DD/YYYY<input type="date" class="form-control" name="bday" value="<?php echo date("Y-m-d", strtotime($data['bday']))?>" style="font-size:28px;text-align:center">
							<input type="hidden" name="updatedBy" value="<?php echo $_SESSION["firstname"]?>"/>
						</div>
					</div>
					<div style="clear:both;">
					<div class="modal-footer"></div><br />
						<div style="text-align:center">
							<button name="update" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Update</button>
							<button class="btn btn-danger" type="button" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
