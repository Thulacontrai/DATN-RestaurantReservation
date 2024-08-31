@extends('admin.master')

@section('title', 'Add Product')

@section('content')
<div class="row">
    <div class="col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Product Information</div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="card-border">
                            <div class="card-border-title">General Information</div>
                            <div class="card-border-body">

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Product Name <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Product Category <span class="text-red">*</span></label>
                                            <select class="form-control">
                                                <option value="Select Product Category">Select Product Category</option>
                                                <option value="Mobiles">Mobiles</option>
                                                <option value="Books">Books</option>
                                                <option value="Games">Games</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Product Price <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Product Price">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class=" mb-3">
                                            <label class="form-label">Product Discount</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Set Product Discount">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="mb-0">
                                            <label class="form-label">Product Description <span class="text-red">*</span></label>
                                            <textarea rows="4" class="form-control"
                                                placeholder="Enter Product Description"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="card-border">
                            <div class="card-border-title">Meta Data</div>
                            <div class="card-border-body">

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Title <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Meta Title">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Name <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Meta Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Tags <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter Meta Tags">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-12">
                                        <div class="mb-0">
                                            <label class="form-label">Meta Description <span class="text-red">*</span></label>
                                            <textarea rows="4" class="form-control"
                                                placeholder="Enter Meta Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12">
                        <div class="card-border">
                            <div class="card-border-title">Product Images</div>
                            <div class="card-border-body">

                                <div id="dropzone" class="dropzone-dark">
                                    <form action="/upload" class="dropzone needsclick dz-clickable" id="demo-upload">

                                        <div class="dz-message needsclick">
                                            <button type="button" class="dz-button">Drop files here or click to
                                                upload.</button><br>
                                            <span class="note needsclick">(This is just a demo dropzone. Selected files are
                                                <strong>not</strong> actually uploaded.)</span>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-12">
                        <div class="custom-btn-group flex-end">
                            <button type="button" class="btn btn-light">Cancel</button>
                            <a href="products.html" class="btn btn-success">Add Product</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Row end -->
@endsection
