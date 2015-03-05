<?php
SharIt::page()->registerCss(".aboutus-person{width:120px;}");
?>
<div class="row">
    <!-- Tabs -->
    <ul class="nav nav-tabs">
        <!-- Navigation tabs (Job titles ). Use unique value in anchor tags. -->
        <li class="active"><a href="#tab1" data-toggle="tab">Team Member</a></li>
        <li><a href="#tab2" data-toggle="tab">About Us</a></li>
        <li><a href="#tab3" data-toggle="tab">Brief Guide</a></li>
        <li><a href="#tab4" data-toggle="tab">Download User Manual</a></li>
   </ul>

   <div class="tab-content">
    <h2>Just Do IT</h2>
   <br />
        <div class="tab-pane active" id="tab1">
            <!-- Content -->

            <h4 class="title">Team Member</h4>
            <div class="rows">
                <div class="col-md-6">
                    <ul class="media-list">
                      <li class="media">
                        <a class="pull-left">
                          <img class="media-object aboutus-person img-responsive img-rounded" src="<?php echo SHARIT_URL_APP.'image/aboutus/jll.jpg' ?>" alt="...">
                        </a>
                        <div class="media-body">
                          <h4 class="media-heading">Lulu Jiang</h4>
                          PHP Engineer
                        </div>
                      </li>
                      <li class="media">
                        <a class="pull-left">
                          <img class="media-object aboutus-person img-responsive img-rounded" src="<?php echo SHARIT_URL_APP.'image/aboutus/hmx.jpg' ?>" alt="...">
                        </a>
                        <div class="media-body">
                          <h4 class="media-heading">Mengxue Huang</h4>
                          Database Engineer
                        </div>
                      </li>
                      <li class="media">
                        <a class="pull-left">
                          <img class="media-object aboutus-person img-responsive img-rounded" src="<?php echo SHARIT_URL_APP.'image/aboutus/xxr.jpg' ?>" alt="...">
                        </a>
                        <div class="media-body">
                          <h4 class="media-heading">Xinrui Xu</h4>
                          PHP Engineer
                        </div>
                      </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="media-list">
                        <li class="media">
                        <a class="pull-left">
                          <img class="media-object aboutus-person img-responsive img-rounded" src="<?php echo SHARIT_URL_APP.'image/aboutus/jy.jpg' ?>" alt="...">
                        </a>
                        <div class="media-body">
                          <h4 class="media-heading">Yang Jiao</h4>
                          HTML/CSS Engineer
                        </div>
                      </li>
                      <li class="media">
                        <a class="pull-left">
                          <img class="media-object aboutus-person img-responsive img-rounded" src="<?php echo SHARIT_URL_APP.'image/aboutus/wy.jpg' ?>" alt="...">
                        </a>
                        <div class="media-body">
                          <h4 class="media-heading">Yue Wang</h4>
                          HTML/CSS Engineer
                        </div>
                      </li>
                    </ul>
                </div>
            </div>
            <hr>
            <!--<p> Nam risus magna, fringilla sit amet blandit viverra, dignissim eget est. Ut <strong>commodo ullamcorper risus nec</strong> mattis. Fusce imperdiet ornare dignissim. Donec aliquet convallis tortor, et placerat quam posuere posuere. Morbi tincidunt posuere turpis eu laoreet. Nulla facilisi. Aenean at massa leo. Vestibulum in varius arcu.</p>-->
        </div>

        <!-- In "id", use the value which you used in above anchor tags -->
        <div class="tab-pane" id="tab2">
            <!-- Content -->
            <h4 class="title">About Us </h4>
            <p>SharIT is an university-based, second hand, online trading platform. It aims to provide a better experience for students and staff to trade items. It also contains featured funcitons like request a item, bid a item, and many other fascinating functions waiting for you to discover.</p> 
            <ul>
                <li>If you think it is wasteful to throw away your old books materials and electronic equipment you can sell them on our websites.</li>
                <li>Seller can ask buyers to bid for the item to get more earnings.</li>
                <li>Buyer can request items if they cannot find it in existing product library.</li>
                <li>Buyer can bid for some items and the highest bidder will get the item.
                <li>The page of the product also has an area for Q&A and people can ask questions about the product.</li>
                
            </ul>
            <img class="img-responsive img-rounded" src="<?php echo SHARIT_URL_APP.'image/aboutus/all.jpg' ?>" alt="...">
            <!--<p> Nam risus magna, fringilla sit amet blandit viverra, dignissim eget est. Ut <strong>commodo ullamcorper risus nec</strong> mattis. Fusce imperdiet ornare dignissim. Donec aliquet convallis tortor, et placerat quam posuere posuere. Morbi tincidunt posuere turpis eu laoreet. Nulla facilisi. Aenean at massa leo. Vestibulum in varius arcu.</p>-->
        </div>
        
        <div class="tab-pane" id="tab3">
            <!-- Content -->
            <h4 class="title">Brief Guide </h4>
            <h4>Item Quality Gradings</h4>
            <p>The most common system in use to describe items this way uses the following terms to indicate to buyers what sort of condition the item is in. Appending a plus (+) or a minus (-) to the end of the abbreviation indicates that the item is ever so slightly more (+) or less (-) nice than the abbreviation indicates.</p> 
            <ul>
                <li><b>New or NIB</b></li>
                <p>The item is factory new (i.e. “New In Box”). This is generally taken to mean not only unused, but store-ready, still in all original and factory sealed packaging.</p>
                <li><b>Unu or Unused</b></li>
                <p>The item is brand new, never used, but its box has been opened and/or is not still factory sealed.</p>
                <li><b>MIB</b></li>
                <p>Short for “Mint In Box,” this abbreviation indicates to buyers that the item is completely indistinguishable from a factory new item and that all packaging is included. The item may, however, have been used (though not enough to make such use apparent in any way).</p>
                <li><b>Mint</b></li>
                <p>The item is completely indistinguishable from a factory new item despite its potentially having had some light use. No packaging, however, is included. Nothing on it but fingerprint grease? Then it's not mint. Look to LN (below) instead.</p>
                <li><b>LN</b></li>
                <p>Short for “Like New,” this abbreviation indicates that the item, while not quite in absolute mint condition, is close enough to factory perfection to escape all but the most discerning eye, though original factory packaging may or may not be included (remember to be explicit on this point in your listing). Common variations include “LNIB” (“Like New In Box”) and “As New.” Remember that a single scratch or scuff disqualifies an item from being considered "Like New."</p>
                <li><b>EX</b></li>
                <p>Short for “Excellent,” this abbreviation indicates that while the item has clearly been used, its condition is such that it promises to offer all of the pleasure or utility to its owner that a new item might have; it’s useful life should not have been shortened, nor should there be any visible or functional defects beyond very slight normal wear. This is "just one scratch" or "only a couple of months use" territory.</p>
                <li><b>Good</b></li>
                <p>The item is clearly used and its useful lifespan will not be as long as that of a factory new item. However, there are no major defects, either visible or functional and the item remains in full working condition.</p>
                <li><b>Fair</b></li>
                <p>The item suffers from some amount of wear and appears clearly to be a well-used item. Nonetheless, it continues to function generally as was originally intended and should be expected to do so for some minimal amount of time.</p>
                <li><b>Bargain Grade or BGN</b></li>
                <p>The item remains functional and free from defects that would hamper its utility, but it is obviously used and may have a significantly shortened lifespan. It can be regarded as being near or at the end of its useful life and/or it is significantly visually damaged to such an extent that a significant discount and an explicitly low grade are indicated.</p>
                <li><b>Poor or AS/IS</b></li>
                <p>The item should not be purchased by anyone intending to use it for its originally conceived purpose, as it is unlikely to be able to fill the function reliably and/or it is so ugly or aesthetically compromised as to render it undesirable to most buyers.

