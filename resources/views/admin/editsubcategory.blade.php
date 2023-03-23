@extends('admin.layouts.template')
@section('page-title')
    Add Sub Category - Single Ecom
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span>Update Category</h4>
        <!-- Basic Layout & Basic with Icons -->

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Update Sub Category</h5>
                        <small class="text-muted float-end">Full The Information</small>
                    </div>
                    <div class="card-body">
                        <!-- Error Massage -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Error Massage -->
                        <form action="{{ route('updatesubcat') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <input type="hidden" name="subcat_id" value="{{ $subcategory_info->id }}">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Sub Category Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="subcategory_name" name="subcategory_name"
                                        value="{{ $subcategory_info->subcategory_name }}" />
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update Sub Category</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
