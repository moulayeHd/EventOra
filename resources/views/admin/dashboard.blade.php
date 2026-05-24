@extends('layouts.admin')

@section('title', 'Administration - EventOra')

@section('content')
    <div class="admin-panels">
        @include('admin.pages.overview')
        @include('admin.pages.users')
        @include('admin.pages.events')
        @include('admin.pages.settings')
    </div>
@endsection
