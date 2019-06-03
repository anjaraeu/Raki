@extends('errors::minimal')

@section('title', __('errors.500.err'))
@section('code', '500')
@section('message', __('errors.500.err'))

@section('additional')
@if(app()->bound('sentry') && app('sentry')->getLastEventId())
    <!-- Sentry error tracking -->
    <script src="{{ mix('js/manifest.js') }}" defer></script>
    <script src="{{ mix('js/err.js') }}" defer></script>
    <script>
        window.onload = function() {
            Sentry.showReportDialog({ eventId: '{{ app('sentry')->getLastEventId() }}' });
        };
    </script>
@endif
@endsection
