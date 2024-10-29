<div class="down-btn">
    <a href="{{ route('absen.add') }}">
        <button class="btn-tambah">Tambah Kegiatan</button>
    </a>
    <a href="{{ route('absen.export') }}">
        <button class="btn-export">Export Excel</button>
    </a>
</div>

<table class="table-admin">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama Kegiatan</th>
            <th>Jumlah Peserta</th>
            <th>Penanggung Jawab</th>
            <th>Tujuan</th>
            <th>Hasil</th>
            <th>Print/PDF</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
            <td>{{ $item->activity_name }}</td>
            <td>{{ $item->participant_count }}</td>
            <td>{{ $item->responsible }}</td>
            <td>{{ Str::limit($item->objective, 50) }}</td>
            <td>{{ Str::limit($item->summary, 50) }}</td>
            <td class="action-cell">
                <a href="{{ route('absen.downloadPdf', ['id' => $item->id]) }}" class="icon-action print">
                    <i class="fa fa-print"></i>
                </a>
            </td>
            <td class="action-cell">
                <a href="{{ route('absen.edit', ['id' => $item->id]) }}" class="icon-action pencil">
                    <i class="fa fa-pencil"></i>
                </a>
            </td>
            <td class="action-cell">
                <form id="delete-form-{{ $item->id }}" action="{{ route('absen.destroy', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete({{ $item->id }})" class="icon-action trash">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>