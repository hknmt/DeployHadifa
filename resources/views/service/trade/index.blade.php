@extends('layouts.master')

@section('head.title')
	Trade Fair Exhibition
@endsection

@section('body.sidebar')
	@include('partials.sidebar')
@endsection

@section('body.content')
	<div class="title-box">
		<span class="dot"></span>
		<ul id="breadcrumb">
			<li><a href="{{ route('service.index') }}">Dịch vụ</a></li>
			<li><a href="{{ route('service.trade.index') }}">Trade Fair Exbihition</a></li>
		</ul>		
		<div class="clearfix"></div>
	</div>
	<div class="box" id="service-trade">
		<h4>trade fair exhibition</h4>
		<div class="clearfix row" id="trade-show-item">
			<ul>
				@foreach( $result as $key => $value)
				<li>
					<div>
						<div class="trade-logo">
							<img class="img-responsive" src="{{ URL::asset($value->image) }}" alt="">
						</div>			
						<div class="information-content">
							{!! $value->description !!}
						</div>
						@if($value->status)
						<div class="trade-new">
							<img src="{{ URL::asset('img/new.png') }}" alt="">
						</div>
						@endif
					</div>
					<div class="trade-name clearfix">
						<p>{{ str_limit($value->name, 20) }}</p>
						<a href="{{ route('service.trade.show',$value->slug) }}/">Chi tiết...</a>
					</div>
				</li>
				@if(($key+1)%3==0 && $key!=0)
					<div class="clearfix"></div>
				@endif
				@endforeach
			</ul>			
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-3" style="text-align:center">
				{!! $result->render() !!}
			</div>
		</div>
	</div>
@endsection
