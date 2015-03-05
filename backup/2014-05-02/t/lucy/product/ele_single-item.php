        <!-- Breadcrumbs -->
        <ul class="breadcrumb">
          <li><a href="index.html">Home</a> <span class="divider">/</span></li>
          <li><a href="items.html">Smartphone</a> <span class="divider">/</span></li>
          <li class="active">Apple</li>
        </ul>

        <!-- Product details starts -->
        <div class="product-main">
          <div class="row">
            <div class="col-md-6 col-sm-6">

              <!-- Image. Flex slider -->
                <div class="product-slider">
                  <div class="product-image-slider flexslider">
                    <ul class="slides">
                        <!-- Each slide should be enclosed inside li tag. -->
                        
                        <!-- Slide #1 -->
                      <li style="width: 100%; float: left; margin-right: -100%; position: relative; display: none;" class="">
                        <!-- Image -->
                        <img src="img/photos/1-1.png" alt="">
                      </li>
                      
                        <!-- Slide #2 -->
                      <li style="width: 100%; float: left; margin-right: -100%; position: relative; display: none;" class="">
                        <img src="img/photos/1-2.png" alt="">
                      </li>
                      
                      <li style="width: 100%; float: left; margin-right: -100%; position: relative; display: none;" class="">
                        <img src="img/photos/1-3.png" alt="">
                      </li>
                      
                      <li style="width: 100%; float: left; margin-right: -100%; position: relative; display: none;" class="">
                        <img src="img/photos/1-4.png" alt="">
                      </li>

                      <li style="width: 100%; float: left; margin-right: -100%; position: relative; display: list-item;" class="flex-active-slide">
                        <img src="img/photos/1-5.png" alt="">
                      </li>                  
                      
                    </ul>
                  <ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li></ul></div>
              </div>

            </div>

            <!-- Simple description starts -->
            <div class="col-md-6 col-sm-6">
                <h4 class="title">__Apple_iPhone_5G__</h4>
                <h5>Price : £__999.00__</h5>
                <p>Condition : __8/10__</p>
                <p>On Bid : __No__</p>
                <p>Publish Date : __23/04/2014__</p>
                <p>Availability : __InStock__</p>
                <p>View Number : __8__</p> 
								
                <br>

								<div class="row">
									<div class="col-md-6">
										<div class="input-group">
										  <span>
                      <!-- buy button -->
                        <button>
                          <a href="#cart" role="button" data-toggle="modal"><i class="icon-shopping-cart"></i></a><span class="bold"> Buy Now!</span>
                        </button>
                      </span>							  
										</div>
									</div>
								</div>
            </div>
            <!-- Simple description ends -->

          </div>
        </div>
        <!-- Product details ends -->

