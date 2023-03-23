@extends('admin.layouts.template')
@section('page-title')
    All Category - Single Ecom
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span>All Category</h4>

        <div class="card">
            <h5 class="card-header">Category List</h5>
            <!-- Success massage-->
            @if (session()->has('massage'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session()->get('massage') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Success massage-->
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Sub Category</th>
                            <th>Product</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->subcategory_count }}</td>
                                <td>{{ $category->product_count }}</td>

                                <td>
                                    <a href="{{ route('editcategory', $category->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('deletecategory', $category->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
