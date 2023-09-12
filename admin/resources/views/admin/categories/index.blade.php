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
                    <li class="breadcrumb-item active">{{ __('Categories') }}</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
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
                            <h3 class="card-title create-btn">
                                <button type="button" class="btn btn-sm btn-success" id="createBtn" data-toggle="modal" data-target="#categoryCreateModal">Create</button>
                            </h3>
                        </div>
                        <div class="card-body">
                             
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        {!! $dataTable->table() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="categoryCreateModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModal">{{ __('Create Category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="ajax-form">
                <div class="modal-body">
                    @csrf
                    <p class="am-sucess-msg"></p>
                    <div class="form-group">
                        <label for="title">{{ __('Name') }} <span class="error">*</span></label>
                        <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" value="{{old('category_name')}}">
                        <span id="category_name_error" class="error em-error-msg"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  onclick="submitForm('{{ route('categories.store') }}', '')" class="btn btn-primary">Submit</button>
                    <a href="{{route('categories')}}" class="btn  btn-danger">Exit</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog" aria-labelledby="editTagModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTagModal">{{ __('Edit Category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="update-ajax-form">
                <div class="modal-body">
                    @csrf
                    <p class="am-sucess-msg"></p>
                    <div class="form-group">
                        <label for="title">{{ __('Name') }} <span class="error">*</span></label>
                        <input type="text" class="form-control" id="edit_category_name" name="category_name" placeholder="Category Name" value="{{old('category_name')}}">
                        <span id="category_name_error_edit" class="error em-error-msg"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  onclick="" class="btn btn-primary" id="update_btn">Submit</button>
                    <a href="{{route('tags')}}" class="btn  btn-danger">Exit</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
    $('#categories-table').on('click', 'button',function (ele) {
        var tr = ele.target.parentNode.parentNode;
        var id = tr.cells[0].textContent;
        console.log(tr);
        var name = tr.cells[1].textContent;
        $('#edit_category_name').val(name);

        $('#update_btn').attr('onclick', "updateForm('{{url('/admin/categories/update/')}}/"+id+"', '{{url('/admin/categories')}}', "+id+")")
    })
</script>
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush