<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-3">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Form -->
            <form id="addCustomerForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <!-- First Name -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerFirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="addCustomerFirstName" name="first_name" placeholder="Enter first name" required>
                            <div class="text-danger small mt-1" id="firstNameError"></div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerLastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="addCustomerLastName" name="last_name" placeholder="Enter last name" required>
                            <div class="text-danger small mt-1" id="lastNameError"></div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerEmail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="addCustomerEmail" name="email" placeholder="Enter email address" required>
                            <div class="text-danger small mt-1" id="emailError"></div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="addCustomerPhone" name="phone" placeholder="Enter phone number">
                            <div class="text-danger small mt-1" id="phoneError"></div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerPassword" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="addCustomerPassword" name="password" placeholder="Enter password" required>
                            <div class="text-danger small mt-1" id="passwordError"></div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerPasswordConfirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="addCustomerPasswordConfirmation" name="password_confirmation" placeholder="Confirm password" required>
                            <div class="text-danger small mt-1" id="passwordConfirmationError"></div>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerGender" class="form-label">Gender</label>
                            <select class="form-control" id="addCustomerGender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="text-danger small mt-1" id="genderError"></div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerDob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="addCustomerDob" name="dob">
                            <div class="text-danger small mt-1" id="dobError"></div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerCountry" class="form-label">Country</label>
                            <input type="text" class="form-control" id="addCustomerCountry" name="country" placeholder="Enter country">
                            <div class="text-danger small mt-1" id="countryError"></div>
                        </div>

                        <!-- City -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="addCustomerCity" name="city" placeholder="Enter city">
                            <div class="text-danger small mt-1" id="cityError"></div>
                        </div>

                        <!-- State -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerState" class="form-label">State/Province</label>
                            <input type="text" class="form-control" id="addCustomerState" name="state" placeholder="Enter state">
                            <div class="text-danger small mt-1" id="stateError"></div>
                        </div>

                        <!-- Postal Code -->
                        <div class="col-md-6 mb-3">
                            <label for="addCustomerPostalCode" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="addCustomerPostalCode" name="postal_code" placeholder="Enter postal code">
                            <div class="text-danger small mt-1" id="postalCodeError"></div>
                        </div>

                        <!-- Address -->
                        <div class="col-12 mb-3">
                            <label for="addCustomerAddress" class="form-label">Address</label>
                            <textarea class="form-control" id="addCustomerAddress" name="address" placeholder="Enter full address" rows="2"></textarea>
                            <div class="text-danger small mt-1" id="addressError"></div>
                        </div>

                        <!-- Profile Photo -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Profile Photo</label>
                            <div class="border rounded p-3 d-flex flex-column align-items-center justify-content-center upload-image" style="min-height:150px; cursor:pointer;">
                                <label class="d-flex flex-column align-items-center justify-content-center w-100 h-100 mb-0" for="addCustomerProfilePhoto">
                                    <i class="icon-upload-cloud fs-2 mb-2"></i>
                                    <span class="text-muted small">Drop your image here or <span class="text-primary">click to browse</span></span>
                                    <img id="addCustomerImagePreview" src="" alt="" class="img-fluid mt-2 d-none" style="max-height:120px; border-radius:4px;">
                                    <input type="file" class="d-none" id="addCustomerProfilePhoto" name="profile_photo" accept="image/*">
                                </label>
                            </div>
                            <div class="text-danger small mt-1" id="profilePhotoError"></div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="tf-button style-1 w208" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="tf-button style-1 w208 d-flex align-items-center" id="addCustomerBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none"></span>
                        Add Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS to preview image -->
<script>
    document.getElementById('addCustomerProfilePhoto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('addCustomerImagePreview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.src = '';
            preview.classList.add('d-none');
        }
    });
</script>
