@extends('layout.main')
@section('title', 'Планировщик записей')

@section('content')
    <div class="card">
        <div class="card-header">Календарь</div>
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>
@endsection
@extends('events.modals.create')
@extends('events.modals.edit')
@extends('events.modals.error')
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.6.0/locales-all.min.js"></script>
    <script src="{{ asset('js/events.js') }}"></script>
@endpush
