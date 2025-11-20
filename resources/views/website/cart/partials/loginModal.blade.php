<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="max-width: 450px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <input type="hidden" name="remember" value="1">
                    <button type="submit" class="btn btn-dark w-auto" id="loginBtn">
                        <span class="login-text">Login</span>
                        <span class="loading-text d-none">
                            <i class="fi-rr-spinner spinner me-2"></i> Logging in...
                        </span>
                    </button>
                </form>
                <div class="text-center mt-3">
                    <p class="mb-0">Don't have an account?
                        <a href="{{ route('register') }}" class="text-dark">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
