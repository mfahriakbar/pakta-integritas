<div class="down-btn">
    <a href="{{ route('penyedia-jasa.add') }}">
        <button class="btn-tambah">Tambah</button>
    </a>
    <a href="{{ route('penyedia-jasa.export') }}">
        <button class="btn-export">Export Excel</button>
    </a>
</div>
<table class="table-admin">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama Rekan</th>
            <th>Alamat</th>
            <th>Nomor Induk Berusaha</th>
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
            <td>{{ $item->nama_rekan }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->nib }}</td>
            <td>{{ $item->no_telepon }}</td>
            <td>{{ $item->kesimpulan }}</td>
            <td class="action-cell">
                <a href="{{ route('penyedia-jasa.downloadPdf', ['id' => $item->id]) }}">
                    <div class="icon-action print"><i class="fa fa-print"></i></div>
                </a>
            </td>
            <td class="action-cell">
                <a href="{{ route('penyedia-jasa.edit', ['id' => $item->id]) }}">
                    <div class="icon-action pencil"><i class="fa fa-pencil"></i></div>
                </a>
            </td>
            <td class="action-cell">
                <form id="delete-form-{{ $item->id }}" action="{{ route('penyedia-jasa.destroy', ['id' => $item->id]) }}" method="POST">
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