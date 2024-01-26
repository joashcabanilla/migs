<!-- Add -->
<div class="modal fade" id="newMemberModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add Member</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="voters_add.php" id="newMemberForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <span class="text-danger"><i>All fields are required.</i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pbno" class="col-sm-3 control-label">Passbook No.:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="pbno" name="pbno" required placeholder='NO PASSBOOK? INPUT "-" ONLY'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="memID" class="col-sm-3 control-label">Member ID:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="memID" name="memID" required placeholder='NO MEMBER ID? INPUT "-" ONLY'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="newFname" class="col-sm-3 control-label">First name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="newFname" name="newFname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="newMname" class="col-sm-3 control-label">Middle name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="newMname" name="newMname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="newLname" class="col-sm-3 control-label">Last name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="newLname" name="newLname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bday" class="col-sm-3 control-label">Birth Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bday" name="bday" placeholder="MM/DD/YYYY (ex.03/29/2021)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="membershipdate" class="col-sm-3 control-label">Membership Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="membershipdate" name="membershipdate" required placeholder="MM/DD/YYYY (ex.03/29/2021)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="status" name="status" required>
                                <option>SELECT STATUS</option>
                                <option value="MIGS">MIGS</option>
                                <option value="NON-MIGS">NON-MIGS</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="branch" class="col-sm-3 control-label">Branch</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="branch" name="branch" required>
                                <option>SELECT BRANCH</option>
                                <option value="MAIN OFFICE">MAIN OFFICE</option>
                                <option value="BSILANG OFFICE">BSILANG OFFICE</option>
                                <option value="BULACAN OFFICE">BULACAN OFFICE</option>
                                <option value="CAMARIN OFFICE">CAMARIN OFFICE</option>
                                <option value="FAIRVIEW OFFICE">FAIRVIEW OFFICE</option>
                                <option value="KIKO OFFICE">KIKO OFFICE</option>
                                <option value="LAGRO OFFICE">LAGRO OFFICE</option>
                                <option value="MUNOZ OFFICE">MUNOZ OFFICE</option>
                                <option value="TSORA OFFICE">TSORA OFFICE</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            <button type="submit" class="btn btn-primary btn-flat" name="add" frmTrgt='#newMemberModal'><i class="fa fa-save"></i> Save</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="editMemberForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Edit Member</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="voters_edit.php">
                    <input type="hidden" class="id" name="em_id">
                    <input type="hidden" name="vDate">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <span class="text-danger"><i>All fields are required.</i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="em_pbno" class="col-sm-3 control-label">Passbook No.:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="em_pbno" name="em_pbno" required placeholder='NO PASSBOOK? INPUT "-" ONLY'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="em_memID" class="col-sm-3 control-label">Member ID:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="em_memID" name="em_memID" required placeholder='NO MEMBER ID? INPUT "-" ONLY'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="em_Fname" class="col-sm-3 control-label">First name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="em_Fname" name="em_Fname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="em_Mname" class="col-sm-3 control-label">Middle name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="em_Mname" name="em_Mname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="em_Lname" class="col-sm-3 control-label">Last name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="em_Lname" name="em_Lname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="em_bday" class="col-sm-3 control-label">Birth Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="em_bday" name="em_bday" placeholder="MM/DD/YYYY (ex.03/29/2021)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="em_status" class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="em_status" name="em_status" required>
                                <option>SELECT STATUS</option>
                                <option value="MIGS">MIGS</option>
                                <option value="NON-MIGS">NON-MIGS</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="edit" frmTrgt='#editMemberForm'><i class="fa fa-check-square-o"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>