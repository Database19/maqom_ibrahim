

@extends('layouts.app')
@if (Route::currentRouteName() === 'daftar-jamaah.create')
    @section('content')
            <div class="container">
                <h2>Tambah Jamaah</h2>
                <form method="POST" action="{{ route('daftar-jamaah.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        @php $fieldCount = 0; @endphp
                        @foreach ($jamaahFields as $field)
                            @if ($field !== 'id' && $field !== 'created_at' && $field !== 'updated_at' && $field !== 'is_deleted' && $field !== 'members' && $field !== 'nama_foto' && $field !== 'parent_id' && $field !== 'is_register' && $field !== 'status')
                                @php $fieldCount++; @endphp
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                        @if ($field === 'tanggal_lahir')
                                            <input type="text" class="form-control form-control-sm" name="{{ $field }}" id="{{ $field }}">
                                        @elseif ($field === 'foto')
                                            <div class="input-group">
                                                <input type="file" onchange="previewImage()" class="form-control form-control-sm" name="{{ $field }}" id="{{ $field }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#fotoModal">Lihat Gambar</button>
                                                </div>
                                            </div>
                                        @elseif ($field === 'nama_relasi')
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm" name="{{ $field }}" id="{{ $field }}">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exRole">Pilih Ketua</button>
                                                    </div>
                                                </div>
                                        @elseif ($field === 'provinsi')
                                            <select name="provinsi" id="provinsi" class="form-control form-control-sm">
                                                <option value="">-- Pilih Provinsi --</option>
                                                @foreach ($provinsi as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'kota')
                                            <select name="kota" id="kota" class="form-control form-control-sm">
                                                <option value="">-- Pilih Kota --</option>
                                            </select>
                                        @elseif ($field === 'kecamatan')
                                            <select name="kecamatan" id="kecamatan" class="form-control form-control-sm">
                                                <option value="">-- Pilih Kecamatan --</option>
                                            </select>
                                        @elseif ($field === 'kelurahan')
                                            <select name="kelurahan" id="kelurahan" class="form-control form-control-sm">
                                                <option value="">-- Pilih Kelurahan --</option>
                                            </select>
                                        @elseif ($field === 'golongan_darah')
                                            <select name="golongan_darah" id="golongan_darah" class="form-control form-control-sm">
                                                <option value="">-- Golongan Darah --</option>
                                                @foreach ($golonganDarah as $darah)
                                                    <option value="{{ $darah->golongan_darah }}">{{ $darah->golongan_darah }}</option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'status_pernikahan')
                                            <select name="status_pernikahan" id="status_pernikahan" class="form-control form-control-sm">
                                                <option value="">-- Status Pernikahan --</option>
                                                @foreach ($statusPernikahan as $nikah)
                                                    <option value="{{ $nikah->status_pernikahan }}">{{ $nikah->status_pernikahan }}</option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'jenis_kelamin')
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-sm">
                                                <option value="">-- Jenis Kelamin --</option>
                                                @foreach ($jenisKelamin as $jenis)
                                                    <option value="{{ $jenis->jenis_kelamin }}">{{ $jenis->jenis_kelamin }}</option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'role_relasi')
                                            <select name="role_relasi" id="role_relasi" class="form-control form-control-sm">
                                                <option value="">-- Role Relasi --</option>
                                                <option value="ketua">Ketua</option>
                                                <option value="member">Member</option>
                                            </select>
                                        @else
                                            <input type="{{ $field === 'email' ? 'email' : 'text' }}" @if ($field == 'no_ktp')
                                                maxlength="16"
                                            @endif class="form-control form-control-sm" name="{{ $field }}" id="{{ $field }}">
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
                                <label><b>Members:</b></label>
                                <table class="table" id="membersTable">
                                    <thead>
                                        <tr style="text-align: center">
                                            <td>No Ktp</td>
                                            <td>Name</td>
                                            <td>No Telp</td>
                                            <td>Email</td>
                                            <td>Nama Relasi</td>
                                            <td><button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Member</button></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm" readonly name="members[0][no_ktp]"></td>
                                            <td><input type="text" class="form-control form-control-sm" readonly name="members[0][nama_lengkap]"></td>
                                            <td><input type="text" class="form-control form-control-sm" readonly name="members[0][no_telp]"></td>
                                            <td><input type="email" class="form-control form-control-sm" readonly name="members[0][email]"></td>
                                            <td><input type="text" class="form-control form-control-sm" readonly name="members[0][nama_relasi]"></td>
                                            <td><button type="button" class="btn btn-sm btn-danger" onclick="deleteMemberRow(this)">Delete</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="data_foto" id="data_foto" value="">
                        <input type="hidden" name="data_nama_foto" id="data_nama_foto" value="">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mt-2">Submit</button>
                </form>
            </div>

            <!-- Your main content goes here -->

        <!-- Modal for Editing Photo -->
        <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fotoModalLabel">Edit Photo</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Image preview -->
                        <div class="d-flex justify-content-center">
                            <img id="previewImage" src="#" alt="Selected Image" class="img-fluid">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info" data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Your additional scripts go here -->


        <!-- Your modal HTML structure -->
        <div class="modal fade" id="exRole" tabindex="-1" aria-labelledby="modalRole" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 720px">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRole">List Ketua</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="jamaahTable2" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <td>Nama Ketua</td>
                                    <td>Nama Role</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($namaRelasi as $index => $jamaah)
                                    <tr class="jamaah-details" data-jamaah="{{ json_encode($jamaah) }}">
                                        <td>{{ $jamaah['no_ktp'] }}</td>
                                        <td>{{ $jamaah['nama_lengkap'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success add-member" onclick="addRoleJamaah('{{ $jamaah['no_ktp']}}', '{{ $jamaah['nama_lengkap'] }}', '{{ $jamaah['no_telp'] }}', '{{ $jamaah['email'] }}', '{{ $jamaah['nama_relasi'] }}')">Pilih Ketua</button>
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


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 720px">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Jamaah Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="jamaahTable" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <td>No Ktp</td>
                                    <td>Nama Lengkap</td>
                                    <td>No. Telepon</td>
                                    <td style="display: none;">Email</td>
                                    <td style="display: none;">Nama Relasi</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jamaahs as $index => $jamaah)
                                    <tr class="jamaah-details" data-jamaah="{{ json_encode($jamaah) }}">
                                        <td>{{ $jamaah['no_ktp'] }}</td>
                                        <td>{{ $jamaah['nama_lengkap'] }}</td>
                                        <td>{{ $jamaah['no_telp'] }}</td>
                                        <td style="display: none;">{{ $jamaah['email'] }}</td>
                                        <td style="display: none;">{{ $jamaah['nama_relasi'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success add-member" onclick="addMemberFromJamaah('{{ $jamaah['no_ktp']}}', '{{ $jamaah['nama_lengkap'] }}', '{{ $jamaah['no_telp'] }}', '{{ $jamaah['email'] }}', '{{ $jamaah['nama_relasi'] }}')">Add Member</button>
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
        <script>
            function addRoleJamaah(noKtp,namaLengkap, noTelp, email, namaRelasi) {
                $('#nama_relasi').val(namaRelasi);
                $('#exRole').modal('hide');
            }

            function previewImage() {
                // Dapatkan input file yang dipilih
                var input = document.getElementById('foto');

                // Pastikan file telah dipilih
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    // Siapkan tampilan gambar
                    reader.onload = function (e) {
                        document.getElementById('previewImage').src = e.target.result;
                        $('#data_foto').val(e.target.result);
                    };

                    // Baca file yang dipilih sebagai URL data
                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Pasang fungsi previewImage pada event onchange dari input #foto
            document.getElementById('foto').addEventListener('change', previewImage);

            let selectedMembers = [];

            $(document).ready(function() {
                $("#usia").on('change', function() {
                    var usia = $(this).val();
                    if (usia) {
                        var currentYear = new Date().getFullYear();
                        var tahunLahir = currentYear - usia;
                        $("#tanggal_lahir").datepicker("setDate", new Date(tahunLahir, 0, 1));
                    }
                });

                $("#tanggal_lahir").datepicker({
                    dateFormat: 'yy-mm-dd',
                    autoclose: true,
                    changeMonth: true,
                    changeYear: true,
                    todayHighlight: true
                });

                // Initialize DataTable
                $('#jamaahTable').DataTable({
                    paging: true,  // Enable pagination
                    searching: true,  // Enable searching
                    lengthMenu: [5],
                    scrollCollapse: true,
                    scrollY: '50vh'
                });

                $('#jamaahTable2').DataTable({
                    paging: true,  // Enable pagination
                    searching: true,  // Enable searching
                    lengthMenu: [5],
                    scrollCollapse: true,
                    scrollY: '50vh'
                });

                    // Event delegation for "Add to Members" button
                $('#jamaahTable tbody').on('click', 'button.add-member', function() {
                    // var rowIndex = table.row($(this).closest('tr')).index();
                    // addMemberFromJamaah(rowIndex);
                });


                // Handle province selection
                $('#provinsi').on('change', function () {
                    var provinceId = $(this).val();
                    if (provinceId) {
                        // Make AJAX request to fetch cities based on the selected province
                        $.ajax({
                            url: '/api/regencies/' + provinceId,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                // Update the city dropdown with fetched data
                                updateDropdown('kota', data);
                            },
                            error: function (error) {
                                console.error('Error fetching city data:', error);
                            }
                        });
                    } else {
                        // Clear city and district dropdowns if province is not selected
                        clearDropdown('kota');
                        clearDropdown('kecamatan');
                    }
                });

                // Handle city selection
                $('#kota').on('change', function () {
                    var cityId = $(this).val();
                    // console.log(cityId)
                    if (cityId) {
                        // Make AJAX request to fetch districts based on the selected city
                        $.ajax({
                            url: '/api/districts/' + cityId,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                // Update the district dropdown with fetched data
                                updateDropdown('kecamatan', data);
                            },
                            error: function (error) {
                                console.error('Error fetching district data:', error);
                            }
                        });
                    } else {
                        // Clear district dropdown if city is not selected
                        clearDropdown('kecamatan');
                    }
                });

                // Handle city selection
                $('#kecamatan').on('change', function () {
                    var idKecamatan = $(this).val();
                    // console.log(idKecamatan)
                    if (idKecamatan) {
                        // Make AJAX request to fetch districts based on the selected city
                        $.ajax({
                            url: '/api/villages/' + idKecamatan,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                // Update the district dropdown with fetched data
                                updateDropdown('kelurahan', data);
                            },
                            error: function (error) {
                                console.error('Error fetching district data:', error);
                            }
                        });
                    } else {
                        // Clear district dropdown if city is not selected
                        clearDropdown('kelurahan');
                    }
                });

                // Function to update dropdown options
                function updateDropdown(dropdownId, data) {
                    var dropdown = $('#' + dropdownId);
                    dropdown.empty();
                    dropdown.append('<option value="">-- Pilih ' + capitalizeFirstLetter(dropdownId) + ' --</option>');

                    $.each(data, function (key, value) {
                        dropdown.append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                    });
                }

                // Function to clear dropdown options
                function clearDropdown(dropdownId) {
                    $('#' + dropdownId).empty();
                    $('#' + dropdownId).append('<option value="">-- Pilih ' + capitalizeFirstLetter(dropdownId) + ' --</option>');
                }

                // Function to capitalize the first letter of a string
                function capitalizeFirstLetter(string) {
                    return string.charAt(0).toUpperCase() + string.slice(1);
                }
            });

            let memberRowCount = 1;

            function isMemberSelected(email) {
                // Check if the member is already selected
                return selectedMembers.includes(email);
            }

            function addMemberRow() {
                const tableBody = document.getElementById('membersTable').getElementsByTagName('tbody')[0];
                const newRow = tableBody.insertRow();
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);
                const cell4 = newRow.insertCell(3);
                const cell5 = newRow.insertCell(4);
                const cell6 = newRow.insertCell(5);
                const cell7 = newRow.insertCell(6);

                cell1.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][no_ktp]">`;
                cell2.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][nama_lengkap]">`;
                cell3.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][no_telp]">`;
                cell4.innerHTML = `<input type="email" class="form-control form-control-sm" readonly name="members[${memberRowCount}][email]">`;
                cell5.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][nama_relasi]">`;
                cell6.innerHTML = `<button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Pilih Jamaah</button>`;
                cell7.innerHTML = `<button type="button" class="btn btn-sm btn-danger" onclick="deleteMemberRow(this)">Delete</button>`;
                // Add more cells if needed

                // selectedMembers.push(jamaahDetails.email);

                memberRowCount++;

                // Enable the delete button for the new row
                const deleteButton = newRow.querySelector('.btn-danger');
                deleteButton.removeAttribute('disabled');
            }

            function deleteMemberRow(button) {
                const tableBody = document.getElementById('membersTable').getElementsByTagName('tbody')[0];
                const row = button.parentNode.parentNode;

                // Check if the row is the only remaining row
                if (tableBody.rows.length > 1) {
                    tableBody.removeChild(row);
                } else {
                    // Display an alert or handle the case where the row cannot be deleted
                    alert('Cannot delete the last row.');
                }
            }

            function addMemberFromJamaah(noKtp,namaLengkap, noTelp, email, namaRelasi) {

                console.log(noKtp,namaLengkap, noTelp, email, namaRelasi)
                if (isMemberSelected(email)) {
                    alert('Member Jamaah sudah .');
                    return false;
                }
                // Append a new row to the members table with Jamaah details
                var newRow = '<tr>' +
                    '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][no_ktp]" value="' + noKtp + '"></td>' +
                    '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][nama_lengkap]" value="' + namaLengkap + '"></td>' +
                    '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][no_telp]" value="' + noTelp + '"></td>' +
                    '<td><input type="email" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][email]" value="' + email + '"></td>' +
                    '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][nama_relasi]" value="' + namaRelasi + '"></td>' +
                    '<td><button type="button" class="btn btn-sm btn-danger" onclick="deleteMemberRow(this)">Delete</button></td>' +
                    '</tr>';

                // Append the new row to the members table
                $('#membersTable tbody').append(newRow);

                selectedMembers.push(email);

                // Increment the member row count
                memberRowCount++;

                // Hide the modal
                $('#exampleModal').modal('hide');
            }
        </script>
    @endsection
