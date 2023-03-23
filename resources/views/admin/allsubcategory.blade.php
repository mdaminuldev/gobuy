@extends('admin.layouts.template')
@section('page-title')
    All Sub Category - Single Ecom
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span>All Sub Category</h4>

        <div class="card">
            @if (session()->has('massage'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session()->get('massage') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- From -->
            <h5 class="card-header">Sub Category List</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Sub Category Name</th>
                            <th>Parent Category</th>
                            <th>Product</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->id }}</td>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>{{ $subcategory->category_name }}</td>
                                <td>{{ $subcategory->product_count }}</td>

                                <td>
                                    <a href="{{ route('editsubcategory', $subcategory->id) }}"
                                        class="btn btn-primary">Edit</a>
                                    <a href="{{  route('deletesubcat', $subcategory->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
