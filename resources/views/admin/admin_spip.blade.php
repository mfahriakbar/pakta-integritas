@extends('layouts.admin')

@section('title', 'Tabel SPI-P')

@section('content')
<header>
    <h1>Tabel Dokumen SPI-P</h1>
</header>
<hr class="header-line">

<!-- Search Section -->
<x-search_section />

<!-- Panggil komponen lapor table -->
<x-spip_table :data="$data"/>

<!-- Panggil komponen pagination -->
<x-pagination :paginator="$data" />


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('script/script-admin.js') }}"></script>
@endsection