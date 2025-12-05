@extends("admin.layout.main")
@section('content')

<style>
    .profile-form-label {
        font-size: 14px;
        font-weight: 700;
        color: #000;
        margin-bottom: 10px;
    }

    .custom-tab-card {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        border-top: none;
        margin-bottom: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
    }

    .preview-box {
        width: 73px;
        height: 68px;
        border-radius: 12px;
        overflow: hidden;
        background: transparent;
        border: 1px solid #ced4da;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-flex {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .custom-file-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 15px 22px;
        border-radius: 12px;
        background: transparent;
        border: 1px solid #B0B0B0;
        cursor: pointer;
        font-size: 14px;
    }

    .custom-file-label i {
        font-size: 16px;
    }
    
    /* Success/Error messages */
    .alert {
        border-radius: 10px;
        border: none;
    }
    
    .alert-success {
        background-color: #d1e7dd;
        color: #0f5132;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        color: #842029;
    }
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

            <h1>Store Details</h1>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- PROFILE SETTINGS -->
            <div class="custom-tab-card mt-5">
                <form action="{{ route('admin.store.details.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- PROFILE PICTURE -->
                    <div class="mb-3 mt-4">
                        <label class="profile-form-label fs-bold">Profile Picture</label>

                        <div class="profile-flex">
                            <div class="preview-box">
                                <img id="previewImage" src="{{ $storeDetail->profile_image_url }}" alt="Store Preview">
                            </div>

                            <label class="custom-file-label" for="profileInput">
                                <i class="icon-image"></i> Change Picture
                            </label>

                            <input type="file" id="profileInput" name="profile_image" class="d-none" accept="image/*">
                        </div>
                        <small class="text-muted">Maximum file size: 2MB. Allowed formats: JPG, PNG, GIF</small>
                    </div>

                    <hr>

                    <!-- STORE NAME + EMAIL -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="profile-form-label">Store Name</label>
                            <input type="text" 
                                   name="store_name" 
                                   class="form-control @error('store_name') is-invalid @enderror" 
                                   placeholder="Enter store name"
                                   value="{{ old('store_name', $storeDetail->store_name) }}">
                            @error('store_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="profile-form-label">Email</label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="Enter email"
                                   value="{{ old('email', $storeDetail->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- PHONE NUMBER -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="profile-form-label">Phone Number</label>
                            <input type="text" 
                                   name="phone" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   placeholder="Enter phone number"
                                   value="{{ old('phone', $storeDetail->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- ADDRESS -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="profile-form-label">Address</label>
                            <textarea name="address" 
                                      class="form-control @error('address') is-invalid @enderror" 
                                      rows="2" 
                                      placeholder="Enter full address">{{ old('address', $storeDetail->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- CITY + STATE -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="profile-form-label">City</label>
                            <input type="text" 
                                   name="city" 
                                   class="form-control @error('city') is-invalid @enderror" 
                                   placeholder="Enter city"
                                   value="{{ old('city', $storeDetail->city) }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="profile-form-label">State</label>
                            <input type="text" 
                                   name="state" 
                                   class="form-control @error('state') is-invalid @enderror" 
                                   placeholder="Enter state"
                                   value="{{ old('state', $storeDetail->state) }}">
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

            </div>

            <!-- STORE CHARGES SECTION -->
            <div class="custom-tab-card">
                <h1>Store Charges</h1>

                    <div class="row mb-3 mt-5">

                        <div class="col-12 col-md-6 mb-3">
                            <label class="profile-form-label">Delivery Charges (₹)</label>
                            <input type="number" 
                                   step="0.01" 
                                   min="0"
                                   name="delivery_charges" 
                                   class="form-control @error('delivery_charges') is-invalid @enderror" 
                                   placeholder="Enter delivery charges"
                                   value="{{ old('delivery_charges', $storeDetail->delivery_charges) }}">
                            @error('delivery_charges')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="profile-form-label">GST Tax (%)</label>
                            <input type="number" 
                                   step="0.01" 
                                   min="0" 
                                   max="100"
                                   name="gst_tax" 
                                   class="form-control @error('gst_tax') is-invalid @enderror" 
                                   placeholder="Enter GST tax"
                                   value="{{ old('gst_tax', $storeDetail->gst_tax) }}">
                            @error('gst_tax')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                
            </div>

            <!-- UPDATE BUTTON -->
            <div class="mt-4">
                <button type="submit" class="tf-button btn w-auto">Update Store Details</button>
            </div>
            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Image preview functionality
    document.getElementById('profileInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewImage');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush