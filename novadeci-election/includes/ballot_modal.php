<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
<!-- Preview -->
<div class="modal fade" id="preview_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Vote Preview</h4>
            </div>
            <div class="modal-body">
              <div id="preview_body"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Platform -->
<div class="modal fade" id="platform">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="candidate"></b></h4>
            </div>
            <div class="modal-body">
              <p id="plat_view"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- View Ballot -->
<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Your Votes</h4>
            </div>
            <div class="modal-body">
              <?php
                $id = $voter['id'];
                $sql = "SELECT *, candidates.firstname AS canfirst, candidates.lastname AS canlast FROM votes LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN positions ON positions.id=votes.position_id WHERE voters_id = '$id'  ORDER BY positions.priority ASC";
                $query = $conn->query($sql);

	              $output = array('error'=>false,'list'=>'');

                $des = null;

                while($row = $query->fetch_assoc()){

                  
                  $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/profile.jpg';
        
                  $description = $des == $row['description'] ? '' : $row['description'].':';

                  $output['list'] .= "
                      <div class='row votelist'>
                        <span class='col-sm-12'>
                            <b>". $description ."</b>
                        </span> 
                      </div>
                      <div class='row '>
                        <div class='text-center'>
                          <img src='$image' height='100px' width='100px'>
                          <br>
                          <span>".$row['firstname']." ".$row['lastname']."</span>
                        </div>
                      </div>";
                      $des = $row['description'];
                }

                echo $output['list'];
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success btn-flat pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>
