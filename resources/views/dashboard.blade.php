@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- QR Code Section -->
    <div class="card shadow p-4">
        <h3 class="text-center">Your QR Code</h3>
        <div class="text-center">
            {{-- <img src="{{ asset('qr_codes/qr_code_' . auth()->id() . '.svg') }}" alt="Your QR Code" width="250"> --}}
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode(' https://3aff-205-211-143-203.ngrok-free.app/scan/' . $qrCode->qr_code) }}" alt="Your QR Code">
            
            <!-- Print Button -->
            <button onclick="printQRCode()" class="btn btn-primary mt-2">
                🖨️ Print QR Code
            </button>
        </div>
    </div>

    <hr>

    <!-- Third-Party View -->
    <div class="card shadow p-4 mt-4">
        <h4 class="text-center">👀 QR Code Scanned View (Third-Party Perspective)</h4>
        <p class="text-muted text-center">Only fields marked as <strong>"Visible"</strong> in Privacy Settings will appear here.</p>

        <div class="mt-3">
            <h5 class="text-primary">🛂 Personal Information</h5>
            <p><strong>Name:</strong> {{ $thirdPartyView['first_name'] ?? 'N/A' }} {{ $thirdPartyView['last_name'] ?? 'N/A' }}</p>

            @if(isset($thirdPartyView['contact_phone']))
                <p><strong>📞 Contact Phone:</strong> {{ $thirdPartyView['contact_phone'] }}</p>
            @endif

            @if(isset($thirdPartyView['emergency_contact_name']))
                <p><strong>🚨 Emergency Contact Name:</strong> {{ $thirdPartyView['emergency_contact_name'] }}</p>
            @endif

            @if(isset($thirdPartyView['emergency_contact_phone']))
                <p><strong>📱 Emergency Contact Phone:</strong> {{ $thirdPartyView['emergency_contact_phone'] }}</p>
            @endif

            @if(isset($thirdPartyView['has_insurance']))
                <p><strong>🩺 Has Insurance:</strong> {{ $thirdPartyView['has_insurance'] }}</p>
            @endif
        </div>

        @if(isset($thirdPartyView['allergies']) || isset($thirdPartyView['conditions']) || isset($thirdPartyView['medications']))
            <hr>
            <h5 class="text-danger">💉 Medical Information</h5>

            @if(isset($thirdPartyView['allergies']))
                <p><strong>🤧 Allergies:</strong> {{ $thirdPartyView['allergies'] }}</p>
            @endif

            @if(isset($thirdPartyView['conditions']))
                <p><strong>🏥 Chronic Conditions:</strong> {{ $thirdPartyView['conditions'] }}</p>
            @endif

            @if(isset($thirdPartyView['medications']))
                <p><strong>💊 Medications:</strong> {{ $thirdPartyView['medications'] }}</p>
            @endif
        @endif

        @if(isset($thirdPartyView['quick_help_enabled']) && isset($thirdPartyView['quick_help']) && count($thirdPartyView['quick_help']) > 0)
            <hr>
            <h5 class="text-warning">🚑 Quick Help</h5>
            @foreach($thirdPartyView['quick_help'] as $item)
                @if(isset($item['question']) && isset($item['answer']))
                    <p><strong>{{ $item['question'] }}</strong></p>
                    <p>{{ $item['answer'] }}</p>
                @endif
            @endforeach
        @endif
    </div>

    <!-- Disclaimer & Notes -->
    <div class="alert alert-info mt-4">
        <p><strong>📌 Disclaimer:</strong> Fields marked as <strong>invisible</strong> will not be shown in the QR scan result.</p>
        <p><strong>📢 Note:</strong> You can manage which fields are visible in your <a href="{{ route('user.profile') }}">Privacy Settings</a>.</p>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 10px;
    }
</style>
@endsection

@section('scripts')
<script>
    function printQRCode() {
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print QR Code</title><style>');
        printWindow.document.write('body { text-align: center; font-family: Arial, sans-serif; }');
        printWindow.document.write('h2 { margin-bottom: 10px; }');
        printWindow.document.write('img { width: 300px; height: 300px; margin: 10px auto; display: block; }');
        printWindow.document.write('</style></head><body>');

        // Add First Name
        printWindow.document.write('<h2>MyHealthQR - QR Code for {{ $thirdPartyView["first_name"] ?? "User" }}</h2>');
        
        // Add QR Code
        printWindow.document.write('<img src="{{ asset("qr_codes/qr_code_" . auth()->id() . ".svg") }}" alt="QR Code">');
        printWindow.document.write('<p>Scan this QR code for medical information.</p>');

        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
@endsection

