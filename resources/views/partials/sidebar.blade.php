<div class="col-md-3" id="sidebar">
	<div id="sidebar-category">
		<h4>Dịch vụ</h4>
		<ul>
			<li class="{{ ($link == 1) ? 'active' : '' }}"><a href="{{ route('service.trade.index') }}">Trade Fair Exhibition</a></li>
			@foreach($resultSidebar as $service)
			<li><a href="{{ route('service.service', ['service' => $service['slug']]) }}">{{ $service['name'] }}</a>
				<ul>
					@foreach($service['category'] as $category)
						<li><a href="{{ route('service.category', ['service' => $service['slug'], 'category' => $category['slug']]) }}">{{ $category['name'] }}</a></li>
					@endforeach
				</ul>
			</li>
			@endforeach
		</ul>
		<script>
				$(document).ready(function() {
					$('#sidebar-category li').each( function() {
						if($(this).children('ul').length > 0){
							$(this).prepend('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>');
							$(this).addClass('parent');
						}else{
							$(this).children('a').css('padding-left','20px');
						}
						if($(this).attr('rel') == 'open'){
							$(this).addClass('active');
						}
					});
					$('#sidebar-category li.parent span').click( function() {
						if($(this).parent().attr('rel') == 'open'){
							$(this).parent().removeClass('active');
							$(this).attr('class', 'glyphicon glyphicon-plus');
							$(this).parent().removeAttr('rel');
						}else{
							$(this).parent().addClass('active');
							$(this).parent().attr('rel', 'open');
							$(this).attr('class', 'glyphicon glyphicon-minus');
						}
					});
				});
			</script>
		<div class="clearfix"></div>
	</div>
	<div id="sidebar-link">
		<h4>trade fair exhibition</h4>
		<ul class="clearfix">
		@foreach($showTfe as $show)
			<li><a href="{{ route('service.trade.show', $show->slug) }}"><img src="{{ URL::asset($show->image) }}" alt="{{ $show->name }}"></a></li>
		@endforeach
		</ul>
		<div class="clearfix"></div>
	</div>
	<div id="sidebar-link">
		<h4>vietnam news</h4>
		<ul class="clearfix">
			@foreach($showPartner as $partner)
			<li><a target="_blank" href="{{ $partner->link }}"><img src="{{ URL::asset($partner->image) }}" alt="{{ $partner->description }}"></a></li>
			@endforeach
		</ul>
		<div class="clearfix"></div>
	</div>
</div>