@extends('template.frontend')

@section('career')
    active
@stop

@push('content')
<div id="page-content">
    <div class="container">
        <div class="row no-margin">
            <div class="col-md-12 padding-leftright-null">
                <div id="page-header">
                    <div class="text">
                        <h1 class="margin-bottom-small"><small>Join Us</h1>
                        <p class="heading left max full grey-dark">
                            Working at Thunderlab means committed to achieve challenging objectives in technologies. Learn more, achieve more,  <strong>together</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END Page header  -->
    <div id="home-wrap" class="content-section">
        <div class="container">
            <!--  Portfolio  -->
            <section id="projects" data-isotope="load-simple" class="page padding-onlytop-md padding-onlybottom-lg">
                <!--  Filters  -->
                <div class="row no-margin text-left">
                    <div class="col-sm-12 padding-leftright-null">
                        <div class="filter-wrap left">
                            <ul class="col-md-12 filters uppercase padding-leftright-null">
                                <li data-filter="*" class="is-checked">All</li>
                                @forelse($page_datas->types as $key => $type)
                                <li data-filter=".{{ str_replace(' ', '', $type->type) }}">{{ $type->type }}</li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <!--  END Filters  -->
                <div class="projects-items equal two-columns">
                    @forelse($page_datas->datas as $key => $data)
                        <div class="single-item one-item design {{ str_replace(' ', '', $data->type) }}">
                            <div class="item">
                                <img src="{{ $data->cover }}" alt="">
                                <div class="content">
                                    <p class="mb-1"><small>{{ $data->updated_at->diffForHumans() }}</small></p>
                                    <h3>{{ $data->title }}</h3>
                                    <p>{{ $data->description }}</p>
                                </div>
                                <a href="javascript:void(0);" class="link"></a>
                            </div>
                        </div>
                    @empty
                        <div class="single-item">
                            <h4 class="text-muted">There are currently no vacancies available</h4>
                        </div>
                    @endforelse
                </div>
            </section>
            <!-- END Portfolio -->
        </div>
    </div>
</div>
@endpush


@push('scripts')
@endpush
