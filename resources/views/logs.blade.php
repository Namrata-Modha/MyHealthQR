@extends('layouts.app')
<!-- ✅ Custom Pagination Styling -->
<style>
    /* Make the pagination layout horizontal and styled */
    .pagination {
        display: flex !important;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        padding-top: 1rem;
    }
    .small.text-muted {
        width: 100%;
        text-align: center!important;
        color: #ccc;
        margin-top: 1rem;
    }


    .pagination .page-item {
        list-style: none;
    }

    .pagination .page-link {
        background-color: transparent;
        color: #28a745;
        border: 1px solid #28a745;
        border-radius: 50px;
        padding: 6px 14px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .pagination .page-link:hover {
        background-color: #28a745;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        border-color: #28a745;
    }

    /* Optional: remove extra padding from surrounding nav */
    nav[role="navigation"] {
        padding: 0;
    }
</style>

@section('content')
<div class="container my-10">
    <div class="max-w-6xl mx-auto bg-brandGrayDark bg-opacity-95 shadow-lg rounded-lg border border-brandGreen p-6">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-brandGreen">📋 Notification Logs</h2>
            <p class="text-brandGrayLight mt-2">Review access and alert history related to your QR code.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left table-auto border border-brandBorder rounded-lg overflow-hidden">
                <thead class="bg-brandBlue text-white">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Log Date & Time</th>
                        <th class="px-4 py-3">QR Code Key</th>
                        <th class="px-4 py-3">Notifications</th>
                    </tr>
                </thead>
                <tbody class="text-brandGrayLight divide-y divide-brandBorder bg-brandGrayDark">
                    @if ($logs->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center px-4 py-6 text-brandGrayLight">No logs found.</td>
                        </tr>
                    @else
                        @foreach($logs as $log)
                            <tr class="hover:bg-brandGrayMid transition duration-200">
                                <td class="px-4 py-3 text-center">
                                    {{ $logs->total() - (($logs->currentPage() - 1) * $logs->perPage()) - $loop->index }}
                                </td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($log->view_timestamp)->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-3">{{ optional($log->qrCode)->qr_code ?? 'N/A' }}</td>
                                <td class="px-4 py-3">
                                    @if($log->notifications->isNotEmpty())
                                        <span class="text-brandGreen font-medium">{{ $log->notifications->first()->notification_type }}</span>
                                    @else
                                        <span class="text-brandGrayLight italic">No Notifications</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6">
            {{ $logs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
