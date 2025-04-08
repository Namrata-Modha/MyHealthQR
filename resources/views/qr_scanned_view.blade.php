<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>QR Scan Result | MyHealthQR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: url('{{ asset('images/hero-bg.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
      font-size: 1.25rem;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.7);
      min-height: 100vh;
      padding-top: 30px;
    }

    .label-text {
      color: #28a745;
      font-weight: 600;
    }

    .section-title {
      color: #28a745;
      font-weight: 700;
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }

    .quick-help-answer {
      font-style: italic;
      border-left: 4px solid #00FFAD;
      padding-left: 1rem;
      color: white;
    }

    .card-custom {
      background-color: rgba(255, 255, 255, 0.05);
      border: 2px solid rgb(68, 202, 99);
      border-radius: 10px;
      margin-bottom: 1.5rem;
      padding: 1.5rem;
    }
  </style>
</head>

<body>
  <div class="overlay container">
    <!-- Header -->
    <div class="text-center mb-4">
    <h1 class="section-title d-flex align-items-center justify-content-center fs-1 fw-bold">
        <img src="{{ asset('images/logo.png') }}" alt="MyHealthQR Logo" class="me-2" style="height: 32px; width: 32px; border-radius: 50%;">
        MyHealthQR Scan Result
    </h1>

      <p class="text-light fst-italic fs-6">Note: Displayed based on the user's privacy settings.</p>
    </div>

    <!-- Personal Info -->
    <div class="card-custom">
      <div class="section-title text-primary"><i class="fas fa-user me-2"></i>Personal Information</div>
      <p><span class="label-text">😊 Name:</span> <span class="text-white">{{ $thirdPartyView['first_name'] ?? 'N/A' }} {{ $thirdPartyView['last_name'] ?? 'N/A' }}</span></p>

      @if(isset($thirdPartyView['contact_phone']))
      <p><span class="label-text">📞 Contact Phone:</span> <span class="text-white">{{ $thirdPartyView['contact_phone'] }}</span></p>
      @endif

      @if(isset($thirdPartyView['emergency_contact_name']))
      <p><span class="label-text">🚨 Emergency Contact:</span> <span class="text-white">{{ $thirdPartyView['emergency_contact_name'] }}</span></p>
      @endif

      @if(isset($thirdPartyView['emergency_contact_phone']))
      <p><span class="label-text">📱 Emergency Contact Phone:</span> <span class="text-white">{{ $thirdPartyView['emergency_contact_phone'] }}</span></p>
      @endif

      @if(isset($thirdPartyView['has_insurance']))
      <p><span class="label-text">🩺 Has Insurance:</span> <span class="text-white">{{ $thirdPartyView['has_insurance'] === 'yes' ? 'Yes' : 'No' }}</span></p>
      @endif
    </div>

    <!-- Medical Info -->
    @if(isset($thirdPartyView['allergies']) || isset($thirdPartyView['conditions']) || isset($thirdPartyView['medications']))
    <div class="card-custom">
      <div class="section-title text-primary"><i class="fas fa-notes-medical me-2"></i>Medical Information</div>
      @if(isset($thirdPartyView['allergies']))
      <p><span class="label-text">🤧 Allergies:</span> <span class="text-white">{{ $thirdPartyView['allergies'] }}</span></p>
      @endif
      @if(isset($thirdPartyView['conditions']))
      <p><span class="label-text">🏥 Chronic Conditions:</span> <span class="text-white">{{ $thirdPartyView['conditions'] }}</span></p>
      @endif
      @if(isset($thirdPartyView['medications']))
      <p><span class="label-text">💊 Medications:</span> <span class="text-white">{{ $thirdPartyView['medications'] }}</span></p>
      @endif
    </div>
    @endif

    <!-- Quick Help -->
    @if(isset($thirdPartyView['quick_help_enabled']) && isset($thirdPartyView['quick_help']) && count($thirdPartyView['quick_help']) > 0)
    <div class="card-custom">
      <div class="section-title text-primary"><i class="fas fa-ambulance me-2"></i>Quick Help</div>
      @foreach($thirdPartyView['quick_help'] as $item)
      @if(isset($item['question']) && isset($item['answer']))
      <div class="mb-3">
        <p class="label-text"> ⛑ {{ $item['question'] }}</p>
        <p class="quick-help-answer">{{ $item['answer'] }}</p>
      </div>
      @endif
      @endforeach
    </div>
    @endif

    <!-- Footer -->
    <footer class="text-center mt-5 text-muted fs-6">
      <small>© {{ date('Y') }} MyHealthQR</small>
    </footer>
  </div>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
