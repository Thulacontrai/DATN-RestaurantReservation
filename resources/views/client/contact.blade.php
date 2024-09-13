@extends('client.layouts.master')
@section('title', 'Contact')

@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-6.jpg',
        'subtitle' => 'Get in',
        'title' => 'Touch',
        'currentPage' => 'Contact',
    ])
    <div id="content" class="no-bottom no-top">


        <section>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 sm-text-center">
                        <h3>Our Location</h3>
                        Collins Street West, Victoria 8007 Australia<br>
                        T. (208) 333 9296<br>
                        E. contact@baresto.com<br>
                    </div>

                    <div class="col-lg-8">
                        <form name="contactForm" id="contact_form" class="position-relative z1000" method="post"
                            action="#">
                            <div class="row gx-4">
                                <div class="col-lg-6 col-md-6 mb10">
                                    <div class="field-set">
                                        <input type="text" name="Name" id="name" class="form-control"
                                            placeholder="Your Name" required>
                                    </div>

                                    <div class="field-set">
                                        <input type="text" name="Email" id="email" class="form-control"
                                            placeholder="Your Email" required>
                                    </div>

                                    <div class="field-set">
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            placeholder="Your Phone" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="field-set mb20">
                                        <textarea name="message" id="message" class="form-control" placeholder="Your Message" required></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="g-recaptcha" data-sitekey="6LdW03QgAAAAAJko8aINFd1eJUdHlpvT4vNKakj6"></div>
                            <div id='submit' class="mt20">
                                <input type='submit' id='send_message' value='Send Message' class="btn-custom">
                            </div>

                            <div id="success_message" class='success'>
                                Your message has been sent successfully. Refresh this page if you want to send more
                                messages.
                            </div>
                            <div id="error_message" class='error'>
                                Sorry there was an error sending your form.
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection