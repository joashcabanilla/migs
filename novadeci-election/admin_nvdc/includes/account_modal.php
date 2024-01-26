<!-- Add -->
<div class="modal fade" id="newAccountModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>New Account</b></h4>
            </div>
            <form class="form-horizontal" method="POST" action="account_add.php" id="newMemberForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="uFullname" class="col-sm-3 control-label">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="uFullname" name="uFullname" placeholder="optional">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uUsername" class="col-sm-3 control-label"><span class="text-danger">* </span>Username:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="uUsername" name="uUsername" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uPassword" class="col-sm-3 control-label"><span class="text-danger">* </span>Password:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="uPassword" name="uPassword" required autocomplete>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="uType" class="col-sm-3 control-label"><span class="text-danger">* </span>Status:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="uType" name="uType" required>
                                <option value="supplies">Supplies</option>
                                <option value="pre-ga">Pre GA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" name="add" frmTrgt='#newAccountModal'><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="editAccountForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Edit Account</b></h4>
            </div>
            <form class="form-horizontal" method="POST" action="account_edit.php">
                <div class="modal-body">
                    <input type="hidden" class="id" name="a_id">
                    <div class="form-group">
                        <label for="efullname" class="col-sm-3 control-label">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="efullname" name="efullname" placeholder="optional">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="eusername" class="col-sm-3 control-label"><span class="text-danger">* </span>Username:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="eusername" name="eusername" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="e_account_status" class="col-sm-3 control-label"><span class="text-danger">* </span>Status:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="e_account_status" name="e_account_status" required>
                                <option value="active">Active</option>
                                <option value="block">Block</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="eType" class="col-sm-3 control-label"><span class="text-danger">* </span>Type:</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="eType" name="eType" required>
                                <option value="supplies">Supplies</option>
                                <option value="pre-ga">Pre GA</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="epassword" class="col-sm-3 control-label">Password:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="epassword" name="epassword" autocomplete>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat" name="edit" frmTrgt='#editAccountForm'><i class="fa fa-check-square-o"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>