@extends('admin.layouts.template')
@section('page-title')
    Add Product - Single Ecom
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span>Edit Product</h4>
        <!-- Basic Layout & Basic with Icons -->

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Product</h5>
                        <small class="text-muted float-end">Full The Information</small>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('updateproduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $product_info->id }}" name="product_id">

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        value="{{ $product_info->product_name }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ $product_info->price }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        value="{{ $product_info->quantity }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Short
                                    Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="product_short_des" id="" cols="30" rows="10"> {{ $product_info->product_short_des }} </textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Long
                                    Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="product_long_des" id="" cols="30" rows="10"> {{ $product_info->product_long_des }} </textarea>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Select Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example" name="product_category_id">
                                        <option selected>Select A Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if ($category->id == $product_info->product_category_id) selected @endif>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Select Sub Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example" name="product_subcategory_id">
                                        <option selected>Select A Subcategory</option>
                                        {@foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                @if ($subcategory->id == $product_info->product_category_id) selected @endif>
                                                {{ $subcategory->subcategory_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Upload Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile" name="product_img" />
                                </div>
                            </div>

                            <div class="row mb-3">

                                <div class="col-sm-10">
                                    <img src="{{ asset($product_info->product_img) }}" alt="" style="height:80px;">
                                </div>
                            </div>



                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
