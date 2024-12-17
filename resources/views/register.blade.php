<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotek Atma Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f2f2e9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .full-screen {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-between;
        }

        .login-section {
            background-color: #f2f2e9;
            padding: 40px;
            flex: 3;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-section {
            background-color: #8da089;
            color: #fff;
            padding: 40px;
            flex: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            width: 50%;
            position: relative;
        }

        .info-section h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .info-section p {
            font-size: 16px;
            margin-bottom: 30px;
        }

        .info-section .btn {
            background-color: transparent;
            border-color: #fff;
            color: #fff;
            border-radius: 20px;
            padding: 10px 30px;
        }

        .info-section .btn:hover {
            background-color: #fff;
            color: #8da089;
        }

        .info-section span {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px;
        }

        .info-section img {
            width: 150px;
            height: auto;
        }

        .form-control {
            border-radius: 5px;
        }

        .social-icons a {
            font-size: 24px;
            color: #000;
            margin-right: 15px;
            background-color: #bed2b9;
            height: 150px;
            width: 15px;
            padding: 10px;
            border-radius: 50%;
        }

        .social-icons a:hover {
            color: #6f866b;
        }

        .sign-in-btn {
            background-color: #8da089;
            color: #fff;
            border-radius: 5px;
            padding: 10px;
        }

        .sign-in-btn:hover {
            background-color: #7a8f73;
        }

        .form-login {
            max-width: 50%;
        }
    </style>
</head>

<body>
    <div class="full-screen">
        <div class="info-section">
            <span class="d-flex align-items-start"><img src="{{ asset('images/white-logo.png') }}"
                    alt=""></span>
            <h1><strong>Welcome Back!</strong></h1>
            <p>Stay connected with us,</p>
            <p style="margin-top:-30px;">please log in using your personal info.</p>
            <a href="/login" class="btn btn-outline-light">SIGN IN</a>
        </div>
        <div class="login-section">
            <h1 class="mb-4 text-center" style="color:#768A6E;"><strong>Create Account</strong></h1>
            <div class="social-icons mb-3 text-center">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-google"></i></a>
                <a href="#"><i class="bi bi-telephone"></i></a>
            </div>
            <p class="mt-4 mb-4 text-center">Or use Your Email Account</p>
            <form method="POST" action="{{ route('register') }}" class="text-center">
                @csrf

                <div class="row">
                    <div class="mb-3 d-flex justify-content-center">
                        <div class="form-login input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Name" required value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="invalid-feedback" id="nameError"></div>
                    </div>
                    <!-- Email Field -->
                    <div class="mb-3 d-flex justify-content-center">
                        <div class="form-login input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="invalid-feedback" id="emailError"></div>
                    </div>


                    <!-- Phone Number Field -->

                    <div class="mb-3 d-flex justify-content-center">
                        <div class="form-login input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-telephone"></i>
                            </span>

                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                id="phone_number" name="phone_number" placeholder="Phone Number"
                                value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="invalid-feedback" id="phoneError"></div>
                    </div>


                    <!-- Address Field -->

                    <div class="mb-3 d-flex justify-content-center">
                        <div class="form-login input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-geo-alt"></i>
                            </span>

                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                id="address" name="address" placeholder="Address" value="{{ old('address') }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="invalid-feedback" id="addressError"></div>
                    </div>

                    <!-- Password Fields -->

                    <div class="mb-3 d-flex justify-content-center">
                        <div class="form-login input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-lock"></i>
                            </span>

                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Password" required>
                            <span class="input-group-text bg-light cursor-pointer" onclick="togglePassword('password')">
                                <i class="bi bi-eye" id="passwordToggleIcon"></i>

                            </span>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="invalid-feedback" id="passwordError"></div>
                    </div>

                    <div class="mb-3 d-flex justify-content-center">
                        <div class="form-login input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-lock"></i>
                            </span>

                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Confirm Password" required>
                            <span class="input-group-text bg-light cursor-pointer"
                                onclick="togglePassword('password_confirmation')">
                                <i class="bi bi-eye" id="confirmPasswordToggleIcon"></i>

                            </span>
                        </div>
                        <div class="invalid-feedback" id="passwordConfirmError"></div>
                    </div>
                </div>


                <button type="submit" class="btn sign-in-btn rounded-pill" style="width: 17%;">SIGN UP</button>

            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId === 'password' ? 'passwordToggleIcon' :
                'confirmPasswordToggleIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</body>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(inputId === 'password' ? 'passwordToggleIcon' :
            'confirmPasswordToggleIcon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }

    function clearErrors() {
        const errorElements = document.querySelectorAll('.invalid-feedback');
        errorElements.forEach(element => {
            element.textContent = '';
            element.style.display = 'none';
        });

        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
        });
    }

    function showError(field, message) {
        const errorElement = document.getElementById(field + 'Error');
        const input = document.getElementById(field);

        if (errorElement && input) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
            input.classList.add('is-invalid');
        }
    }

    async function handleRegister(event) {
        event.preventDefault();
        clearErrors();

        const spinner = document.getElementById('loadingSpinner');
        const submitButton = document.getElementById('submitButton');
        spinner.classList.remove('d-none');
        submitButton.disabled = true;

        const formData = new FormData(event.target);

        try {
            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                if (response.status === 422) {
                    Object.keys(data.errors).forEach(field => {
                        showError(field, data.errors[field][0]);
                    });
                } else {
                    alert(data.message || 'Registration failed. Please try again.');
                }
            } else {
                // Success
                localStorage.setItem('auth_token', data.token);
                alert('Registration successful!');
                window.location.href = '/login';
            }
        } catch (error) {
            console.error('Registration error:', error);
            alert('An error occurred during registration. Please try again.');
        } finally {
            spinner.classList.add('d-none');
            submitButton.disabled = false;
        }
    }
</script>

</html>
