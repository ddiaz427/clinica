@extends('main')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        <button class="close" data-close="alert"></button> {{ Session::get('flash_message') }}
                    </div>
                @endif
				<div class="panel-heading">Bienvendido al Panel de Administracíón</div>
			</div>
		</div>
	</div>
</div>
@endsection