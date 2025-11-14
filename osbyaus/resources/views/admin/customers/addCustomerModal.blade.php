<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-3">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Form -->
            <form id="editCustomerForm" enctype="multipart/form-data">
                <input type="hidden" id="editCustomerId" name="id">

                <div class="modal-body">
                    <div class="row">
                        <!-- First Name -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerFirstName" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editCustomerFirstName" name="first_name" placeholder="Enter first name" required>
                            <div class="text-danger small mt-1" id="editFirstNameError"></div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerLastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editCustomerLastName" name="last_name" placeholder="Enter last name" required>
                            <div class="text-danger small mt-1" id="editLastNameError"></div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerEmail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="editCustomerEmail" name="email" placeholder="Enter email address" required>
                            <div class="text-danger small mt-1" id="editEmailError"></div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="editCustomerPhone" name="phone" placeholder="Enter phone number">
                            <div class="text-danger small mt-1" id="editPhoneError"></div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="editCustomerPassword" name="password" placeholder="Leave blank to keep current">
                            <div class="text-danger small mt-1" id="editPasswordError"></div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerPasswordConfirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="editCustomerPasswordConfirmation" name="password_confirmation" placeholder="Confirm new password">
                            <div class="text-danger small mt-1" id="editPasswordConfirmationError"></div>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerGender" class="form-label">Gender</label>
                            <select class="form-control" id="editCustomerGender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <div class="text-danger small mt-1" id="editGenderError"></div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerDob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="editCustomerDob" name="dob">
                            <div class="text-danger small mt-1" id="editDobError"></div>
                        </div>

                        <!-- Country -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerCountry" class="form-label">Country</label>
                            <input type="text" class="form-control" id="editCustomerCountry" name="country" placeholder="Enter country">
                            <div class="text-danger small mt-1" id="editCountryError"></div>
                        </div>

                        <!-- City -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="editCustomerCity" name="city" placeholder="Enter city">
                            <div class="text-danger small mt-1" id="editCityError"></div>
                        </div>

                        <!-- State -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerState" class="form-label">State/Province</label>
                            <input type="text" class="form-control" id="editCustomerState" name="state" placeholder="Enter state">
                            <div class="text-danger small mt-1" id="editStateError"></div>
                        </div>

                        <!-- Postal Code -->
                        <div class="col-md-6 mb-3">
                            <label for="editCustomerPostalCode" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="editCustomerPostalCode" name="postal_code" placeholder="Enter postal code">
                            <div class="text-danger small mt-1" id="editPostalCodeError"></div>
                        </div>

                        <!-- Address -->
                        <div class="col-12 mb-3">
                            <label for="editCustomerAddress" class="form-label">Address</label>
                            <textarea class="form-control" id="editCustomerAddress" name="address" placeholder="Enter full address" rows="2"></textarea>
                            <div class="text-danger small mt-1" id="editAddressError"></div>
                        </div>

                        <!-- Profile Photo -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Profile Photo</label>
                            <div class="border rounded p-3 d-flex flex-column align-items-center justify-content-center upload-image" style="min-height:150px; cursor:pointer;">
                                <label class="d-flex flex-column align-items-center justify-content-center w-100 h-100 mb-0" for="editCustomerProfilePhoto">
                                    <i class="icon-upload-cloud fs-2 mb-2"></i>
                                    <span class="text-muted small">Drop your image here or <span class="text-primary">click to browse</span></span>
                                    <img id="editCustomerImagePreview" src="" alt="" class="img-fluid mt-2 d-none" style="max-height:120px; border-radius:4px;">
                                    <input type="file" class="d-none" id="editCustomerProfilePhoto" name="profile_photo" accept="image/*">
                                </label>
                            </div>
                            <div class="text-danger small mt-1" id="editProfilePhotoError"></div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="tf-button style-1 w208" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="tf-button style-1 w208 d-flex align-items-center" id="editCustomerBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none"></span>
                        Update Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS to preview image -->
<script>
    document.getElementById('editCustomerProfilePhoto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('editCustomerImagePreview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.src = '';
            preview.classList.add('d-none');
        }
    });
</script>
