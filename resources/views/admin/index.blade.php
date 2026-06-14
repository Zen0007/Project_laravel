@extends('layout.app')

@section('title', 'dashboard — dev.log')

@section('content')
     @include("admin.articles.home")
@endsection

{{-- Dorong skrip ini ke tumpukan @stack('scripts') di file layout utama --}}
@push('scripts')
    {{-- Ganti asset() dengan @vite() --}}
    @vite(['resources/js/admin-dashboard.js'])
@endpush