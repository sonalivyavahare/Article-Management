@extends('layouts.app')
@section('content')
<div class="hold-transition am-front-page">
	<div class="container" >
		<div class="row">
			@foreach($articles as $article)
				<div class="col-md-3">
					@php
						$articleImg = ( !empty($article->feature_img)) ? $article->feature_img : asset('/uploads/default_image.png');
					@endphp
					<a href="articles/{{ $article->slug }}">
					 	<div class="card am-card">
					 		<img class="card-img-top" src="{{ $articleImg }}" alt="Card image cap"/>
		                	<div class="card-body" style="padding-top: 10px; padding-bottom: 10px;">
		                		<span>{{ $article->author }} </span>
		                		<span style="float:right;">{{\Carbon\Carbon::parse($article->publish_date )->isoFormat('DD-MM-YYYY');}}</span>
		                		<h4 class="mt-3">{{ $article->title }}</h4>
		                		<p>{{ (strlen($article->summary)) > 75 ? substr($article->summary, 0 , 75).'..' :  $article->summary}}</p>
		                	</div>
					 	</div>
					 </a>
				</div>
			@endforeach
		</div>
		<div class="row">
			<div style="float: right;"> 
	        	{{ $articles->links() }}
			</div>
		</div>
	</div>
</div>
@endsection