@extends('layouts.admin')

@section('title', 'Tabel Laporan Benturan')

@section('content')

<header>
    <h1>Tabel Laporan Benturan</h1>
</header>
<hr class="header-line">

<!-- Panggil komponen search section -->
<x-search_section />

<!-- Panggil komponen data table -->
<x-benturan_table :data="$data" />

<!-- Panggil komponen pagination -->
<x-pagination :paginator="$data" />


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
