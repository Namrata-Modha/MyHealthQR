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

</div>
@endsection
