@extends('client.layouts.master')
@section('title', 'Liên Hệ')

@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-6.jpg',
        'subtitle' => 'Liên hệ với chúng tôi',
        'title' => 'Liên Hệ',
        'currentPage' => 'Liên Hệ',
    ])
    <div id="content" class="no-bottom no-top">
        <section>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 sm-text-center">
                        <h3>Địa Chỉ Của Chúng Tôi</h3>
                        Collins Street West, Victoria 8007, Úc<br>
                        Điện thoại: (208) 333 9296<br>
                        Email: contact@baresto.com<br>
                    </div>

                    <div class="col-lg-8">
                        <form name="contactForm" id="contact_form" class="position-relative z1000" method="post"
                            action="#">
                            <div class="row gx-4">
                                <div class="col-lg-6 col-md-6 mb10">
                                    <div class="field-set">
                                        <input type="text" name="Name" id="name"
                                            class="form-control custom-input" placeholder="Tên của bạn" required>
                                    </div>

                                    <div class="field-set">
                                        <input type="text" name="Email" id="email"
                                            class="form-control custom-input" placeholder="Email của bạn" required>
                                    </div>

                                    <div class="field-set">
                                        <input type="text" name="phone" id="phone"
                                            class="form-control custom-input" placeholder="Số điện thoại của bạn" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="field-set mb20">
                                        <textarea name="message" id="message" class="form-control custom-input" placeholder="Tin nhắn của bạn" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div id='submit' class="mt20">
                                <input type='submit' id='send_message' value='Gửi Tin Nhắn' class="btn-custom">
                            </div>

                            <div id="success_message" class='success'>
                                Tin nhắn của bạn đã được gửi thành công. Tải lại trang nếu bạn muốn gửi thêm tin nhắn.
                            </div>
                            <div id="error_message" class='error'>
                                Xin lỗi, đã xảy ra lỗi khi gửi biểu mẫu của bạn.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

