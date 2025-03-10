    
@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Notification Logs</h2>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Log Date & Time</th>
                <th>QR Code Key</th>
                <th>Notifications</th>
            </tr>
        </thead>
        <tbody>
            @if ($logs->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">No logs found.</td>
                </tr>
            @else
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $loop->iteration + ($logs->currentPage() - 1) * $logs->perPage() }}</td>
                        <td> {{ \Carbon\Carbon::parse($log->view_timestamp)->format('Y-m-d H:i') }}</td>
                        <td>{{ optional($log->qrCode)->qr_code ?? 'N/A' }}</td>
                        <td>
                            @if($log->notifications->isNotEmpty())
                                {{ $log->notifications->first()->notification_type }}
                            @else
                                No Notifications
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="mt-3">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
