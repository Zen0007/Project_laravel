@extends('admin.admin')

@section('title', 'dashboard — dev.log')

@section('content')
    {{-- Memuat komponen utama table data, statistik, dan modal admin --}}
    @include("admin.articles.home")
@endsection

{{-- Dorong skrip ini ke tumpukan @stack('scripts') di file layout.admin --}}
@push('scripts')
    @vite(['resources/js/admin-dashboard.js'])
@endpush