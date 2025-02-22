@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4">Welcome to MyHealthQR</h1>
    <p class="lead mt-3">
        Manage your health information securely and access it anytime with a simple QR code.
    </p>

    <div class="mt-4">
        <a href="{{ route('login.form') }}" class="btn btn-primary btn-lg me-2">Login</a>
        <a href="{{ route('register.form') }}" class="btn btn-success btn-lg">Register</a>
    </div>

    <hr class="my-5">

    <section class="text-start">
        <h3>Why MyHealthQR?</h3>
        <ul class="list-unstyled">
            <li>✅ Quick access to medical information during emergencies</li>
            <li>✅ Secure storage of personal health data</li>
            <li>✅ Easy-to-use QR code for health records</li>
        </ul>
    </section>
</div>
@endsection
