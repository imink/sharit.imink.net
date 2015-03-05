<div id="reply" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <!-- Form title -->
         <h4>Reply a Question</h4>
      </div> 
         <!-- Comment form starts -->
      <div class="modal-body">
         <div class="form">
           <form class="form-horizontal" method="post">
           <input id="targetQid" type="hidden" name="reply[qid]" value="<?php $qid?>" >
               <div class="form-group">
                 <label class="control-label col-md-3" for="question">Content</label>
                 <div class="col-md-6">
                   <textarea class="form-control" name="reply[content]"  rows="3">
                   </textarea>
                 </div>
               </div>

               <div class="form-group">
                  <div class="col-md-6 col-md-offset-3">
                      <button type="submit" name="reply[submit]" class="btn btn-default">Submit</button>
                      <button type="reset" class="btn btn-default">Reset</button>
                  </div>
               </div>
             </form>
           </div>
           <!-- Commment form ends -->
      </div>        
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>