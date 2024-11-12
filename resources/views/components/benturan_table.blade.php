<div class="down-btn">
    <a href="{{ route('benturan.add') }}">
        <button class="btn-tambah">Tambah</button>
    </a>
    <a href="{{ route('benturan.export') }}">
        <button class="btn-export">Export Excel</button>
    </a>
</div>

<!-- In your BenturanTable component -->

<table class="table-admin">
    <thead>
        <tr>
            <th>NO</th>
            <th>Subjek/Jabatan</th>
            <th>Kegiatan</th>
            <th>Situasi Kondisi</th>
            <th>Penyebab</th>
            <th>Strategi</th>
            <th>Print/PDF</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
            <td>{{ $item->subject_position }}</td>
            <td>{{ $item->activity_type }}</td>
            <td>{{ $item->conflict_type }}</td>
            <td>{{ $item->situation }}</td>
            <td>{{ $item->handling_strategy }}</td>
            <td class="action-cell">
                <a href="{{ route('benturan.pdf', ['id' => $item->id]) }}">
                    <div class="icon-action print"><i class="fa fa-print"></i></div>
                </a>
            </td>
            <td class="action-cell">
                <a href="{{ route('benturan.edit', ['id' => $item->id]) }}">
                    <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                </a>
            </td>
            <td class="action-cell">
                <form id="delete-form-{{ $item->id }}" action="{{ route('benturan.destroy', ['id' => $item->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete({{ $item->id }})">
                        <div class="icon-action trash">
                            <i class="fa fa-trash"></i>
                        </div>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
