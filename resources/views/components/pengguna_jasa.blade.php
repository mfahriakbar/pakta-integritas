<div class="down-btn">
    <a href="{{ route('studi-kelayakan.add') }}">
        <button class="btn-tambah">Tambah</button>
    </a>
    <a href="{{ route('studi-kelayakan.export') }}">
        <button class="btn-export">Export Excel</button>
    </a>
</div>
<table class="table-admin">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama Pengguna</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>No. Telepon</th>
            <th>Kesimpulan</th>
            <th>Print/ PDF</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
            <td>{{ $item->nama_pengguna }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->no_telepon }}</td>
            <td>{{ $item->kesimpulan }}</td>
            <td class="action-cell">
                <a href="{{ route('studi-kelayakan.download-pdf', ['id' => $item->id]) }}">
                    <div class="icon-action print"><i class="fa fa-print"></i></div>
                </a>
            </td>
            <td class="action-cell">
                <a href="{{ route('studi-kelayakan.edit', ['id' => $item->id]) }}">
                    <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                </a>
            </td>
            <td class="action-cell">
                <form id="delete-form-{{ $item->id }}" action="{{ route('studi-kelayakan.destroy', ['id' => $item->id]) }}" method="POST">
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