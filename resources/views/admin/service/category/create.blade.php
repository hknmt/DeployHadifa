@extends('admin.layouts.master')

@section('content')
	
	<ol class="breadcrumb">
		<li>Dasboard</li>
		<li><a href="{{ route('admin.service.index', ['id' => $service['id']]) }}">{{ $service['name'] }}</a></li>
	</ol>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Tạo chuyên mục cha</h4>
		</div>
		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form action="{{ route('admin.service.category.store') }}" method="POST">
		<div class="panel-body">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="c_id" value="{{ $service['id'] }}">
			<div class="form-group">
				<label for="name">Tên: </label>
				<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
			</div>
		</div>
		<div class="panel-footer">
			<p class="pull-right">
				<button type="button" class="btn btn-danger" onclick="window.location.assign('{{ route('admin.service.category.index', ['id' => $service['id']]) }}')">Hủy</button>
				<button class="btn btn-success" type="submit">Lưu</button>
				<div class="clearfix"></div>
			</p>
		</div>
		</form>
	</div>

@endsection