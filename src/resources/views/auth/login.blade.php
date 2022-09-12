@extends('auth.index')

@section('form')
    <form id="frm-login">
        @csrf
        <div class="form-group mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        </div>
        <div class="input-group mb-3">
            <div>
                <button type="button" class="btn btn-primary btn-block" id="btn-signin">Sign in</button>
            </div>
        </div>
    </form>

    <p class="mb-1">
        <a href="{{ route('auth.view.signup') }}">Don't have an account? Sign up</a>
    </p>
@endsection

@section('script')
    <script>
        const messages = {
            email_required: 'Please enter your email',
            email_format: 'Wrong email format! Please enter your right email',
            password_required: 'Please enter your password'
        }
        const variable = {
            route_login: "{{ route('auth.login') }}",
            route_home: "{{ route('note.view') }}",
        }
    </script>
    <script src="{{ asset('js/login.js') }}"></script>
@endsection