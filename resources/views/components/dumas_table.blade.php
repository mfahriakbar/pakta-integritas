<div class="down-btn">
    <a href="{{ route('dumas.export') }}">
        <button class="btn-export">Export Excel</button>
    </a>
</div>

<table class="table-admin">
    <thead>
        <tr>
            <th>NO</th>
            <th>Sarana Pengaduan</th>
            <th>Jenis Pengaduan</th>
            <th>Penanganan Pengaduan</th>
            <th>Keterangan</th>
            <th>Print/PDF</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
            <td>{{ $item->complaint_channel }}</td>
            <td>{{ $item->complaint_type }}</td>
            <td>{{ $item->handling }}</td>
            <td>{{ $item->remarks }}</td>
            <td class="action-cell">
                <a href="{{ route('dumas.downloadPdf', ['id' => $item->id]) }}" class="icon-action print">
                    <i class="fa fa-print"></i>
                </a>
            </td>
            <td class="action-cell">
                <a href="{{ route('dumas.edit', ['id' => $item->id]) }}" class="icon-action pencil">
                    <i class="fa fa-pencil"></i>
                </a>
            </td>
            <td class="action-cell">
                <form id="delete-form-{{ $item->id }}" action="{{ route('dumas.destroy', ['id' => $item->id]) }}" method="POST">
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