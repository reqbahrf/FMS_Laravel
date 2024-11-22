<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.scss')
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">
    <title>Change Password</title>
</head>
<body>
    <x-header />
    <div class="container d-flex justify-content-center align-items-center" style="height: 70vh">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg rounded">
                    <div class="card-header bg-primary text-white text-center font-weight-bold">
                        {{ __('Change Password') }}
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
    
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="current_password" class="col-form-label text-md-right">{{ __('Current Password') }}</label>
                                <div class="col-md-8 input-group">
                                    <input id="current_password" type="password"
                                           class="form-control @error('current_password') is-invalid @enderror"
                                           name="current_password" placeholder="Enter current password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ri-lock-line"></i></span>
                                    </div>
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="new_password" class="col-form-label text-md-right">{{ __('New Password') }}</label>
                                <div class="col-md-8 input-group">
                                    <input id="new_password" type="password" 
                                           class="form-control @error('new_password') is-invalid @enderror"
                                           name="new_password" placeholder="Enter new password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ri-key-line"></i></span>
                                    </div>
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="new_password_confirmation" class="col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
                                <div class="col-md-8 input-group">
                                    <input id="new_password_confirmation" type="password" 
                                           class="form-control" name="new_password_confirmation"
                                           placeholder="Confirm new password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ri-checkbox-circle-line"></i></span>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0 mt-3">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                        {{ __('Change Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <x-footer />
</body>
</html>

