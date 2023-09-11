@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="">{{ __('Manage Categories') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('categories')}}">Categories</a></li>
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
                            <h3 class="card-title">{{ __('Edit Category') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form id="ajax-form">
                                    @csrf
                                    @php 
                                        $categoryName  = !empty( old('is_edit') ) ? old('category_name') : $catDeatils->name;
                                    @endphp
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="title">{{ __('Name') }} <span class="error">*</span></label>
                                                    <input type="text" class="form-control" id="title" name="category_name" placeholder="Title" value="{{ $categoryName }}">
                                                    <span id="category_name_error" class="error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                         <input type="hidden" name="is_edit" id="is_edit" value="1">
                                        <button type="button"  onclick="submitForm('{{ route('categories.update',$catDeatils->id) }}', '{{ route('categories') }}', {{$catDeatils->id}} )" class="btn btn-primary">Submit</button>
                                        <a href="{{route('categories')}}" class="btn  btn-danger">Exit</a>
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