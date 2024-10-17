@extends('layouts.admin')

@section('title', 'Tabel Penyedia Jasa')

@section('content')

<header>
    <h1>Tabel Formulir Uji Kelayakan Penyedia Jasa</h1>
</header>
<hr class="header-line">

<!-- Panggil komponen search section -->
<x-search_section />

<!-- Panggil komponen data table -->
<x-penyedia_jasa :data="$data" />

<!-- Panggil komponen pagination -->
<x-pagination :paginator="$data" />


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