</p>
                
            </ul>
            <!--<p> Nam risus magna, fringilla sit amet blandit viverra, dignissim eget est. Ut <strong>commodo ullamcorper risus nec</strong> mattis. Fusce imperdiet ornare dignissim. Donec aliquet convallis tortor, et placerat quam posuere posuere. Morbi tincidunt posuere turpis eu laoreet. Nulla facilisi. Aenean at massa leo. Vestibulum in varius arcu.</p>-->
        </div>                        
     
        <div class="tab-pane" id="tab4">
            <!-- Content -->
            <h4 class="title">Download </h4>
            <br/>
            <ul>
                <li><h5><a href=""> User_Manual_for_Technical_Staff.pdf</a></h5></li>
                <br/>
                <li><h5><a href=""> User_Manual_for_Normal_User.pdf</a></h5></li>
                <br/>
                <li><h5><a href=""> User_Manual_for_Supervisor.pdf</a></h5></li>
                <br/>
                
            </ul>
            <!--<p> Nam risus magna, fringilla sit amet blandit viverra, dignissim eget est. Ut <strong>commodo ullamcorper risus nec</strong> mattis. Fusce imperdiet ornare dignissim. Donec aliquet convallis tortor, et placerat quam posuere posuere. Morbi tincidunt posuere turpis eu laoreet. Nulla facilisi. Aenean at massa leo. Vestibulum in varius arcu.</p>-->
        </div>                      

   </div>
<br />
</div>