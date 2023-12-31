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
                    <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Create Article') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">{{ __('Title') }} <span class="error">*</span></label>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="">
                                                    <span id="title_error" class="error error-message"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="featured_image">Feature Image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="image" id="featured_image">
                                                            <label class="custom-file-label" for="featured_image">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <span id="image_error" class="error error-message"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Tags') }}</label>
                                                    <select class="select2" multiple="multiple" data-placeholder="Select Tags" name="tags[]" style="width: 100%;">
                                                        @foreach($tags as $tag)
                                                            @if(!empty(old('tags')) && in_array($tag->id, old('tags')) )
                                                                <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                                                            @else
                                                                 <option value="{{$tag->id}}"> {{$tag->name}} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Categories') }}</label>
                                                    <select class="select2" name="categories[]" multiple="multiple" data-placeholder="Select Categories" style="width: 100%;">
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="description">{{ __('Description') }} <span class="error">*</span></label>
                                                    <textarea class="form-control" name="description" id="description"></textarea>
                                                </div>
                                                <span id="description_error" class="error error-message"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                      <a href="{{route('articles')}}" class="btn  btn-danger">Exit</a>
                                    </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
@endsection
