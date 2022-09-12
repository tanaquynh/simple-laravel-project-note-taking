@extends('auth.index')

@section('form')
    <form id="frm-signup">
        @csrf
        <div class="form-group mb-3">
            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
        </div>
        <div class="form-group mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group mb-3">
            <input type="password" name="password_confirmation" id="password_confirm" class="form-control" placeholder="Password Confirmation">
        </div>
        <div class="input-group mb-3">
            <div>
                <button type="button" class="btn btn-primary btn-block" id="btn-signup">Sign up</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        const messages = {
            name_required: 'Please enter your name',
            email_required: 'Please enter your email',
            email_format: 'Wrong email format! Please enter your right email',
            password_required: 'Please enter your password',
            password_confirmation_required: 'Please enter password again to confirm your password',
            password_confirmation_not_match: 'Your password confirmation not match! Try agian'
        }
        const variable = {
            route_login: "{{ route('auth.login') }}",
            route_home: "{{ route('note.view') }}",
            route_signup: "{{ route('auth.register') }}"
        }
    </script>
    <script src="{{ asset('js/register.js') }}"></script>
@endsection