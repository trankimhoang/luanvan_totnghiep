@extends('layouts.master_admin_login')

@section('content')
    <form action="{{ route('admin.forget.password.post') }}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="email_address" class="col-md-4 col-form-label text-md-right">Email</label>
            <div class="col-md-6">
                <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Lấy lại mật khẩu
            </button>
        </div>
    </form>
@endsection
