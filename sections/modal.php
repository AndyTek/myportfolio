    <div class="modal fade modal-fullwidth" id="myModal">
        <div class="modal-dialog modal-dialog-mod">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="modalmbodycontent">
                        <div id="title-work-modal-content" class="container-fluid">
                            
                        </div>

                        <div id="desc-work-modal-content" class="container-fluid">
                            
                        </div>
     
                        <div id="cont-pic-modal-content" class="container-fluid">
                            
                        </div>

                    </div>
                </div>
                <!-- 
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  
                </div> 
                -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->


    <div class="modal fade modal-fullwidth-2" id="mailModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    
                        <form id="contact-form" href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype='multipart/form-data'>
                        <div class="form-group">
                            <label for="inputEmail" class="control-label">Email *</label>
                            <input type="email" name="mail-contact-form" class="form-control" id="inputEmail" placeholder="Email" required="required">
                        </div>
                        <div class="form-group">
                            <label for="name--contact-form">Your Name *</label>
                            <input type="text" name="name-contact-form" class="form-control" id="name-contact-form" placeholder="Your Name" required="required">
                        </div>
                        <div class="form-group">
                            <label for="tel-contact-form">Telephone</label>
                            <input type="text" name="tel-contact-form" class="form-control" id="tel-contact-form" placeholder="Your Telephone">
                        </div>
                        <div class="form-group message-marginbot">
                            <label for="desc-contact-form">Message *</label>
                        <textarea name="desc-contact-form" class="form-control" id="desc-contact-form" rows="3" required="required"></textarea>
                        </div>
                        <div id="cont-submit" class="text-right">
                            <div id="response"></div>
                            <button type="submit" id="submit-form" class="btn btn-default btn-hire btn-bg">Submit</button>
                        </div>
                    </form>
                </div>
                <div id="headbar" class="text-right">
                    <a id="closeMailModal" href="#">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->

    </div><!-- modal -->


