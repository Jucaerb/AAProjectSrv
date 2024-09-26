<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @if($errors->has('name'))
                <div class="text-danger mt-1">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="username">
            @if($errors->has('email'))
                <div class="text-danger mt-1">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
            @if($errors->has('password'))
                <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            @if($errors->has('password_confirmation'))
                <div class="text-danger mt-1">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a class="text-decoration-none text-muted" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="btn btn-primary ms-3">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
