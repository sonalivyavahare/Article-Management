@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="">{{ __('Manage Articles') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('articles')}}">Articles</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

     <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Create Article') }}</h3>
                        </div>
                    </div>
                </section>
            </div>
            <form action="{{ route('articles.update',$article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @php  
                    $publishDate = '';
                    if($article->publish_date != null)
                    $publishDate = \Carbon\Carbon::parse($article->publish_date)->format('Y-m-d');
                    $title  = !empty( old('is_edit') ) ? old('title') : $article->title;
                    $description  = !empty( old('is_edit') ) ? old('description') : $article->description;
                    $summary  = !empty( old('is_edit') ) ? old('summary') : $article->summary;
                    $author  = !empty( old('is_edit') ) ? old('author') : $article->author;
                    $publish_date  = !empty( old('is_edit') ) ? old('publish_date') : $publishDate ;

                @endphp
                <div class="row">
                    <section class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }} <span class="error">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $title}}">
                                    <span id="title_error" class="error error-message"></span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                 <label for="description">{{ __('Description') }} <span class="error">*</span></label>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea class="form-control" name="description" id="description">{{$description}}</textarea>
                                </div>
                                <span id="description_error" class="error error-message"></span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                 <label for="description">{{ __('Summary') }} <span class="error">*</span></label>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea class="form-control"  rows="7" name="summary" id="summary">{{$summary}}</textarea>
                                </div>
                                <span id="summary_error" class="error error-message"></span>
                            </div>
                        </div>
                    </section>

                    <section class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <label for="status">{{ __('Status') }} </label>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                   <label>{{__('Draft / Publish')}}</label>
                                    <div>
                                        <label>
                                            @php
                                                $status = !empty( old('status') ) ? old('status') : '';
                                                $status = !empty( old('is_add') ) ? $status : '1';
                                            @endphp

                                            <input type="checkbox" name="status" id="status" value="1" {{ $status == "1" ? "checked" : "" }} data-toggle="toggle" data-style="ios" value="1">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <label for="author">{{ __('Author') }} <span class="error">*</span></label>
                            </div>
                            <div class="card-body">
                               <div class="form-group">
                                    <input type="text" class="form-control" id="author" name="author" placeholder="Author" value="{{ $author }}">
                                    <span id="author_error" class="error error-message"></span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <label for="publish_date">{{ __('Publish Date') }} <span class="error">*</span></label>
                            </div>
                            <div class="card-body">
                               <div class="form-group">
                                    <input type="date" class="form-control" id="publish_date" name="publish_date" placeholder="Publish Date" value="{{ $publish_date }}">
                                    <span id="publish_date_error" class="error error-message"></span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <label for="featured_image">{{ __('Featured Image') }}</label>
                            </div>
                            <div class="card-body">
                               <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="featured_image" onchange="loadFile(event)">
                                            <label class="custom-file-label" for="featured_image">{{ __('Choose file') }}</label>
                                        </div>
                                    </div>
                                    <span id="image_error" class="error error-message"></span>
                                </div>
                                <img id="output"  @if($article->feature_img != '') src="{{ $article->feature_img }}" width="300" height="100" @endif >
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <label>{{ __('Tags') }} <span class="error">*</span></label>
                            </div>
                            <div class="card-body">
                               <div class="form-group">
                                    <select class="select2" multiple="multiple" data-placeholder="Select Tags" name="tags[]" style="width: 100%;" id="tags">
                                        @foreach ($tags as $tag)
                                            @if(in_array($tag->id, $articleTags->toArray()) || (!empty(old('tags')) && in_array($tag->id, old('tags'))) )
                                                <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                                            @else
                                                 <option value="{{$tag->id}}"> {{$tag->name}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span id="tags_error" class="error error-message"></span>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <label>{{ __('Categories') }} <span class="error">*</span></label>
                            </div>
                            <div class="card-body">
                               <div class="form-group">
                                    <select class="select2" name="categories[]" multiple="multiple" data-placeholder="Select Categories" style="width: 100%;">
                                        @foreach ($categories as $category)
                                            @if(in_array($category->id, $articleCategories->toArray()) )
                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                            @else
                                                 <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span id="categories_error" class="error error-message"></span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="col-md-12">
                         <div class="card">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                <a href="{{route('articles')}}" class="btn  btn-danger">{{ __('Exit') }}</a>
                            </div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
