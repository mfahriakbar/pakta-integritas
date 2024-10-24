@extends('layouts.admin')

@section('title', 'Tabel Laporan FKP')

@section('content')

<header>
    <h1>Tabel Formulir Laporan FKP</h1>
</header>
<hr class="header-line">
<!-- Panggil komponen search section -->
<x-search_section />

<!-- Panggil komponen lapor table -->
<x-fkp_table :data="$data"/>

<!-- Panggil komponen pagination -->
<x-pagination :paginator="$data" />


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Check for SweetAlert flash messages
document.addEventListener('DOMContentLoaded', function() {
    // Success message
    const successMessage = '{{ Session::get('success-swal') }}';
    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: successMessage,
            timer: 1500,
            showConfirmButton: false
        });
    }

    // Error message
    const errorMessage = '{{ Session::get('error-swal') }}';
    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: errorMessage
        });
    }
});
</script>
<script src="{{ asset('script/script-admin.js') }}"></script>
@endsection
