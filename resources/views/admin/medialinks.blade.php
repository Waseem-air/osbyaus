@extends("admin.layout.main")
@section('content')

<style>
.custom-card {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
}

.profile-form-label {
    font-size: 14px;
    font-weight: 700;
    color: #000;
    margin-bottom: 10px;
}

.form-control {
    padding: 12px 15px;
    border-radius: 8px;
    background-color: #EEEEEE;
    border: 1px solid #ced4da;
}
</style>



<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

            <h1>Social Media Links</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="custom-card mt-4">
                <form method="POST" action="{{ route('admin.social-media.store') }}">
                    @csrf

                    <div class="row">

                        <!-- Instagram -->
                        <div class="col-12 mb-3">
                            <label class="profile-form-label">Instagram</label>
                            <input type="text" class="form-control" name="instagram" 
                                   placeholder="Enter Instagram Link" 
                                   value="{{ old('instagram', $socialLinks->instagram ?? '') }}">
                        </div>

                        <!-- Facebook -->
                        <div class="col-12 mb-3">
                            <label class="profile-form-label">Facebook</label>
                            <input type="text" class="form-control" name="facebook" 
                                   placeholder="Enter Facebook Link" 
                                   value="{{ old('facebook', $socialLinks->facebook ?? '') }}">
                        </div>

                        <!-- Pinterest -->
                        <div class="col-12 mb-3">
                            <label class="profile-form-label">Pinterest</label>
                            <input type="text" class="form-control" name="pinterest" 
                                   placeholder="Enter Pinterest Link" 
                                   value="{{ old('pinterest', $socialLinks->pinterest ?? '') }}">
                        </div>

                        <!-- TikTok -->
                        <div class="col-12 mb-3">
                            <label class="profile-form-label">TikTok</label>
                            <input type="text" class="form-control" name="tiktok" 
                                   placeholder="Enter TikTok Link" 
                                   value="{{ old('tiktok', $socialLinks->tiktok ?? '') }}">
                        </div>

                    </div>
                
                    <button type="submit" class="tf-button btn w-auto mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
