<!-- Action Buttons -->
<div class="down-btn">
    <a href="{{ route('spip.export') }}">
        <button class="btn-export">Export Excel</button>
    </a>
</div>

<!-- Table Section -->
<div class="table-responsive">
    <table class="table-admin">
        <thead>
            <tr>
                <th>NO</th>
                <th>Tahun</th>
                <th>Tipe Dokumen</th>
                <th>Folder</th>
                <th>Info Tambahan</th>
                <th>Tanggal Upload</th>
                <th>Lihat</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                <td>{{ $item->year }}</td>
                <td>{{ $item->document_type ?? '-' }}</td>
                <td>{{ $item->folder_path }}</td>
                <td>{{ $item->additional_info ?? '-' }}</td>
                <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                <td class="action-cell">
                    <a href="{{ route('spip.show', ['id' => $item->id]) }}" target="_blank">
                        <div class="icon-action view">
                            <i class="fa fa-eye"></i>
                        </div>
                    </a>
                </td>
                <td class="action-cell">
                    <form id="delete-form-{{ $item->id }}" action="{{ route('spip.destroy', ['id' => $item->id]) }}" method="POST">
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
</div>


