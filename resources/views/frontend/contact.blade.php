@extends('frontend.master')
@section('content')
 <!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li>Contact Us</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->
<!-- contact_section - start
================================================== -->
<div class="map_section">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233667.8223908687!2d90.27923710646988!3d23.78088745708454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1648448018747!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!-- contact_section - end
================================================== -->

<!-- contact_section - start
================================================== -->
<section class="contact_section section_space">
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <div class="contact_info_wrap">
                    <h3 class="contact_title">Address <span>Information</span></h3>
                    <div class="decoration_image">
                        <img src="{{ asset('frontend_assets/images/leaf.png') }}" alt="image_not_found">
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <div class="row">
                        <div class="col col-md-6">
                            <div class="contact_info_list">
                                <h4 class="list_title">Colourbar U.S.A</h4>
                                <ul class="ul_li_block">
                                    <li>Dhaka In Twin Tower Concord </li>
                                    <li>Shopping Complex</li>
                                    <li>Open  Closes 8:30PM </li>
                                    <li>yourinfo@gmail.com</li>
                                    <li>(1200)-0989-568-331</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col col-md-6">
                            <div class="contact_info_list">
                                <h4 class="list_title">USA Exchanger</h4>
                                <ul class="ul_li_block">
                                    <li>Dhaka In Twin Tower Concord </li>
                                    <li>Shopping Complex</li>
                                    <li>Open  Closes 8:30PM </li>
                                    <li>yourinfo@gmail.com</li>
                                    <li>(1200)-0989-568-331</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-lg-6">
                <div class="contact_info_wrap">
                    <h3 class="contact_title">Get In Touch <span>Inform Us</span></h3>
                    <div class="decoration_image">
                        <img src="{{ asset('frontend_assets/images/leaf.png') }}" alt="image_not_found">
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <form action="{{ url('/contact/message/insert') }}" method="POST">
                        @csrf
                        
                        <div class="form_item">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            <span style="color: red; font-style:italic; font-weight:500;">@error('name'){{ $message }}@enderror</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form_item">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                                    <span style="color: red; font-style:italic; font-weight:500;">@error('email'){{ $message }}@enderror</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form_item">
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                                    <span style="color: red; font-style:italic; font-weight:500;">@error('subject'){{ $message }}@enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="form_item">
                            <textarea name="message" id="message"  placeholder="Write Your Message..."></textarea>
                            <span style="color: red; font-style:italic; font-weight:500;">@error('message'){{ $message }}@enderror</span>
                        </div>
                        <button type="submit" class="btn btn-dark">Submit</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact_section - end
================================================== -->

@endsection
@section('footer_script')
    @if (session('status'))
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: '{{session('status')}}'
        })
    </script>
    @endif
@endsection