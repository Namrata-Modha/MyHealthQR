# MyHealthQR

**First place, Fanshawe College BISA Capstone Showcase (2025)**

MyHealthQR gives every patient a personal QR code linked to the medical information they choose to share. In an emergency, a first responder or healthcare provider scans the code and sees what they need right away: allergies, conditions, medications and emergency contacts. Built by a six-person capstone team using test data only, never real patient data.

**My role:** Technical lead and developer. I set up the PostgreSQL database, built the backend for registration, QR code scanning and patient profiles, connected the Laravel models to PostgreSQL, and implemented the consent and security pieces for PIPEDA compliance. I also worked with our frontend developer to connect the UI to the backend, and presented our work at all four milestone reviews.

## What it does

- **QR code access:** each patient gets a unique QR code. Scanning it opens a page with the medical details they chose to make visible.
- **Patient profiles:** patients create and update their personal and medical information, and control what is shown.
- **Accounts and security:** registration with email verification, login, password reset and role-based permissions.
- **Quick Help:** patients can enable a quick-help option so someone helping them in an emergency can get key answers fast.
- **Activity log:** account activity is recorded, giving an audit trail.
- **Privacy:** PIPEDA consent and guardian consent fields, privacy settings for what is shown, plus a privacy policy and terms of service.

## Tech stack

- **Backend:** Laravel 11 (PHP 8.2)
- **Database:** PostgreSQL
- **Frontend:** Blade templates, Tailwind CSS, JavaScript
- **QR codes:** bacon/bacon-qr-code

## How we built it

- Four milestones from December 2024 to April 2025, each planned around an MVP we could demo to a review panel.
- Weekly stand-ups, with work tracked in ClickUp and Microsoft Project.
- Technical decisions explained on a whiteboard in plain language, down to why each table and field exists, because most of the team came from a business background.
- Scope kept to what we could deliver: an AI chatbot was proposed and moved to the nice-to-have list so the core features shipped on time.
