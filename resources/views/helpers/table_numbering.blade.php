@php 
    // setting perpage
    $perpage = 15;

    // current page
    $curr_page = Request::get('page') ? Request::get('page') : 1;

    // engine
    echo( ($key + 1) + ( ($curr_page - 1) * $perpage ) );
@endphp