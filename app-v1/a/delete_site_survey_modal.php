<!-- Delete site survey modal -->
<div class="modal fade" id="deleteSiteSurveyModal<?php echo $sLFId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!---<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                <h5 class="modal-title" id="myModalLabel"><strong>Delete Site Survey!</strong></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
			
			</div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    Are you sure you want to delete this site survey for this client <span class="label-primary label label-default">[<?php echo $clientName; ?>]?</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true"><i class="fa fa-fw fa-times-circle"></i> Cancel</button>
                    <a href="deleteCourseQuery.php<?php echo '?survey_id='.$sLFId; ?>" class="btn btn-danger"><i class="fa fa-fw fa-check-circle"></i> Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>