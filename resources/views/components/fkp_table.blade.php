<div class="down-btn">
    <a href="{{ route('fkp.add') }}">
        <button class="btn-tambah">Tambah</button>
    </a>
    <a href="{{ route('fkp.export') }}">
        <button class="btn-export">Export Excel</button>
    </a>
</div>

<!-- In your LaporTable component -->

<table class="table-admin">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama Pelapor</th>
            <th>NIP</th>
            <th>Jenis Pesan</th>
            <th>Email Pelapor</th>
            <th>Kirim</th>
            <th>Print/ PDF</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
            <td>{{ $item->employee_name }}</td>
            <td>{{ $item->employee_id }}</td>
            <td>{{ $item->message_type }}</td>
            <td>{{ $item->reporter_email }}</td>
            <td class="action-cell">
                <a href="{{ route('fkp.send-email', ['id' => $item->id]) }}" onclick="return confirm('Apakah Anda yakin ingin mengirim email?')">
                    <div class="icon-action mail" aria-label="Kirim email ke {{ $item->reporter_email }}">
                        <i class="fa fa-envelope"></i>
                    </div>
                </a>
            </td>            
            <td class="action-cell">
                <a href="{{ route('fkp.pdf', ['id' => $item->id]) }}">
                    <div class="icon-action print"><i class="fa fa-print"></i></div>
                </a>
            </td>
            <td class="action-cell">
                <a href="{{ route('fkp.edit', ['id' => $item->id]) }}">
                    <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                </a>
            </td>
            <td class="action-cell">
                <form id="delete-form-{{ $item->id }}" action="{{ route('fkp.destroy', ['id' => $item->id]) }}" method="POST">
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