@elseif (Route::currentRouteName() === 'daftar-jamaah.show')
@section('content')
        <div class="container">
            <h2>View Jamaah</h2>
            <form method="POST" action="{{ route('daftar-jamaah.store') }}">
                @csrf
                <div class="row">
                    @php $fieldCount = 0; @endphp
                    @foreach ($jamaahFields as $field)
                        @if ($field !== 'id' && $field !== 'created_at' && $field !== 'updated_at' && $field !== 'is_deleted' && $field !== 'members' && $field !== 'parent_id' && $field !== 'nama_foto' && $field !== 'status' && $field !== 'is_register')
                            @php $fieldCount++; @endphp
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                    @if ($field === 'tanggal_lahir')
                                            <input type="text" class="form-control form-control-sm" disabled value="{{ $dataJamaah->tanggal_lahir }}" name="{{ $field }}" id="{{ $field }}">
                                        @elseif ($field === 'foto')
                                            <div class="input-group">
                                                <input type="text" disabled class="form-control form-control-sm" name="{{ $field }}" id="{{ $field }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#fotoModal">Lihat Foto</button>
                                                </div>
                                            </div>
                                        @elseif ($field === 'provinsi')
                                            <select name="provinsi" disabled id="provinsi" class="form-control form-control-sm">
                                                <option value="" {{ ($dataJamaah->provinsi) ? 'selected' : '' }}>{{ $dataJamaah->provinsi }}</option>
                                            </select>
                                            @elseif ($field === 'kota')
                                            <select name="kota" disabled id="kota" class="form-control form-control-sm">
                                                <option value="" {{ ($dataJamaah->kota) ? 'selected' : ''}}>{{ $dataJamaah->kota }}</option>
                                            </select>
                                            @elseif ($field === 'kecamatan')
                                            <select name="kecamatan" disabled id="kecamatan" class="form-control form-control-sm">
                                                <option value="" {{ ($dataJamaah->kecamatan) ? 'selected' : ''}}>{{ $dataJamaah->kecamatan }}</option>
                                            </select>
                                            @elseif ($field === 'kelurahan')
                                            <select name="kelurahan" disabled id="kelurahan" class="form-control form-control-sm">
                                                <option value="" {{ ($dataJamaah->kelurahan) ? 'selected' : ''}}>{{ $dataJamaah->kelurahan }}</option>
                                            </select>
                                            @elseif ($field === 'golongan_darah')
                                            <select name="golongan_darah" disabled id="golongan_darah" class="form-control form-control-sm">
                                                <option value="" {{ ($dataJamaah->golongan_darah) ? 'selected' : ''}}>{{ $dataJamaah->golongan_darah }}</option>
                                            </select>
                                            @elseif ($field === 'status_pernikahan')
                                            <select name="status_pernikahan" disabled id="status_pernikahan" class="form-control form-control-sm">
                                                <option value="" {{ ($dataJamaah->status_pernikahan) ? 'selected' : ''}}>{{ $dataJamaah->status_pernikahan }}</option>
                                            </select>
                                            @elseif ($field === 'jenis_kelamin')
                                            <select name="jenis_kelamin" disabled id="jenis_kelamin" class="form-control form-control-sm">
                                                <option value="" {{ ($dataJamaah->jenis_kelamin) ? 'selected' : ''}}>{{ $dataJamaah->jenis_kelamin }}</option>
                                            </select>
                                            @elseif ($field === 'role_relasi')
                                            <select name="role_relasi" disabled id="role_relasi" class="form-control form-control-sm">
                                                <option value="" {{ ($dataJamaah->role_relasi) ? 'selected' : ''}}>{{ $dataJamaah->role_relasi }}</option>
                                            </select>
                                        @else
                                            <input type="{{ $field === 'email' ? 'email' : 'text' }}" disabled value="{{ $dataJamaah->$field }}" class="form-control form-control-sm" name="{{ $field }}">
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
                            <label><b>Members:</b></label>
                            <table class="table" id="membersTable">
                                <thead>
                                    <tr style="text-align: center">
                                        <td>No Ktp</td>
                                        <td>Name</td>
                                        <td>No Telp</td>
                                        <td>Email</td>
                                        <td>Nama Relasi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($children as $key => $val)
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm" disabled value="{{ $val->no_ktp }}" name="members[{{ $key }}][no_ktp]"></td>
                                            <td><input type="text" class="form-control form-control-sm" disabled value="{{ $val->nama_lengkap }}" name="members[{{ $key }}][nama_lengkap]"></td>
                                            <td><input type="text" class="form-control form-control-sm" disabled value="{{ $val->no_telp }}" name="members[{{ $key }}][no_telp]"></td>
                                            <td><input type="email" class="form-control form-control-sm" disabled value="{{ $val->email }}" name="members[{{ $key }}][email]"></td>
                                            <td><input type="text" class="form-control form-control-sm" disabled value="{{ $val->nama_relasi }}" name="members[{{ $key }}][nama_relasi]"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <button type="submit" class="btn btn-sm btn-primary mt-2">Submit</button> --}}
            </form>
        </div>

        <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fotoModalLabel">Photo</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Image preview -->
                        <div class="d-flex justify-content-center">
                            <img src="{{ Storage::url($dataJamaah['foto']) }}" width="300" height="300" alt="" />
                        </div>

                        <!-- File input for image selection -->
                        <div class="mt-3">
                            {{-- <input type="file" name="edited_foto" id="edited_foto" class="form-control" onchange="previewImage()"> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Your modal HTML structure -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 720px">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Jamaah Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="jamaahTable" class="display" style="width: 100%">
                        <thead>
                            <tr>
                                <td>No Ktp</td>
                                <td>Nama Lengkap</td>
                                <td>No. Telepon</td>
                                <td style="display: none;">Email</td>
                                <td style="display: none;">Nama Relasi</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jamaahs as $index => $jamaah)
                                <tr class="jamaah-details" data-jamaah="{{ json_encode($jamaah) }}">
                                    <td>{{ $jamaah['no_ktp'] }}</td>
                                    <td>{{ $jamaah['nama_lengkap'] }}</td>
                                    <td>{{ $jamaah['no_telp'] }}</td>
                                    <td style="display: none;">{{ $jamaah['email'] }}</td>
                                    <td style="display: none;">{{ $jamaah['nama_relasi'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success add-member" onclick="addMemberFromJamaah('{{ $jamaah['no_ktp']}}', '{{ $jamaah['nama_lengkap'] }}', '{{ $jamaah['no_telp'] }}', '{{ $jamaah['email'] }}', '{{ $jamaah['nama_relasi'] }}')">Add Member</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        let selectedMembers = [];

        $(document).ready(function() {
            $("#tanggal_lahir").datepicker({
                dateFormat: 'yy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });

            $('#tanggal_lahir').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });

            // Initialize DataTable
            $('#jamaahTable').DataTable({
                paging: true,  // Enable pagination
                searching: true,  // Enable searching
                lengthMenu: [5],
                scrollCollapse: true,
                scrollY: '50vh'
            });

                // Event delegation for "Add to Members" button
            $('#jamaahTable tbody').on('click', 'button.add-member', function() {
                // var rowIndex = table.row($(this).closest('tr')).index();
                // addMemberFromJamaah(rowIndex);
            });
        });

        let memberRowCount = 1;

        function isMemberSelected(email) {
            // Check if the member is already selected
            return selectedMembers.includes(email);
        }

        function addMemberRow() {
            const tableBody = document.getElementById('membersTable').getElementsByTagName('tbody')[0];
            const newRow = tableBody.insertRow();
            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);
            const cell3 = newRow.insertCell(2);
            const cell4 = newRow.insertCell(3);
            const cell5 = newRow.insertCell(4);
            const cell6 = newRow.insertCell(5);
            const cell7 = newRow.insertCell(6);

            cell1.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][no_ktp]">`;
            cell2.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][nama_lengkap]">`;
            cell3.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][no_telp]">`;
            cell4.innerHTML = `<input type="email" class="form-control form-control-sm" readonly name="members[${memberRowCount}][email]">`;
            cell5.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][nama_relasi]">`;
            cell6.innerHTML = `<button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Pilih Jamaah</button>`;
            cell7.innerHTML = `<button type="button" class="btn btn-sm btn-danger" onclick="deleteMemberRow(this)">Delete</button>`;
            // Add more cells if needed

            // selectedMembers.push(jamaahDetails.email);

            memberRowCount++;

            // Enable the delete button for the new row
            const deleteButton = newRow.querySelector('.btn-danger');
            deleteButton.removeAttribute('disabled');
        }

        function deleteMemberRow(button) {
            const tableBody = document.getElementById('membersTable').getElementsByTagName('tbody')[0];
            const row = button.parentNode.parentNode;

            // Check if the row is the only remaining row
            if (tableBody.rows.length > 1) {
                tableBody.removeChild(row);
            } else {
                // Display an alert or handle the case where the row cannot be deleted
                alert('Cannot delete the last row.');
            }
        }

        function addMemberFromJamaah(noKtp,namaLengkap, noTelp, email, namaRelasi) {

            console.log(noKtp,namaLengkap, noTelp, email, namaRelasi)
            if (isMemberSelected(email)) {
                alert('Member Jamaah sudah .');
                return false;
            }
            // Append a new row to the members table with Jamaah details
            var newRow = '<tr>' +
                '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][no_ktp]" value="' + noKtp + '"></td>' +
                '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][nama_lengkap]" value="' + namaLengkap + '"></td>' +
                '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][no_telp]" value="' + noTelp + '"></td>' +
                '<td><input type="email" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][email]" value="' + email + '"></td>' +
                '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][nama_relasi]" value="' + namaRelasi + '"></td>' +
                '<td><button type="button" class="btn btn-sm btn-danger" onclick="deleteMemberRow(this)">Delete</button></td>' +
                '</tr>';

            // Append the new row to the members table
            $('#membersTable tbody').append(newRow);

            selectedMembers.push(email);

            // Increment the member row count
            memberRowCount++;

            // Hide the modal
            $('#exampleModal').modal('hide');
        }
    </script>
