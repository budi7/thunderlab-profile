<div class="col-md-12" style="text-align:right;">
	@if(isset($paginate_data))
	{!! $paginate_data->appends(Request::all())->render() !!}
	@else
	@if(!empty($page_datas->datas))
	{!! $page_datas->datas->appends(Request::all())->render() !!}
	@endif
	@endif
</div>