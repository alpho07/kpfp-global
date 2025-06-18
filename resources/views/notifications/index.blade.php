@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">📬 Notifications</h3>
            <small class="text-muted">Stay updated with system alerts and activity</small>
        </div>
        <div>
            <a href="{{ url('admin') }}" class="btn btn-sm btn-outline-secondary mr-2">
                ← Back to Dashboard
            </a>
            <button id="markAllReadBtn" class="btn btn-sm btn-outline-primary">
                Mark All as Read
            </button>
        </div>
    </div>

    <div id="notificationsList">
        @forelse($notifications as $notification)
            @php
                $type = $notification->data['type'] ?? 'info';
                $icon = match ($type) {
                    'success' => '✅',
                    'error' => '❌',
                    'warning' => '⚠️',
                    'application' => '📝',
                    default => 'ℹ️',
                };
            @endphp

            <div class="card mb-3 notification-item {{ $notification->read_at ? '' : 'bg-light' }}"
                data-id="{{ $notification->id }}"
                data-url="{{ $notification->data['url'] ?? '' }}"
                style="cursor: pointer;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-start">
                        <div class="mr-3" style="font-size: 1.5rem;">{{ $icon }}</div>
                        <div>
                            <strong class="d-block">{{ $notification->data['message'] ?? 'System Notification' }}</strong>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @if(!$notification->read_at)
                        <span class="badge badge-pill badge-primary">New</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                🎉 You’re all caught up! No notifications right now.
            </div>
        @endforelse
    </div>

    @if($notifications->hasPages())
        <div class="mt-4">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $('.notification-item').on('click', function () {
            const notifId = $(this).data('id');
            const notifUrl = $(this).data('url');

            $.post(`/notifications/${notifId}/mark-read`, function () {
                $(`[data-id="${notifId}"]`).removeClass('bg-light').find('.badge').remove();
                if (notifUrl) {
                    window.location.href = notifUrl;
                }
            }).fail(function () {
                alert('Failed to mark as read.');
            });
        });

        $('#markAllReadBtn').on('click', function () {
            $.post(`/notifications/mark-all-read`, function () {
                $('.notification-item').removeClass('bg-light').find('.badge').remove();
            }).fail(function () {
                alert('Failed to mark all as read.');
            });
        });
    });
</script>
@endsection
