<div class="tabs clearfix mb-0" id="tab-1">
        
    <ul class="tab-nav clearfix">
        <li><a href="#tabs-1"><i class="icon-align-justify2"></i><span class="d-none d-md-inline-block"> Description</span></a></li>
        <li><a href="#tabs-2"><i class="icon-info-sign"></i><span class="d-none d-md-inline-block"> Additional Information</span></a></li>
        <li><a href="#tabs-3"><i class="icon-star3"></i><span class="d-none d-md-inline-block"> Reviews (2)</span></a></li>
    </ul>

    <div class="tab-container">

        <div class="tab-content clearfix" id="tabs-1">
           {!! $product->details->data  !!}
        </div>
        <div class="tab-content clearfix" id="tabs-2">

            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <td>Size</td>
                        <td>Small, Medium &amp; Large</td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td>Pink &amp; White</td>
                    </tr>
                    <tr>
                        <td>Waist</td>
                        <td>26 cm</td>
                    </tr>
                    <tr>
                        <td>Length</td>
                        <td>40 cm</td>
                    </tr>
                    <tr>
                        <td>Chest</td>
                        <td>33 inches</td>
                    </tr>
                    <tr>
                        <td>Fabric</td>
                        <td>Cotton, Silk &amp; Synthetic</td>
                    </tr>
                    <tr>
                        <td>Warranty</td>
                        <td>3 Months</td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="tab-content clearfix" id="tabs-3">

            <div id="reviews" class="clearfix">

                <ol class="commentlist clearfix">

                    <li class="comment even thread-even depth-1" id="li-comment-1">
                        <div id="comment-1" class="comment-wrap clearfix">

                            <div class="comment-meta">
                                <div class="comment-author vcard">
                                    <span class="comment-avatar clearfix">
                                    <img alt='Image' src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60' height='60' width='60' /></span>
                                </div>
                            </div>

                            <div class="comment-content clearfix">
                                <div class="comment-author">John Doe<span><a href="#" title="Permalink to this comment">April 24, 2021 at 10:46AM</a></span></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo perferendis aliquid tenetur. Aliquid, tempora, sit aliquam officiis nihil autem eum at repellendus facilis quaerat consequatur commodi laborum saepe non nemo nam maxime quis error tempore possimus est quasi reprehenderit fuga!</p>
                                <div class="review-comment-ratings">
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star-half-full"></i>
                                </div>
                            </div>

                            <div class="clear"></div>

                        </div>
                    </li>

                    <li class="comment even thread-even depth-1" id="li-comment-2">
                        <div id="comment-2" class="comment-wrap clearfix">

                            <div class="comment-meta">
                                <div class="comment-author vcard">
                                    <span class="comment-avatar clearfix">
                                    <img alt='Image' src='https://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=60' height='60' width='60' /></span>
                                </div>
                            </div>

                            <div class="comment-content clearfix">
                                <div class="comment-author">Mary Jane<span><a href="#" title="Permalink to this comment">June 16, 2021 at 6:00PM</a></span></div>
                                <p>Quasi, blanditiis, neque ipsum numquam odit asperiores hic dolor necessitatibus libero sequi amet voluptatibus ipsam velit qui harum temporibus cum nemo iste aperiam explicabo fuga odio ratione sint fugiat consequuntur vitae adipisci delectus eum incidunt possimus tenetur excepturi at accusantium quod doloremque reprehenderit aut expedita labore error atque?</p>
                                <div class="review-comment-ratings">
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star-empty"></i>
                                    <i class="icon-star-empty"></i>
                                </div>
                            </div>

                            <div class="clear"></div>

                        </div>
                    </li>

                </ol>

                <!-- Modal Reviews
                ============================================= -->
                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#cartModel" class="button button-3d m-0 float-end">Add a Review</a> --}}

               
                <!-- Modal Reviews End -->

            </div>

        </div>

    </div>

</div>