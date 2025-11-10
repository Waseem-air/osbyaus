@extends("admin.layout.main")
@section('content')
<!-- main-content -->
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Edit Category</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html"><div class="text-tiny">Dashboard</div></a>
                    </li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><a href="#"><div class="text-tiny">Category</div></a></li>
                    <li><i class="icon-chevron-right"></i></li>
                    <li><div class="text-tiny">Edit Category</div></li>
                </ul>
            </div>

            <!-- edit-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" 
                      action="{{ route('update.category', $category->id) }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    
                    @csrf

                    <fieldset class="name">
                        <div class="body-title">Category Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Category name" 
                               name="name" value="{{ old('name', $category->name) }}" required>
                    </fieldset>

                    <fieldset>
                        <div class="body-title">Upload Image <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            <div class="item up-load">
                                <label class="uploadfile h250" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">
                                        Drop your image here or <span class="tf-color">click to browse</span>
                                    </span>
                                    @if($category->image)
                                        <img id="myFile-input" src="{{ asset('uploads/categories/' . $category->image) }}" alt="Category Image">
                                    @else
                                        <img id="myFile-input" src="" alt="">
                                    @endif
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="category">
                        <div class="body-title">Select Category Icon</div>
                        <div class="select flex-grow">
                            <select name="icon">
                                <option value="">Select icon</option>
                                <option value="icon-1" {{ $category->icon == 'icon-1' ? 'selected' : '' }}>Icon 1</option>
                                <option value="icon-2" {{ $category->icon == 'icon-2' ? 'selected' : '' }}>Icon 2</option>
                            </select>
                        </div>
                    </fieldset>

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Update</button>
                    </div>
                </form>
            </div>
            <!-- /edit-category -->
        </div>
    </div>

    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 <a href="../index.html">Ecomus</a>. Design by Themesflat All rights reserved</div>
    </div>
</div>
<!-- /main-content -->
@endsection