@endsection
@elseif (Route::currentRouteName() === 'daftar-jamaah.edit')
@section('content')
            <div class="container">
                <h2>Update Jamaah</h2>
                <form method="POST" action="{{ route('daftar-jamaah.update', $dataJamaah->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @php $fieldCount = 0; @endphp
                        @foreach ($jamaahFields as $field)
                            @if ($field !== 'id' && $field !== 'created_at' && $field !== 'updated_at' && $field !== 'is_deleted' && $field !== 'members' && $field !== 'nama_foto' && $field !== 'parent_id' && $field !== 'is_register')
                                @php $fieldCount++; @endphp
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                        @if ($field === 'tanggal_lahir')
                                            <input type="text" class="form-control form-control-sm" value="{{ $dataJamaah->$field }}" name="{{ $field }}" id="{{ $field }}">
                                        @elseif ($field === 'foto')
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" value="{{ $dataJamaah->$field }}" name="{{ $field }}" id="{{ $field }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#fotoModal">Edit</button>
                                                </div>
                                            </div>
                                        @elseif ($field === 'nama_relasi')
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" value="{{ $dataJamaah->$field }}" name="{{ $field }}" id="{{ $field }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exRole">Pilih Ketua</button>
                                                </div>
                                            </div>
                                        @elseif ($field === 'provinsi')
                                            <select name="provinsi" id="provinsi" class="form-control form-control-sm">
                                                <option value="">-- Pilih Provinsi --</option>
                                                @foreach ($provinsi as $item)
                                                    <option value="{{ $item['id'] }}" {{ $item['id'] == $dataJamaah->provinsi ? 'selected' : '' }}>
                                                        {{ $item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'kota')
                                            <select name="kota" id="kota" class="form-control form-control-sm">
                                                <option value="">-- Pilih Kota --</option>
                                                @foreach ($kota as $item)
                                                    <option value="{{ $item['id'] }}" {{ $item['id'] == $dataJamaah->kota ? 'selected' : '' }}>
                                                        {{ $item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'kecamatan')
                                            <select name="kecamatan" id="kecamatan" class="form-control form-control-sm">
                                                <option value="">-- Pilih Kecamatan --</option>
                                                @foreach ($kecamatan as $item)
                                                    <option value="{{ $item['id'] }}" {{ $item['id'] == $dataJamaah->kecamatan ? 'selected' : '' }}>
                                                        {{ $item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'kelurahan')
                                            <select name="kelurahan" id="kelurahan" class="form-control form-control-sm">
                                                <option value="">-- Pilih Kelurahan --</option>
                                                @foreach ($kelurahan as $item)
                                                    <option value="{{ $item['id'] }}" {{ $item['id'] == $dataJamaah->kelurahan ? 'selected' : '' }}>
                                                        {{ $item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'golongan_darah')
                                            <select name="golongan_darah" id="golongan_darah" class="form-control form-control-sm">
                                                <option value="">-- Golongan Darah --</option>
                                                @foreach ($golonganDarah as $darah)
                                                    <option value="{{ $darah->golongan_darah }}" {{ $darah->golongan_darah == $dataJamaah->golongan_darah ? 'selected' : '' }}>
                                                        {{ $darah->golongan_darah }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'status_pernikahan')
                                            <select name="status_pernikahan" id="status_pernikahan" class="form-control form-control-sm">
                                                <option value="">-- Status Pernikahan --</option>
                                                @foreach ($statusPernikahan as $nikah)
                                                    <option value="{{ $nikah->status_pernikahan }}" {{ $nikah->status_pernikahan == $dataJamaah->status_pernikahan ? 'selected' : '' }}>
                                                        {{ $nikah->status_pernikahan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'jenis_kelamin')
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-sm">
                                                <option value="">-- Jenis Kelamin --</option>
                                                @foreach ($jenisKelamin as $jenis)
                                                    <option value="{{ $jenis->jenis_kelamin }}" {{ $jenis->jenis_kelamin == $dataJamaah->jenis_kelamin ? 'selected' : '' }}>
                                                        {{ $jenis->jenis_kelamin }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @elseif ($field === 'role_relasi')
                                            <select name="role_relasi" id="role_relasi" class="form-control form-control-sm">
                                                <option value="">-- Role Relasi --</option>
                                                <option value="{{ $dataJamaah->role_relasi }}" {{ ($dataJamaah->role_relasi) ? 'selected' : '' }}>{{ $dataJamaah->role_relasi }}</option>
                                            </select>
                                        @else
                                            <input type="{{ $field === 'email' ? 'email' : 'text' }}" value="{{ $dataJamaah->$field }}" class="form-control form-control-sm" name="{{ $field }}">
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
                                <label><b>Members:</b></label>
                                <table class="table" id="membersTable">
                                    <thead>
                                        <tr style="text-align: center">
                                            <td>No Ktp</td>
                                            <td>Name</td>
                                            <td>No Telp</td>
                                            <td>Email</td>
                                            <td>Nama Relasi</td>
                                            <td><button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Member</button></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($children as $key => $value)
                                            <tr>
                                                <td><input type="text" class="form-control form-control-sm" readonly value="{{ $value->no_ktp }}" name="members[{{ $key }}][no_ktp]"></td>
                                                <td><input type="text" class="form-control form-control-sm" readonly value="{{ $value->nama_lengkap }}" name="members[{{ $key }}][nama_lengkap]"></td>
                                                <td><input type="text" class="form-control form-control-sm" readonly value="{{ $value->no_telp }}" name="members[{{ $key }}][no_telp]"></td>
                                                <td><input type="email" class="form-control form-control-sm" readonly value="{{ $value->email }}" name="members[{{ $key }}][email]"></td>
                                                <td><input type="text" class="form-control form-control-sm" readonly value="{{ $value->nama_relasi }}" name="members[{{ $key }}][nama_relasi]"></td>
                                                <td><button type="button" class="btn btn-sm btn-danger" onclick="deleteMemberRow(this)">Delete</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="data_foto" id="data_foto" value="">
                        <input type="hidden" name="data_nama_foto" id="data_nama_foto" value="">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mt-2">Submit</button>
                </form>
            </div>

            <!-- Your main content goes here -->

        <!-- Modal for Editing Photo -->
        <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fotoModalLabel">Edit Photo</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Image preview -->
                        <img id="previewImage" src="#" alt="Selected Image" style="max-width: 100%; height: auto;">

                        <!-- File input for image selection -->
                        <input type="file" name="edited_foto" id="edited_foto" class="form-control" onchange="previewImage()">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Your additional scripts go here -->


        <div class="modal fade" id="exRole" tabindex="-1" aria-labelledby="modalRole" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 720px">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRole">Jamaah Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="jamaahTable2" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <td>Nama Ketua</td>
                                    <td>Nama Relasi</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($namaRelasi as $index => $jamaah)
                                    <tr class="jamaah-details" data-jamaah="{{ json_encode($jamaah) }}">
                                        <td>{{ $jamaah['nama_lengkap'] }}</td>
                                        <td>{{ $jamaah['nama_relasi'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success add-member" onclick="addRoleJamaah('{{ $jamaah['no_ktp']}}', '{{ $jamaah['nama_lengkap'] }}', '{{ $jamaah['no_telp'] }}', '{{ $jamaah['email'] }}', '{{ $jamaah['nama_relasi'] }}')">Pilih Ketua</button>
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
        <!-- Your modal HTML structure -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 720px">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Jamaah Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="jamaahTable" class="display" style="width: 100%">
                            <thead>
                                <tr>
                                    <td>No Ktp</td>
                                    <td>Nama Lengkap</td>
                                    <td>No. Telepon</td>
                                    <td style="display: none;">Email</td>
                                    <td style="display: none;">Nama Relasi</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jamaahs as $index => $jamaah)
                                    <tr class="jamaah-details" data-jamaah="{{ json_encode($jamaah) }}">
                                        <td>{{ $jamaah['no_ktp'] }}</td>
                                        <td>{{ $jamaah['nama_lengkap'] }}</td>
                                        <td>{{ $jamaah['no_telp'] }}</td>
                                        <td style="display: none;">{{ $jamaah['email'] }}</td>
                                        <td style="display: none;">{{ $jamaah['nama_relasi'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success add-member" onclick="addMemberFromJamaah('{{ $jamaah['no_ktp']}}', '{{ $jamaah['nama_lengkap'] }}', '{{ $jamaah['no_telp'] }}', '{{ $jamaah['email'] }}', '{{ $jamaah['nama_relasi'] }}')">Add Member</button>
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
        <script>
            function previewImage() {
                // Get the selected file input
                var input = document.getElementById('edited_foto');

                $('#foto').val(input.files[0].name);

                // Ensure a file is selected
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    // Set up the image preview
                    reader.onload = function (e) {
                        document.getElementById('previewImage').src = e.target.result;
                        $('#data_foto').val(e.target.result);
                    };

                    // Read the selected file as a data URL
                    reader.readAsDataURL(input.files[0]);
                }
            }

            let selectedMembers = [];

            $(document).ready(function() {
                $("#tanggal_lahir").datepicker({
                    dateFormat: 'yy-mm-dd',
                    autoclose: true,
                    minViewMode: "months",
                    todayHighlight: true
                });

                // Initialize DataTable
                $('#jamaahTable').DataTable({
                    paging: true,  // Enable pagination
                    searching: true,  // Enable searching
                    lengthMenu: [5],
                    scrollCollapse: true,
                    scrollY: '50vh'
                });

                $('#jamaahTable2').DataTable({
                    paging: true,  // Enable pagination
                    searching: true,  // Enable searching
                    lengthMenu: [5],
                    scrollCollapse: true,
                    scrollY: '50vh'
                });

                    // Event delegation for "Add to Members" button
                $('#jamaahTable tbody').on('click', 'button.add-member', function() {
                    // var rowIndex = table.row($(this).closest('tr')).index();
                    // addMemberFromJamaah(rowIndex);
                });


                // Handle province selection
                $('#provinsi').on('change', function () {
                    var provinceId = $(this).val();
                    if (provinceId) {
                        // Make AJAX request to fetch cities based on the selected province
                        $.ajax({
                            url: '/api/regencies/' + provinceId,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                // Update the city dropdown with fetched data
                                updateDropdown('kota', data);
                            },
                            error: function (error) {
                                console.error('Error fetching city data:', error);
                            }
                        });
                    } else {
                        // Clear city and district dropdowns if province is not selected
                        clearDropdown('kota');
                        clearDropdown('kecamatan');
                    }
                });

                // Handle city selection
                $('#kota').on('change', function () {
                    var cityId = $(this).val();
                    // console.log(cityId)
                    if (cityId) {
                        // Make AJAX request to fetch districts based on the selected city
                        $.ajax({
                            url: '/api/districts/' + cityId,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                // Update the district dropdown with fetched data
                                updateDropdown('kecamatan', data);
                            },
                            error: function (error) {
                                console.error('Error fetching district data:', error);
                            }
                        });
                    } else {
                        // Clear district dropdown if city is not selected
                        clearDropdown('kecamatan');
                    }
                });

                // Handle city selection
                $('#kecamatan').on('change', function () {
                    var idKecamatan = $(this).val();
                    // console.log(idKecamatan)
                    if (idKecamatan) {
                        // Make AJAX request to fetch districts based on the selected city
                        $.ajax({
                            url: '/api/villages/' + idKecamatan,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                // Update the district dropdown with fetched data
                                updateDropdown('kelurahan', data);
                            },
                            error: function (error) {
                                console.error('Error fetching district data:', error);
                            }
                        });
                    } else {
                        // Clear district dropdown if city is not selected
                        clearDropdown('kelurahan');
                    }
                });

                // Function to update dropdown options
                function updateDropdown(dropdownId, data) {
                    var dropdown = $('#' + dropdownId);
                    dropdown.empty();
                    dropdown.append('<option value="">-- Pilih ' + capitalizeFirstLetter(dropdownId) + ' --</option>');

                    $.each(data, function (key, value) {
                        dropdown.append('<option value="' + value['id'] + '">' + value['name'] + '</option>');
                    });
                }

                // Function to clear dropdown options
                function clearDropdown(dropdownId) {
                    $('#' + dropdownId).empty();
                    $('#' + dropdownId).append('<option value="">-- Pilih ' + capitalizeFirstLetter(dropdownId) + ' --</option>');
                }

                // Function to capitalize the first letter of a string
                function capitalizeFirstLetter(string) {
                    return string.charAt(0).toUpperCase() + string.slice(1);
                }
            });

            let memberRowCount = 1;

            function isMemberSelected(email) {
                // Check if the member is already selected
                return selectedMembers.includes(email);
            }

            function addMemberRow() {
                const tableBody = document.getElementById('membersTable').getElementsByTagName('tbody')[0];
                const newRow = tableBody.insertRow();
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);
                const cell4 = newRow.insertCell(3);
                const cell5 = newRow.insertCell(4);
                const cell6 = newRow.insertCell(5);
                const cell7 = newRow.insertCell(6);

                cell1.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][no_ktp]">`;
                cell2.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][nama_lengkap]">`;
                cell3.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][no_telp]">`;
                cell4.innerHTML = `<input type="email" class="form-control form-control-sm" readonly name="members[${memberRowCount}][email]">`;
                cell5.innerHTML = `<input type="text" class="form-control form-control-sm" readonly name="members[${memberRowCount}][nama_relasi]">`;
                cell6.innerHTML = `<button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Pilih Jamaah</button>`;
                cell7.innerHTML = `<button type="button" class="btn btn-sm btn-danger" onclick="deleteMemberRow(this)">Delete</button>`;
                // Add more cells if needed

                // selectedMembers.push(jamaahDetails.email);

                memberRowCount++;

                // Enable the delete button for the new row
                const deleteButton = newRow.querySelector('.btn-danger');
                deleteButton.removeAttribute('disabled');
            }

            function deleteMemberRow(button) {
                const tableBody = document.getElementById('membersTable').getElementsByTagName('tbody')[0];
                const row = button.parentNode.parentNode;

                // Check if the row is the only remaining row
                if (tableBody.rows.length > 1) {
                    tableBody.removeChild(row);
                } else {
                    // Display an alert or handle the case where the row cannot be deleted
                    alert('Cannot delete the last row.');
                }
            }

            function addMemberFromJamaah(noKtp,namaLengkap, noTelp, email, namaRelasi) {
                if (isMemberSelected(email)) {
                    alert('Member Jamaah sudah .');
                    return false;
                }
                // Append a new row to the members table with Jamaah details
                var newRow = '<tr>' +
                    '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][no_ktp]" value="' + noKtp + '"></td>' +
                    '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][nama_lengkap]" value="' + namaLengkap + '"></td>' +
                    '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][no_telp]" value="' + noTelp + '"></td>' +
                    '<td><input type="email" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][email]" value="' + email + '"></td>' +
                    '<td><input type="text" class="form-control form-control-sm" readonly name="members[' + memberRowCount + '][nama_relasi]" value="' + namaRelasi + '"></td>' +
                    '<td><button type="button" class="btn btn-sm btn-danger" onclick="deleteMemberRow(this)">Delete</button></td>' +
                    '</tr>';
                $('#membersTable tbody').append(newRow);
                selectedMembers.push(email);
                memberRowCount++;
                $('#exampleModal').modal('hide');
            }

            function addRoleJamaah(noKtp,namaLengkap, noTelp, email, namaRelasi) {
            console.log(namaRelasi)
                $('#nama_relasi').val(namaRelasi);
                $('#exRole').modal('hide');
            }
        </script>
    @endsection
@endif
