@extends('layouts.organizer')

@section('title', 'Espace organisateur - EventOra')

@section('content')
    <div class="organizer-panels">
        @include('organizer.pages.overview')
        @include('organizer.pages.events')
        @include('organizer.pages.reservations')
        @include('organizer.pages.participants')
        @include('organizer.pages.payments')
        @include('organizer.pages.statistics')
         @include('organizer.pages.calendrier')
        @include('organizer.pages.settings')
    </div>
@endsection
