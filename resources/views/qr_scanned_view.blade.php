@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">🔍 MyHealthQR</h1>

    <div class="alert alert-info">
        <p>📌 <strong>Note:</strong> The following details are displayed based on the user's privacy settings.</p>
    </div>

    <div class="card p-4">
        <h4 class="text-primary"><i class="fas fa-user"></i> Personal Information</h4>
        <p><strong>Name:</strong> {{ $thirdPartyView['first_name'] ?? 'N/A' }} {{ $thirdPartyView['last_name'] ?? 'N/A' }}</p>

        @if(isset($thirdPartyView['contact_phone']))
            <p><strong>Contact Phone:</strong> {{ $thirdPartyView['contact_phone'] }}</p>
        @endif

        @if(isset($thirdPartyView['emergency_contact_name']))
            <p><strong>Emergency Contact Name:</strong> {{ $thirdPartyView['emergency_contact_name'] }}</p>
        @endif

        @if(isset($thirdPartyView['emergency_contact_phone']))
            <p><strong>Emergency Contact Phone:</strong> {{ $thirdPartyView['emergency_contact_phone'] }}</p>
        @endif

        @if(isset($thirdPartyView['has_insurance']))
            <p><strong>Has Insurance:</strong> {{ $thirdPartyView['has_insurance'] }}</p>
        @endif

        @if(isset($thirdPartyView['allergies']) || isset($thirdPartyView['conditions']) || isset($thirdPartyView['medications']))
            <h4 class="text-danger"><i class="fas fa-notes-medical"></i> Medical Information</h4>
            @if(isset($thirdPartyView['allergies']))
                <p><strong>Allergies:</strong> {{ $thirdPartyView['allergies'] }}</p>
            @endif
            @if(isset($thirdPartyView['conditions']))
                <p><strong>Chronic Conditions:</strong> {{ $thirdPartyView['conditions'] }}</p>
            @endif
            @if(isset($thirdPartyView['medications']))
                <p><strong>Medications:</strong> {{ $thirdPartyView['medications'] }}</p>
            @endif
        @endif

        @if(isset($thirdPartyView['quick_help_enabled']) && isset($thirdPartyView['quick_help']) && count($thirdPartyView['quick_help']) > 0)
            <h4 class="text-success"><i class="fas fa-ambulance"></i> Quick Help</h4>
            @foreach($thirdPartyView['quick_help'] as $item)
                @if(isset($item['question']) && isset($item['answer']))
                    <p><strong>{{ $item['question'] }}</strong></p>
                    <p>{{ $item['answer'] }}</p>
                @endif
            @endforeach
        @endif
    </div>
</div>
@endsection
