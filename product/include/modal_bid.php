<div id="bid" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4>Bid</h4>
        <p>Current Highest Price: £ <?php echo $productInfo[price]; ?></p>
      </div>
      <div class="modal-body">
        <div class="form">
          
            <form class="form-horizontal" method="post">
            <div class="form-group">
                <label class="control-label col-md-3" for="bidPrice">Your Bid Price</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" id="bidPrice" name="bid[price]">
                </div>
            </div> 

            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <div class="checkbox inline">
                  <label>
                  <input type="checkbox" id="inlineCheckbox" value="on" name="bid[agree]"> Agree with Terms and Conditions
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <input type="submit" class="btn btn-danger" name="bid[submit]" value="Bid">
                <button type="reset" class="btn btn-default">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <p>You still have <div id="bidCountdown"></div> to bid.</p>
      </div>
    </div>
  </div>
</div>