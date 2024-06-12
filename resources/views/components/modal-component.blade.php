@props([
    'title',
    'id',
    'tableId',
    'listData',
    'columns',
])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="modalRole" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 720px">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRole">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="{{ $tableId }}" class="display" style="width: 100%">
                    <thead>
                        <tr>
                            @foreach($columns as $key => $column)
                                @if($column != 'id')
                                    <th>{{ $column }}</th>
                                @endif
                            @endforeach
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($listData as $row)
                            <tr>
                                @foreach($columns as $column)
                                    @if($column != 'id')
                                        <td>{{ $row[$column] ?? '' }}</td>
                                    @endif
                                @endforeach
                                <td>
                                    <button type="button" class="btn btn-sm btn-success add-member" onclick="addData('{{ $row['id'] }}', '{{ $row['no_ktp'] }}', '{{ $row['nama_lengkap'] }}', '{{ $row['no_telp'] }}')">Pilih Jamaah</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($columns) }}">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function addData(id, no_ktp, nama, no_telp) {
        $('#jamaah_id').val(id);
        $('#nama_jamaah').val(nama);
        $('#exJamaah').modal('hide');
    }
</script>