<br>
        
        <!-- Description, specs and review -->

        <ul class="nav nav-tabs">
          <!-- Use uniqe name for "href" in below anchor tags -->
          <li class="active"><a href="#tab1" data-toggle="tab">Description</a></li>
          <li class=""><a href="#tab2" data-toggle="tab">Seller Info</a></li>
          <li class=""><a href="#tab3" data-toggle="tab">Q&A</a></li>

        </ul>

        <!-- Tab Content Starts -->
        <div class="tab-content">
          <!-- Description starts-->
          <div class="tab-pane active" id="tab1">
            <h5>Apple iPhone 5G</h5>
            <p>Nulla facilisi. Sed justo dui, scelerisque ut consectetur vel, eleifend id erat. Morbi auctor adipiscing tempor. Phasellus condimentum rutrum aliquet. Quisque eu consectetur erat. Proin rutrum, erat eget posuere semper, <em>arcu mauris posuere tortor</em>, in commodo enim magna id massa. Suspendisse potenti. Aliquam erat volutpat. Maecenas quis tristique turpis. Nulla facilisi. Duis sed velit at <a href="#">magna sollicitudin cursus</a> ac ultrices magna. Aliquam consequat, purus vitae auctor ullamcorper, sem velit convallis quam, a pharetra justo nunc et mauris. Vivamus diam diam, fermentum sed dapibus eget, egestas sed eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <h6>Features</h6>
            <ul>
            <li>Etiam adipiscing posuere justo, nec iaculis justo dictum non</li>
            <li>Cras tincidunt mi non arcu hendrerit eleifend</li>
            <li>Aenean ullamcorper justo tincidunt justo aliquet et lobortis diam faucibus</li>
            <li>Maecenas hendrerit neque id ante dictum mattis</li>
            <li>Vivamus non neque lacus, et cursus tortor</li>
            </ul>
          </div>
          <!-- Description ends-->


          <!-- Seller Info Start -->
          <div class="tab-pane" id="tab2">
            <h5>Seller Info</h5>
            <div class="item-review">
              <h5>Name: Sherlock Holmes</h5>
              <br>
              <h5>Average Rating: <span class="color">__4__/5</span></h5>
              <p>Item as described: __4__/5</p>
              <p>Communication: __3__/5</p>
              <p>Shipping Speed: __4__/5</p>
              <br>
              <h5>Email</h5>
              <p><a href="mailto:someone@example.com?Subject=Query%20on%20__product_name__">someone@example.com</a></p>
              <br>
              <h5>Register Date</h5>
              <p class="rmeta">__27/1/2014__</p>
            </div>
          </div>
          <!-- Seller Info End -->

          <!-- Q&A Start -->
          <div class="tab-pane" id="tab3">
            <div class="comments well">
               <!-- Comment title -->
                  <div class="title"><h4>Q&A</h4></div>
                  
                  <ul class="comment-list">
                    <li class="comment">
                      <a class="pull-left" href="#">
                        <!-- Avatar -->
                        <img class="avatar" src="http://placekitten.com/64/64" alt="">
                      </a>
                      <!-- Author -->
                        <div class="comment-author"><a href="#">Ashok</a></div>
                        <!-- Comment date -->
                        <div class="cmeta">Commented on 25/12/2012</div>
                        <!-- Para -->
                        <p>Nulla facilisi. Sed justo dui, scelerisque ut consectetur vel, eleifend id erat. Phasellus condimentum rutrum aliquet. Quisque eu consectetur erat.</p>
                        <div class="clearfix"></div>
                    </li>
                    <!-- Reply to previous comment (by adding class "reply") -->
                    <li class="comment reply">
                      <a class="pull-left" href="#">
                        <img class="avatar" src="http://placekitten.com/64/64" alt="">
                      </a>
                        <div class="comment-author"><a href="#">Ashok</a></div>
                        <div class="cmeta">Commented on 25/12/2012</div>
                        <p>Nulla facilisi. Sed justo dui, scelerisque ut consectetur vel, eleifend id erat. Phasellus condimentum rutrum aliquet. Quisque eu consectetur erat.</p>
                        <div class="clearfix"></div>
                    </li>
                  </ul>
            </div>

            <hr>

            <div class="respond well">
                <!-- Form title -->
                 <div class="title"><h4>Ask a Question</h4></div>
                 <!-- Comment form starts -->
                 <div class="form">
                   <form class="form-horizontal">
                       <div class="form-group">
                         <label class="control-label col-md-3" for="topic1">Topic</label>
                         <div class="col-md-6">
                           <input type="text" class="form-control" id="topic1">
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="control-label col-md-3" for="question">Content</label>
                         <div class="col-md-6">
                           <textarea class="form-control" id="question" rows="3"></textarea>
                         </div>
                       </div>
                       <div class="form-group">
                          <div class="col-md-6 col-md-offset-3">
                              <button type="submit" class="btn btn-default">Submit</button>
                              <button type="reset" class="btn btn-default">Reset</button>
                          </div>
                       </div>
                     </form>
                   </div>
                   <!-- Commment form ends -->
                </div>

          </div>
          <!-- Q&A End -->

        </div>
        <!-- Tab Content Ends -->