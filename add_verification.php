<style>
.button {
  border: none;
  color: white;
  padding: 3px 7px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 3px 2px;
  cursor: pointer;
}
</style>
<div class="modal fade" id="update_modal<?php echo $fetch['id']?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="add_verification_query.php">
				<div class="modal-header"><button type="button" class="close" style="color: red;" data-dismiss="modal"><b>&times;</b></button>
					<h4 class="modal-title" style="color:black;text-align:center">REQUEST FOR MIGS STATUS VERIFICATION</h4><hr />
					<h3 class="modal-title" style="color:green;text-align:center"><?php echo $fetch['firstname']." ". $fetch['middlename']." ". $fetch['lastname']?></h3>
				</div>
				<div class="modal-body">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="form-group">
							<input type="hidden" name="id" value="<?php echo $fetch['id']?>"/>
							<!--<input type="hidden" name="pbno" value="<?php echo $fetch['pbno']?>"/>-->
							<input type="hidden" name="pbnum" value="<?php echo $fetch['pbnum']?>"/>
							<input type="hidden" name="memid" value="<?php echo $fetch['memid']?>"/>
							<input type="hidden" name="name" value="<?php echo $fetch['firstname']." ". $fetch['middlename']." ". $fetch['lastname']?>"/>
                              <input type="hidden" name="bday" value="<?php echo $fetch['bday']?>"/>
                              <input type="hidden" name="branch" value="<?php echo $fetch['branch']?>"/>
                              <input type="hidden" name="status" value="<?php echo $fetch['status']?>"/>
                              <input type="hidden" name="verification_stat" value="Pending"/>
							<br />
							<label style="text-align:left;">Please type in your mobile number (ex.0966587XXXX)</label>
				      	<!-- <input type = "text" name="contact_no" id="contact_no" class="form-control"  onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" type = "number" min = "11" max = "13"  style="text-align:center;font-size:24px;font-weight:bold;" required/> -->
                <input type="tel" name="contact_no" id="contact_no" class="form-control" minlength="11" maxlength="11" onkeypress="return isNumeric(event)" style="text-align:center;font-size:24px;font-weight:bold;" required/>
				 		 	</div>
					</div>
					<div style="clear:both;">
					<div class="modal-footer"></div>
						<div style="text-align:center">
							<button name="save" class="btn btn-success"><span class="glyphicon glyphicon-cloud"></span> Submit</button>
						</div><br />
						<div style="text-align:center">
							<label>OR</label><br /><br />
							<label>You may Call these Hotlines:<br /> <span class="button btn-info" style="size:20px;text-align:center">
	<pre>
    0917-876-6802 (Lagro Office)   &nbsp;&nbsp;
    0917-621-9412 (Bulacan Office) &nbsp;&nbsp;
    0917-623-3640 (Fairview Office)&nbsp;&nbsp;
    0917-713-9448 (Kiko Office)    &nbsp;&nbsp;
    0917-876-6792 (Camarin Office) &nbsp;&nbsp;
    0917-876-6800 (BSilang Office) &nbsp;&nbsp;
    0917-620-3141 (Main Office)    &nbsp;&nbsp;
    0917-620-2749 (Main Office)    &nbsp;&nbsp;
    0917-620-2618 (Main Office)    &nbsp;&nbsp;
    0917-876-6795 (Main Office)    &nbsp;&nbsp;
    </pre>
                                  </span></label>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
  function maxLengthCheck(object) {
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength)
  }

  function isNumeric (evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode (key);
    var regex = /[0-9]|\./;
    if ( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }
</script>
