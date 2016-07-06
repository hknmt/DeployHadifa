<div class="col-md-3" id="sidebar">
	<div id="sidebar-category">
		<h4>{{ $resultSidebar['name'] }}</h4>
		<ul>
			@foreach($resultSidebar['category'] as $category)
				@if( array_key_exists(2, $uri) )
					<li rel="{{ ($uri[2] == $category['slug']) ? 'open' : '' }}"></span><a href="{{ route('service.category', ['service' => $resultSidebar['slug'], 'category' => $category['slug']]) }}">{{ $category['name'] }}</a>
					
				@else
					<li></span><a href="{{ route('service.category', ['service' => $resultSidebar['slug'], 'category' => $category['slug']]) }}">{{ $category['name'] }}</a>
				@endif
					<ul>
						@foreach($category['subcategory'] as $subcategory)
							@if( array_key_exists(3, $uri) )
								<li id="{{ ($uri[3] == $subcategory['slug']) ? 'here' : '' }}"><a href="{{ route('service.subcategory', ['service' => $resultSidebar['slug'], 'category' => $category['slug'], 'subcategory' => $subcategory['slug']]) }}">{{ $subcategory['name'] }}</a></li>
							@else
								<li><a href="{{ route('service.subcategory', ['service' => $resultSidebar['slug'], 'category' => $category['slug'], 'subcategory' => $subcategory['slug']]) }}">{{ $subcategory['name'] }}</a></li>
							@endif
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