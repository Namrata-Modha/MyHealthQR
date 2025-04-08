@extends('layouts.app')

@section('content')
<div class="container">
    &nbsp;
    <!-- Flash Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white text-base px-4 py-2 rounded-md mt-4 text-center shadow-md">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-500 text-white text-base px-4 py-2 rounded-md mt-4 text-center shadow-md">
            {{ session('error') }}
        </div>
    @endif

    <!-- QR Code Section -->
    <div class="card shadow-lg p-6 mb-4 bg-brandGrayDark bg-opacity-90 rounded-lg border border-brandGreen">
        <h1 class="text-center text-xl font-bold text-brandGreen" style="margin: 20px;font-size: xx-large;">Your QR Code</h1>
        <div class="text-center">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode('https://b38d-205-211-143-56.ngrok-free.app/scan/' . $qrCode->qr_code) }}" alt="Your QR Code" width="250" style="display: inline!important"/>
            &nbsp;
        </div>
        <div class="text-center" style="margin: 5px;">
            <!-- Print Button -->
            <button onclick="printQRCode()" class="mt-2 bg-brandGreen text-white py-2 px-4 rounded-lg hover:bg-brandGreen-hover transition-transform transform hover:scale-105 duration-300">
                🖨 Print QR Code
            </button>
        </div>
    </div>

    <hr class="my-6">

    <!-- Third-Party View -->
    <div class="card shadow-lg p-6 mb-4 bg-brandGrayDark bg-opacity-90 rounded-lg border border-brandGreen">
        <h4 class="text-center text-xl font-bold text-brandGreen">👀 QR Code Scanned View (Third-Party Perspective)</h4>
        <p class="text-muted text-center">Only fields marked as <strong>"Visible"</strong> in Privacy Settings will appear here.</p>

        <div class="mt-3">
            <h5 class="text-primary text-lg">🛂 Personal Information</h5>
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
            <hr class="my-4">
            <h5 class="text-danger text-lg">💉 Medical Information</h5>

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
            <hr class="my-4">
            <h5 class="text-warning text-lg">🚑 Quick Help</h5>
            @foreach($thirdPartyView['quick_help'] as $item)
                @if(isset($item['question']) && isset($item['answer']))
                    <p><strong>{{ $item['question'] }}</strong></p>
                    <p>{{ $item['answer'] }}</p>
                @endif
            @endforeach
        @endif
    </div>

    <!-- Disclaimer & Notes -->
    <div class="alert alert-info mt-4 bg-blue-100 text-blue-700 p-4 rounded-lg">
        <p><strong>📌 Disclaimer:</strong> Fields marked as <strong>invisible</strong> will not be shown in the QR scan result.</p>
        <p><strong>📢 Note:</strong> You can manage which fields are visible in your <a href="{{ route('user.profile') }}" class="text-brandBlue hover:text-brandBlue-hover font-bold"><u>Privacy Settings</u></a>.</p>
    </div>
    &nbsp;
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
        
        // Print header and QR code
        printWindow.document.write('<h2>MyHealthQR - QR Code for {{ $thirdPartyView["first_name"] ?? "User" }}</h2>');
        printWindow.document.write('<img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode("https://b38d-205-211-143-56.ngrok-free.app/scan/". $qrCode->qr_code) }}" alt="QR Code">');
        printWindow.document.write('<p>Scan this QR code for medical information.</p>');

        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
@endsection