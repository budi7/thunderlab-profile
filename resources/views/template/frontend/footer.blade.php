
        <!--  Footer  -->
        <footer>
            <div class="container">
                <div class="row no-margin">
                    <div class="col-md-3 text">
                        <h5>{{ $page_datas->page->name }}</h5>
                        <p>© 2018 Thunderlab.id</p>
                        <p>All Rights Reserved</p>
                    </div>
                    <div class="col-md-3 text small">
                        <p>{!! nl2br(e( $page_datas->page->address)) !!}</p>
                    </div>
                    <div class="col-md-2 text small">
                        <p>{{ $page_datas->page->phone }}<br>
                            {{ $page_datas->page->email }}</p>
                    </div>
                    <div class="col-md-4 text">
                        <div class="row no-margin">
                            <ul class="social">
                                @if($page_datas->page->twitter)
                                <li><a href="{{ $page_datas->page->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                @endif
                                @if($page_datas->page->facebook)
                                <li><a href="{{ $page_datas->page->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                @endif
                                @if($page_datas->page->instagram)
                                <li><a href="{{ $page_datas->page->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
