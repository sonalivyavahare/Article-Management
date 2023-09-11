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
                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Edit Article') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('articles.update',$article->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    @php 
                                        $title  = !empty( old('is_edit') ) ? old('title') : $article->title;
                                        $description  = !empty( old('is_edit') ) ? old('description') : $article->description;
                                        
                                    @endphp
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">{{ __('Title') }} <span class="error">*</span></label>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $title}}">
                                                    @if($errors->has('title'))
                                                        <div class="error">{{ $errors->first('title') }}</div>
                                                    @endif
                                                    <span id="title_error" class="error error-message"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="old_feature_img" value="{{ $article->feature_img }}">
                                                    <label for="featured_image">Feature Image</label>
                                                    @if($article->feature_img != '')
                                                    <a href="{{ $article->feature_img }}" target="_blank" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    @endif
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="image">
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('image'))
                                                        <div class="error">{{ $errors->first('image') }}</div>
                                                    @endif
                                                    <span id="image_error" class="error error-message"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                                <div class="form-group">
                                                    <label>{{ __('Tags') }}</label>
                                                    <select class="select2" multiple="multiple" data-placeholder="Select Tags" name="tags[]" style="width: 100%;" id="tags">
                                                        @foreach ($tags as $tag)
                                                            @if(in_array($tag->id, $articleTags->toArray()) || (!empty(old('tags')) && in_array($tag->id, old('tags'))) )
                                                                <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                                                            @else
                                                                 <option value="{{$tag->id}}"> {{$tag->name}} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('tags'))
                                                        <div class="error">{{ $errors->first('tags') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Categories') }}</label>
                                                    <select class="select2" name="categories[]" multiple="multiple" data-placeholder="Select Categories" style="width: 100%;">
                                                        @foreach ($categories as $category)
                                                            @if(in_array($category->id, $articleCategories->toArray()) )
                                                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                            @else
                                                                 <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('categories'))
                                                        <div class="error">{{ $errors->first('categories') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="description">{{ __('Description') }} <span class="error">*</span></label>
                                                    <textarea class="form-control" name="description" id="description">{{$description}}</textarea>
                                                    @if($errors->has('description'))
                                                        <div class="error">{{ $errors->first('description') }}</div>
                                                    @endif

                                                    <span id="description_error" class="error error-message"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <input type="hidden" name="is_edit" id="is_edit" value="1">
                                        <button type="submit" class="btn btn-primary" id="Submit">Submit</button>
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
