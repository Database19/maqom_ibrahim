@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header><h3>Daftar Umrah</h3></header>
                {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p>Content for Home tab.</p>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p>Content for Profile tab.</p>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p>Content for Contact tab.</p>
                    </div>
                </div> --}}

                <form method="POST" action="{{ route('daftar-umrah.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @php $fieldCount = 0; @endphp
                        @foreach ($daftarUmrahFields as $field)
                            @php $fieldCount++; @endphp
                            <div class="col-md-6">
                                @if ($field == 'jamaah_id')
                                <label>Jamaah:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" hidden readonly name="{{ $field }}" id="{{ $field }}">
                                    <input type="text" class="form-control form-control-sm" readonly name="nama_jamaah" id="nama_jamaah">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exJamaah">Pilih Jamaah</button>
                                    </div>
                                </div>
                                @elseif ($field == 'no_pendaftaran')
                                    <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                    <input type="text" name="{{ $field }}" id="{{ $field }}" placeholder="Generate By System" class="form-control form-control-sm" readonly>
                                @elseif ($field == 'tanggal_pendaftaran')
                                    <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                    <input type="date" name="{{ $field }}" id="{{ $field }}" class="form-control form-control-sm" readonly>
                                @elseif ($field == 'rencana_keberangkatan')
                                    <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                    <input type="date" name="{{ $field }}" id="{{ $field }}" class="form-control form-control-sm" readonly>
                                @elseif ($field == 'kode_paket_umrah')
                                    <label>Paket Umroh:</label>
                                    <select name="{{ $field }}" id="{{ $field }}" class="form-control form-control-sm">
                                        <option value="">Pilih Paket Umroh</option>
                                        @foreach ($paketUmrah as $paket)
                                            <option value="{{ $paket->kode_paket }}">{{ $paket->nama_paket }}</option>
                                        @endforeach
                                    </select>
                                {{-- @elseif ($field == 'jenis_identitas')
                                    <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                    <select name="{{ $field }}" id="{{ $field }}" class="form-control form-control-sm">
                                        <option value="">Pilih Jenis Identitas</option>
                                        <option value="ktp">KTP</option>
                                        <option value="kitas">KITAS</option>
                                        <option value="kitap">KITAP</option>
                                        <option value="paspor">PASPOR</option>
                                    </select> --}}
                                @elseif ($field == 'jenis_bayar')
                                <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_bayar" id="jenis_bayar1">
                                        <label class="form-check-label" for="jenis_bayar1">
                                          Cash
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_bayar" id="jenis_bayar2" checked>
                                        <label class="form-check-label" for="jenis_bayar2">
                                          Transfer
                                        </label>
                                      </div>
                                </div>
                                @elseif ($field == 'tipe_bayar')
                                <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipe_bayar" id="tipe_bayar1">
                                        <label class="form-check-label" for="tipe_bayar1">
                                          DP
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipe_bayar" id="tipe_bayar2" checked>
                                        <label class="form-check-label" for="tipe_bayar2">
                                          Tunai
                                        </label>
                                      </div>
                                </div>
                                @else
                                    <label>{{ ucwords(str_replace('_', ' ', $field)) }}:</label>
                                    <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control form-control-sm">
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary mt-2">Daftar</button>
                </form>
            </div>
        </div>
    </div>

    <x-modal-component
        title="Pilih Jamaah"
        id="exJamaah"
        tableId="jamaahTable"
        :listData="$jamaah"
        :columns="$jamaahFields"
    />

    <script>
        $(document).ready(function() {
            $("#tanggal_pendaftaran").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });

            $('#kode_paket_umrah').on('change', function () {
                    var kodePaket = $(this).val();
                    if (kodePaket) {
                        $.ajax({
                            url: '/api/rencana-keberangkatan/' + kodePaket,
                            type: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                $('#rencana_keberangkatan').datepicker('setDate', data.tanggal_keberangkatan);
                            },
                            error: function (error) {
                                console.error('Terjadi kesalahan saat mengambil data rencana keberangkatan:', error);
                            }
                        });
                    }
                });

            $("#rencana_keberangkatan").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });
        })
    </script>
@endsection
