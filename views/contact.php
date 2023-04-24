<?php include_once "../templates/header.html" ?>
<!-- .site-content -->
    <div class="site-content">
        <div class="atbs-block atbs-block--fullwidth module-contact">
            <div class="container">
                <div class="atbs-block__inner flex-box flex-box-2i flex-space-50 align-item-center">
                    <div class="section-main">
                        <div class="contact-heading">
                            <h1>
                                Contact Us
                            </h1>
                            <p class="contact-description">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s
                            </p>
                        </div>
                        <iframe allowfullscreen="" loading="lazy" src="javascript:;" style="border:0;"></iframe>
                    </div>
                    <div class="section-sub">
                        <div class="contact-form">
                            <form action="#">
                                <label for="fname">Name:</label>
                                <input id="fname" name="name" type="text"><br><br><br>
                                <label for="email">Email:</label>
                                <input id="email" name="email" type="email"><br><br><br>

                                <label for="contactform-message">Message</label>
                                <textarea aria-required="true" class="required form-control"
                                          cols="30" id="contactform-message" name="contactform-message" rows="6"></textarea>
                                <button class="btn contactform-submit" id="contactform-submit" name="contactform-submit"
                                        type="submit" value="submit">Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .site-content -->
<?php include_once "../templates/footer.html" ?>
