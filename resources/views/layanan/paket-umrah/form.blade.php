@extends('layouts.app')

@section('content')
    <header><h3>Tambah Paket Umrah</h3></header>
    <form action="{{ route('paket-umrah.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @php $fieldCount = 0; @endphp
            @foreach ($paketUmrahFields as $field)
                @if ($field !== 'id' && $field !== 'created_at' && $field !== 'updated_at')
                    @php $fieldCount++; @endphp
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                            @if ($field === 'kode_paket')
                                <input type="text" readonly placeholder="Generate by System" class="form-control form-control-sm" id="{{ $field }}" name="{{ $field }}">
                            @elseif ($field === 'gambar')
                                <input type="file" class="form-control form-control-sm" id="{{ $field }}" name="{{ $field }}">
                            @elseif ($field === 'contact_person')
                                <input type="text" class="form-control form-control-sm" id="{{ $field }}" name="{{ $field }}">
                            @elseif ($field === 'pembimbing')
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" readonly name="{{ $field }}" id="{{ $field }}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exPembimbing">Pilih Pembimbing</button>
                                    </div>
                                </div>
                            @else
                                <input type="text" class="form-control form-control-sm" id="{{ $field }}" name="{{ $field }}">
                            @endif
                        </div>
                    </div>
                    @if ($fieldCount === 6)
                        </div><div class="row">
                    @endif
                @endif
            @endforeach

            <div class="col-12">
                <div class="form-group">
                    <h5>List Kamar: </h5>
                    <table class="table" id="paketUmrahDetail">
                        <thead>
                            <tr style="text-align: center">
                                <td>Jenis Kamar</td>
                                <td>Harga Paket</td>
                                <td>Hotel Mekkah</td>
                                <td>Hotel Madinah</td>
                                <td><button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addDetailModal">Tambah Kamar</button></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[0][jenis_kamar]"></td>
                                <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[0][harga_paket]"></td>
                                <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[0][hotel_mekkah]"></td>
                                <td><input type="email" class="form-control form-control-sm" readonly name="paketUmrahDetail[0][hotel_madinah]"></td>
                                <td style="text-align: center"><button type="button" class="btn btn-sm btn-danger" onclick="deleteMemberRow(this)">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
    </form>

        <div class="modal fade" id="exPembimbing" tabindex="-1" aria-labelledby="modalRole" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 720px">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRole">List Ketua</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="karyawanTable2" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <td>Nama</td>
                                    <td>Nomor Telepon</td>
                                    <td>Jenis Kelamin</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listKaryawan as $index => $karyawan)
                                    <tr class="karyawan-details" data-karyawan="{{ json_encode($karyawan) }}">
                                        <td>{{ $karyawan['nama_depan'].$karyawan['nama_belakang'] }}</td>
                                        <td>{{ $karyawan['no_hp'] }}</td>
                                        <td>{{ $karyawan['jenis_kelamin'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success add-member" onclick="addRolekaryawan('{{ $karyawan['nama_depan'].' '.$karyawan['nama_belakang'] }}', '{{ $karyawan['no_hp'] }}', '{{ $karyawan['jenis_kelamin'] }}')">Pilih Pembimbing</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal for adding new details -->
        <div class="modal fade" id="addDetailModal" tabindex="-1" role="dialog" aria-labelledby="addDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDetailModalLabel">Tambah Kamar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add your form or content for the modal body here -->
                        <form id="addDetailForm">
                            <div class="form-group">
                                <label for="jenisKamarInput">Jenis Kamar:</label>
                                <input type="text" class="form-control form-control-sm" id="jenisKamarInput" placeholder="Jenis Kamar">
                            </div>
                            <div class="form-group">
                                <label for="hargaPaketInput">Harga Paket:</label>
                                <input type="text" class="form-control form-control-sm" id="hargaPaketInput" placeholder="Harga Paket">
                            </div>
                            <div class="form-group">
                                <label for="hotelMekkahInput">Hotel Mekkah:</label>
                                <input type="text" class="form-control form-control-sm" id="hotelMekkahInput" placeholder="Hotel Mekkah">
                            </div>
                            <div class="form-group">
                                <label for="hotelMadinahInput">Hotel Madinah:</label>
                                <input type="text" class="form-control form-control-sm" id="hotelMadinahInput" placeholder="Hotel Madinah">
                            </div>
                            <br>
                            <button type="button" class="btn btn-sm btn-primary" onclick="addDetailRow()">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <script>
        // buatlah ready function untuk mendeteksi semua elemen html telah selesai di load
        $(document).ready(function() {
            $("#tanggal_keberangkatan").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                yearRange: 'c-100:c+10',
                onSelect: function (selectedDate) {
                    // Set minDate for tanggal_akhir_pendaftaran
                    $("#tanggal_akhir_pendaftaran").datepicker("option", "maxDate", selectedDate);
                }
            });

            $("#tanggal_akhir_pendaftaran").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                yearRange: 'c-100:c+10',
                onSelect: function (selectedDate) {
                    // Set maxDate for tanggal_keberangkatan
                    $("#tanggal_keberangkatan").datepicker("option", "minDate", selectedDate);
                }
            });
            // buatlah variabel untuk menampung nomor index
            let index = 0;
            // buatlah event click untuk menambahkan baris input
            // $("#addRow").click(function() {
            //     // tambahkan baris input dengan append
            //     $("#paketUmrahDetail").append(`
            //         <tr>
            //             <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[${index}][jenis_kamar]"></td>
            //             <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[${index}][harga_paket]"></td>
            //             <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[${index}][hotel_mekkah]"></td>
            //             <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[${index}][hotel_madinah]"></td>
            //             <td style="text-align: center"><button type="button" class="btn btn-sm btn-danger" onclick="deleteMemberRow(this)">Delete</button></td>
            //         </tr>
            //     `);
            //     index++;
            // });
        });

        let detailIndex = 1;

        function addDetailRow() {
            const jenisKamar = $('#jenisKamarInput').val();
            const hargaPaket = parseFloat($('#hargaPaketInput').val());
            const hotelMekkah = $('#hotelMekkahInput').val();
            const hotelMadinah = $('#hotelMadinahInput').val();

            const formattedHargaPaket = hargaPaket.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

            console.log(formattedHargaPaket)

            // Append a new row to the table
            $('#paketUmrahDetail tbody').append(`
                <tr>
                    <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[${detailIndex}][jenis_kamar]" value="${jenisKamar}"></td>
                    <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[${detailIndex}][harga_paket]" value="${formattedHargaPaket}"></td>
                    <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[${detailIndex}][hotel_mekkah]" value="${hotelMekkah}"></td>
                    <td><input type="text" class="form-control form-control-sm" readonly name="paketUmrahDetail[${detailIndex}][hotel_madinah]" value="${hotelMadinah}"></td>
                    <td style="text-align: center"><button type="button" class="btn btn-sm btn-danger" onclick="deleteDetailRow(this)">Delete</button></td>
                </tr>
            `);

            // Increment the detail index for the next row
            detailIndex++;

            // Close the modal
            $('#addDetailModal').modal('hide');
        }

        function deleteDetailRow(button) {
            // Remove the corresponding row when the delete button is clicked
            $(button).closest('tr').remove();
        }

        // buatlah function untuk menghapus baris input
        function deleteMemberRow(btn) {
            // cari parent element dari button
            let row = btn.parentNode.parentNode;
            // hapus baris
            row.parentNode.removeChild(row);
        }

        function addRolekaryawan(nama, no_hp, jenis_kelamin) {
            console.log(nama)
            $('#pembimbing').val(nama);
            $('#contact_person').val(no_hp);
            $('#exPembimbing').modal('hide');
        }


    </script>
@endsection
