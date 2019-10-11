@extends('template.frontend')

@section('contacts')
active
@stop

@push('content')
<div id="page-content">
    <!--  Page header  -->
    <div class="container">
        <div class="row no-margin">
            <div class="col-md-12 padding-leftright-null">
                <div id="page-header">
                    <div class="text">
                        <h1 class="margin-bottom-small"><small>{{ $page_datas->page->name }}</small></h1>
                        <p class="heading left max full grey-dark">
                            <!-- Thunderlab is an IT Business Solution company that helps everyone (from small sized business to big sized company) to achieve their dreams in technology. -->
                            How may we help you ?
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END Page header  -->
    <div id="home-wrap" class="content-section">
        <div class="row margin-leftright-null">
            <!--  Map. Settings in maps.js  -->
            <div class="col-md-12 padding-leftright-null map">
                <div id="map">
                    <iframe
                    width="100%"
                    height="500"
                    frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB71mstvJXEk7mZEMxJ69EdlH2-q-a5lds
                    &q=pt+thunder+lab+indonesia" allowfullscreen>
                </iframe>
            </div>
        </div>
        <!--  END Map  -->
    </div>
    <!-- Contact -->
    <div class="container padding-md-bottom-lg">
        <div class="row no-margin padding-onlytop-lg">
            <div class="col-md-10 padding-leftright-null">
                <div class="text padding-topbottom-null">
                    <h2 class="heading margin-bottom-null">
                        How may we help you?
                    <span class="color">.</span></h2>
                </div>
            </div>
            <div class="col-md-12 wrap-text">
                <div class="col-sm-6 padding-leftright-null">
                    <div class="text small">
                        @php
                        /*
                        <p class="small margin-bottom">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                        */
                        @endphp

                        <p class="small"></p>

                        @php
                            // address formatting
                            $tmp = explode("\n", nl2br(e( $page_datas->page->address)), 2);
                            $addr_firstline = $tmp[0];
                            $addr_lastline = sizeOf($tmp) > 1 ? $tmp[1] : ""
                        @endphp

                        <p>{!! $addr_firstline !!}
                            <span class="small">
                                {!! $addr_lastline !!}
                            </span>
                        </p>

                        <p class="small">{!! nl2br(e( $page_datas->page->operational)) !!}</p>

                        <p class="small grey-dark" style="margin-bottom:0px;">Tel. <a href="#" class="simple">{{ $page_datas->page->phone }}</a></p>
                        <p class="small">Email <a href="#" class="simple">{{ $page_datas->page->email }}</a></p>
                    </div>
                </div>
                <div class="col-sm-6 padding-leftright-null">
                    <!-- Contact Form -->
                    <form id="contact-form" class="padding-md padding-md-topbottom-null" action="{{ route('frontend.contacts.post') }}">
                        @csrf
                        <div class="row no-margin">
                            <div class="col-md-12 padding-leftright-null">
                                <div class="form-group text small padding-topbottom-null">
                                    <input class="form-field thunder-validation-input" name="name" id="name" type="text" placeholder="Name" thunder-validation-rules="required minLength=2 maxLength=100">
                                </div>
                            </div>
                            <div class="col-md-6 padding-leftright-null">
                                <div class="form-group text small padding-topbottom-null">
                                    <input class="form-field thunder-validation-input" name="phone" id="phone" type="tel" placeholder="Phone" thunder-validation-rules="required minLength=6 maxLength=15">
                                </div>
                            </div>
                            <div class="col-md-6 padding-leftright-null">
                                <div class="form-group text small padding-topbottom-null">
                                    <input class="form-field thunder-validation-input" name="email" id="email" type="email" placeholder="Email" thunder-validation-rules="required email">
                                </div>
                            </div>
                            <div class="col-md-12 padding-leftright-null">
                                <div class="form-group margin-bottom-null text small padding-topbottom-null">
                                    <input class="form-field thunder-validation-input" name="nature" id="nature" type="text" placeholder="Nature of enquiry" thunder-validation-rules="required">
                                </div>
                            </div>
                            <div class="col-md-12 padding-leftright-null">
                                <div class="form-group text small padding-topbottom-null">
                                    <div id="html_element" style="margin-bottom:.55rem;"></div>
                                    <input name="captcha" class="thunder-validation-input" type="hidden" thunder-validation-rules="required">
                                </div>
                            </div>
                            <div class="col-md-12 padding-leftright-null">
                                <div class="text small padding-topbottom-null">
                                    <div class="submit-area">
                                        <button type="submit" id="submit-contact" class="btn-alt active shadow" >Contact Me</button>
                                        <div id="msg" class="message"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END Contact Form -->
                </div>
            </div>
            <!-- END Contact -->
        </div>
    </div>
</div>
@endpush

@push("modals")
<div class="modal fade" id="modelSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="home-header">
                    <div class="text text-center" style="padding-bottom: 1.2rem;">
                        <h1 class="noselect"><small>Thank You</small></h1>
                        <p class="heading left max full grey-dark noselect" style="padding-bottom:1.3rem;">Our team member will contact you shortly</p>
                        <h4><a href="#" class="simple noselect" data-dismiss="modal">OK</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modelFail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="home-header">
                        <div class="text text-center" style="padding-bottom: 1.2rem;">
                            <h1 class="noselect"><small>Sorry</small></h1>
                            <p id="error-msg" class="heading left max full grey-dark noselect" style="padding-bottom:1.3rem;"></p>
                            <h4><a href="#" class="text-danger noselect" data-dismiss="modal">OK</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush


@push('scripts')

@endpush

@section('template_script')
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@stop
