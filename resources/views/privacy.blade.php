@extends('layouts.app')

@section('content')
<div class="container my-10">
    <div class="max-w-4xl mx-auto bg-brandGrayDark bg-opacity-95 text-brandGrayLight p-8 rounded-lg shadow-lg border border-brandGreen">
        <h1 class="text-3xl font-bold text-brandGreen mb-4">🔒 Privacy Policy</h1>
        <p class="text-sm text-brandGrayLight mb-6">Last updated: <span class="italic">February 2025</span></p>

        <p class="mb-6">
            Your privacy is important to us. This Privacy Policy explains how <strong>MyHealthQR</strong> collects, uses, and protects your personal data.
        </p>

        <h2 class="text-xl font-semibold text-brandBlue mb-2">1. Information We Collect</h2>
        <p class="mb-6">
            We collect personal data, including name, email, date of birth, and medical information necessary for providing our services.
        </p>

        <h2 class="text-xl font-semibold text-brandBlue mb-2">2. How We Use Your Data</h2>
        <p class="mb-6">
            We use your data to personalize your experience, provide QR-based medical access, and comply with regulatory requirements such as <strong>PIPEDA</strong>.
        </p>

        <h2 class="text-xl font-semibold text-brandBlue mb-2">3. Data Protection</h2>
        <p class="mb-6">
            We use secure encryption and storage methods to protect your data against unauthorized access or disclosure.
        </p>

        <h2 class="text-xl font-semibold text-brandBlue mb-2">4. Third-Party Sharing</h2>
        <p class="mb-6">
            We do not sell or share your personal data without your consent, except where required by law.
        </p>

        <h2 class="text-xl font-semibold text-brandBlue mb-2">5. Your Rights</h2>
        <p class="mb-6">
            You can request access to your data, make corrections, or request deletion of your account information at any time.
        </p>

        <h2 class="text-xl font-semibold text-brandBlue mb-2">6. Contact Us</h2>
        <p class="mb-6">
            For privacy-related inquiries, please contact us at 
            <a href="mailto:support@myhealthqr.com" class="text-brandGreen underline hover:text-brandGreen-hover">
                support@myhealthqr.com
            </a>.
        </p>
    </div>
</div>
@endsection
