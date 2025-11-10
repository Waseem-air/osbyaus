@extends("admin.layout.main")
@section('content')
      <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                                    <h3>Category infomation</h3>
                                </div>
                                <!-- new-category -->
                                <div class="wg-box">
                                   <form class="form-new-product form-style-1" 
      action="{{ route('store.category') }}" 
      method="POST" 
      enctype="multipart/form-data">

    @csrf

    <fieldset class="name">
        <div class="body-title">Category Name <span class="tf-color-1">*</span></div>
        <input class="flex-grow" type="text" placeholder="Category name" 
               name="name" tabindex="0" value="{{ old('name') }}" required>
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
                    <img id="myFile-input" src="" alt="">
                    <input type="file" id="myFile" name="image" accept="image/*" required>
                </label>
            </div>
        </div>
    </fieldset>

    <fieldset class="category">
        <div class="body-title">Select Category Icon</div>
        <div class="select flex-grow">
            <select name="icon">
                <option value="">Select icon</option>
                <option value="icon-1">Icon 1</option>
                <option value="icon-2">Icon 2</option>
            </select>
        </div>
    </fieldset>

    <div class="bot">
        <div></div>
        <button class="tf-button w208" type="submit">Save</button>
    </div>
</form>

                                </div>
                                <!-- /new-category -->
                            </div>
                            <!-- /main-content-wrap -->
                        </div>
                        <!-- /main-content-wrap -->
                        <!-- bottom-page -->
                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2024 <a href="../index.html">Ecomus</a>. Design by Themesflat All rights reserved</div>
                        </div>
                        <!-- /bottom-page -->
                    </div>
                    <!-- /main-content -->
@endsection