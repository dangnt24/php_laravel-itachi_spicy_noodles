@extends('layouts.homeLayout')
@section("homeContent")
    <div class="row mt-5">
            <div class="col-12">
                <span style="padding: 12px; background-color: #d0011be6; width: 100%; font-size: 16px; color: #fff;">THÔNG TIN LIÊN HỆ</span>
            </div>
        </div>
        <div class="row"><div class="col-12"><hr style="margin-top: 6px; color: #d0011be6; border-width: 2px;"></div></div>
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="wrapper">
                            <div class="row no-gutters mb-5">
                                <div class="col-md-6">
                                    <div class="contact-wrap w-100 p-md-5 p-4">
                                        <h3 class="mb-4">Liên hệ với chúng tôi</h3>
                                        <div id="form-message-warning" class="mb-4"></div>
                                        <div id="form-message-success" class="mb-4">
                                            Tin nhắn của bạn đã được gửi, cảm ơn bạn đã đóng góp!
                                        </div>
                                        <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <div class="form-group">
                                                        <label class="label" for="name">Họ tên</label>
                                                        <input type="text" class="form-control" name="name" id="name"
                                                            placeholder="Họ tên">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div class="form-group">
                                                        <label class="label" for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email"
                                                            placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label class="label" for="phone">Số điện thoại</label>
                                                        <input type="number" class="form-control" name="phone" id="phone"
                                                            placeholder="Số điện thoại">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label class="label" for="#">Tin nhắn</label>
                                                        <textarea name="message" class="form-control" id="message" cols="30"
                                                            rows="4" placeholder="Message"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <input type="submit" value="Gửi" class="btn btn-primary">
                                                        <div class="submitting"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-stretch">
                                    <div id="map" class="w-100 mt-md-5">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.9048208849204!2d105.77235427409536!3d10.024712772610917!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08820e288dc5b%3A0x301560920bedaf72!2sVincom%20Plaza%20Xu%C3%A2n%20Kh%C3%A1nh!5e0!3m2!1svi!2s!4v1696770795632!5m2!1svi!2s" height="450" style="width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <i class="fa fa-map-marker" style="font-size: 22px; margin-bottom: 3px;"></i>
                                        </div>
                                        <div class="text">
                                            <p><span>Address:</span> Vincom Plaza Xuân Khánh, 209 Đ. 30 Tháng 4, Xuân Khánh, Ninh Kiều, Cần Thơ</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <i class="fa fa-phone" style="font-size: 22px; margin-bottom: 3px;"></i>
                                        </div>
                                        <div class="text">
                                            <p><span>Phone:</span> <a href="tel://1234567890">+ 1234 5678 90</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <i class="fa fa-paper-plane" style="font-size: 22px; margin-bottom: 3px;"></i>
                                        </div>
                                        <div class="text">
                                            <p><span>Email:</span> <a href="mailto:dangvippro2004@gmail.com">dangvippro2004@gmail.com</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dbox w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <i class="fa fa-globe" style="font-size: 22px; margin-bottom: 3px;"></i>
                                        </div>
                                        <div class="text">
                                            <p><span>Website</span> <a href="#">DangVipPro.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
