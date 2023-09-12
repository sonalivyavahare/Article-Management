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
                     <li class="breadcrumb-item"><a href="{{ route('articles')}}">{{ __('Articles') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('View') }}</li>
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
                            <h3 class="card-title">
                                {{ __('View Article') }}
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>ID</td>
                                            <td>
                                                @if(!empty( $article->id))
                                                    {{ $article->id }}
                                                @else
                                                    {{ '-' }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Title</td>
                                            <td>
                                                @if(!empty( $article->title))
                                                    {{ $article->title }}
                                                @else
                                                    {{ '-'}}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Slug</td>
                                            <td>{{ $article->slug }}</td>
                                        </tr>
                                        <tr>
                                            <td>Featured Image</td>
                                            <td>
                                                @if(!empty($article->feature_image))
                                                    <img src="{{ $article->feature_image }}" width="300" height="100" />
                                                @else
                                                    {{ '-' }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Author</td>
                                            <td>{{ $article->author }}</td>
                                        </tr>
                                        <tr>
                                            <td>Publish Date</td>
                                            <td>
                                                @if(!empty($article->publish_date))
                                                    {{ \Carbon\Carbon::parse($article->publish_date )->isoFormat('DD/MM/YYYY') }}
                                                @else
                                                    {{ '-' }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>
                                                @if(!empty($article->description))
                                                    {!! $article->description !!}
                                                @else
                                                    {{ '-' }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Summary</td>
                                            <td>
                                                @if(!empty($article->summary))
                                                    {!! $article->summary !!}
                                                @else
                                                    {{ '-' }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                @if( $article->status == 0)
                                                    {{ __('Draft') }}
                                                @else
                                                    {{ __('Publish') }}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('articles')}}" class="btn btn-danger" style="float:right">{{ __('Exit') }}</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

@endsection
