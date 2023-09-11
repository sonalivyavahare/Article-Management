@extends('layouts.app')
@section('content')
<div class="hold-transition am-front-page">
	<div class="container" >
		<div class="row">
			<div class="col-md-12">
				 <div class="card am-card">
				 	<div class="card-header">
	                    <h3 >Articles</h3>
	                </div>
	                <div class="card-body">
	                    <div class="row">
	                        <div class="col-12">
	                            @foreach($articles as $article)
	                            <h6 ><a href="articles/{{$article->slug}}" class="am-article-list">{{$article->title}}<a></h6>
	                            @endforeach
	                        </div>
	                    </div>
	                    <div style="float: right;"> 
	                    	{{ $articles->links() }}
						</div>
	                </div>
				 </div>
			</div>
		</div>
	</div>
</div>
@endsection