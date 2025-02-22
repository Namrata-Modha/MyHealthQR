@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @php
        $qrCode = \App\Models\QRCodes::where('user_id', auth()->id())->first();
    @endphp

    @if($qrCode)
        <h3>Your QR Code:</h3>
        <img src="{{ asset('qr_codes/qr_code_' . auth()->id() . '.svg') }}" alt="Your QR Code" width="300">
        <p><strong>QR Code Key:</strong> {{ $qrCode->qr_code }}</p>
    @else
        <p>No QR code generated yet.</p>
    @endif
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endsection

