@extends('layouts.app')
@section('content')
<div class="hold-transition am-front-page">
	<div class="container" >
		<div class="row">
			<div class="col-md-12">
				 <div class="card am-card">
				 	<div class="card-header">
				 		<a href="{{route('user.articles')}}" style="color:black;"><i class="fa fa-reply" aria-hidden="true"></i> Back</a>
	                </div>
	                <div class="card-body">
	                    <div class="row">
	                        <div class="col-12">
	                        	<h1 style="text-align: center;">{{$article->title}}</h1>

	                        	<img src="{{$article->feature_img}}" width="1000" height="auto" style="object-fit: cover; padding-left: 100px; padding-top: 30px;">

	                        	@if($article->tags->isNotEmpty())
		                        	<div class="am-tags">
		                        		<b>{{__('Tags :')}}</b>
		                        		@foreach($article->tags as $key => $tag)
		                        			{{ $tag->name }}
		                        			@if(count($article->tags) != $key+1)
		                        				{{__(', ')}}
		                        			@endif
		                        		@endforeach
		                        	</div>
	                        	@endif

	                        	@if($article->categories->isNotEmpty())
		                        	<div class="am-categories">
		                        		<b>{{__('Categories :')}}</b>
		                        		@foreach($article->categories as $key => $category)
		                        			{{ $category->name }}
		                        			@if(count($article->categories) != $key+1)
		                        				{{__(', ')}}
		                        			@endif
		                        		@endforeach
		                        	</div>
	                        	@endif

	                        	<div class="am-description">
	                        		<p>{!! $article->description !!}</p>
	                        	</div>
	                        </div>
	                    </div>
	                </div>
				 </div>
			</div>
		</div>
	</div>
</div>
@endsection