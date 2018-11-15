@extends('template.frontend')

@section('home')
    active-item
@stop

@push('content')
<div id="page-content">
    <!--  HomePage header  -->
    <div class="container">
        <div class="row no-margin">
            <div class="col-md-12 padding-leftright-null">
                <div id="home-header">
                    <div class="text">
                        <h1 class="margin-bottom-small noselect"><span style="color:#fff !Important; background-color:#527a99 !Important">&nbsp;DO MORE </span><br>&nbsp;THINGS SIMPLER<span class="color">.</span></h1>
                        <p class="heading left max full grey-dark noselect" style="padding-left:1rem;">Karna hidup cuma sekali, kenapa dibuat ribet <i>#YOLO</i> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush


@push('scripts')
    // inits
    heroBannerResponsive();

    // events
    $( window ).resize(function() {
        heroBannerResponsive();
    });

    // modules
    function heroBannerResponsive(){
        var doc_height = $(window).height();
        var object_text = $("#home-header").find(".text");
        var object_text_padding = ((parseInt(doc_height) - parseInt(object_text.height())) /2); 

        object_text
            .css("padding-top", (object_text_padding + 'px'))
            .css("padding-bottom", (object_text_padding  + 'px'))
            ;
    }
@endpush