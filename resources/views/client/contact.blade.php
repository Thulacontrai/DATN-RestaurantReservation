@extends('client.layouts.master')
@section('title', 'Liên Hệ')

@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-6.jpg',
        // 'subtitle' => 'Get in',
        'title' => 'Liên hệ',
        'currentPage' => 'Liên hệ',
    ])
   <div id="content" class="no-bottom no-top">
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <!-- Phần Địa chỉ -->
                <div class="col-md-5">
                    <div class="">
                        <h3>Địa chỉ</h3>
                        <p>
                            Tòa nhà Hanoi Landmark, Lô E6, Khu đô thị mới Cầu Giấy, Mễ Trì, Quận Nam Từ Liêm, Hà Nội<br>
                            0363486472<br>
                            WD76@gmail.com<br>
                        </p>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.390300284349!2d105.78187237473718!3d21.01706358062924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454ab43c0c4db%3A0xdb6effebd6991106!2sKeangnam%20Landmark%2072!5e0!3m2!1svi!2s!4v1733299943632!5m2!1svi!2s" 
                                width="100%" height="317" 
                                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <div class="col-md-1"></div>

                <!-- Phần Form liên hệ -->
                <div class="col-md-5">
                    <div class="">
                        <form name="contactForm" id="contact_form" method="post" action="#">
                            <div class="mb-3">
                               <h3>Thông tin liên hệ</h3>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="Name" id="name" class="form-control" placeholder="Tên của bạn" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="Email" id="email" class="form-control" placeholder="Email của bạn" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Số điện thoại" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="message" id="message" class="form-control" placeholder="Nội dung" required></textarea>
                            </div>
                            <div>
                                <button type="submit" id="send_message" class="btn btn-primary">Gửi</button>
                            </div>
                        </form>
                        <div id="success_message" class="text-success mt-3" style="display: none;">
                            Tin nhắn của bạn đã được gửi thành công. Tải lại trang nếu bạn muốn gửi thêm tin nhắn.
                        </div>
                        <div id="error_message" class="text-danger mt-3" style="display: none;">
                            Xin lỗi, đã xảy ra lỗi khi gửi biểu mẫu của bạn.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection

