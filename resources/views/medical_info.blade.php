@extends('layouts.app')

@section('content')
<h1>Edit Medical Info</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('medical.info.update') }}">
    @csrf
    <label>Allergies</label>
    <input type="text" name="allergies" value="{{ old('allergies', $medicalInfo->allergies ?? '') }}">

    <label>Conditions</label>
    <input type="text" name="conditions" value="{{ old('conditions', $medicalInfo->conditions ?? '') }}">

    <button type="submit">Save</button>
</form>
@endsection
