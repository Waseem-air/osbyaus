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
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

            <!-- PROFILE SETTINGS -->
            <div class="custom-tab-card">
                <form>

                    <!-- PROFILE PICTURE -->
                    <div class="mb-3 mt-4">
                        <label class="profile-form-label fs-bold">Profile Picture</label>

                        <div class="profile-flex">
                            <div class="preview-box">
                                <img id="previewImage" src="{{ asset('admin/images/placeholder.png') }}" alt="Preview">
                            </div>

                            <label class="custom-file-label" for="profileInput">
                                <i class="icon-image"></i> Change Picture
                            </label>

                            <input type="file" id="profileInput" class="d-none" accept="image/*">
                        </div>
                    </div>

                    <hr>

                    <!-- STORE NAME + EMAIL -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="profile-form-label">Store Name</label>
                            <input type="text" class="form-control" placeholder="Enter store name">
                        </div>

                        <div class="col-md-6">
                            <label class="profile-form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Enter email">
                        </div>
                    </div>

                    <!-- PHONE NUMBER -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="profile-form-label">Phone Number</label>
                            <input type="text" class="form-control" placeholder="Enter phone number">
                        </div>
                    </div>

                    <!-- ADDRESS -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="profile-form-label">Address</label>
                            <textarea class="form-control" rows="2" placeholder="Enter full address"></textarea>
                        </div>
                    </div>

                    <!-- CITY + STATE -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="profile-form-label">City</label>
                            <input type="text" class="form-control" placeholder="Enter city">
                        </div>

                        <div class="col-md-6">
                            <label class="profile-form-label">State</label>
                            <input type="text" class="form-control" placeholder="Enter state">
                        </div>
                    </div>

                </form>
            </div>

            <!-- STORE CHARGES SECTION -->
            <div class="custom-tab-card">
                <h1>Store Charges</h1>

                <form>
                    <div class="row mb-3 mt-5">

                        <div class="col-12 col-md-6 mb-3">
                            <label class="profile-form-label">Delivery Charges</label>
                            <input type="text" class="form-control" placeholder="Enter delivery charges">
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label class="profile-form-label">GST Tax</label>
                            <input type="text" class="form-control" placeholder="Enter GST tax">
                        </div>

                    </div>
                </form>
            </div>

            <!-- UPDATE BUTTON -->
            <div class="mt-4">
                <button type="submit" class="tf-button btn w-auto">Update</button>
            </div>

        </div>
    </div>
</div>

@endsection
