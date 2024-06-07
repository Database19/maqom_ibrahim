@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-11">
        <h1>{{ __('Paket Umrah') }}</h1>
    </div>
    <div class="col-sm-1">
        <a href="{{ route('paket-umrah.create') }}" style="margin-top: 20px" class="btn btn-sm btn-primary float-right">Tambah</a>
    </div>
</div>
<br>
@if ($paketUmrah && $paketUmrah->first())
<div class="card">
    <table class="table table-hover">
        <thead>
            <tr>
                @foreach($paketUmrah->first()->getAttributes() as $key => $value)
                    @if ($key !== 'id')
                        <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                    @endif
                @endforeach
                <th style="text-align: center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paketUmrah as $jamaah)
                <tr>
                    @foreach($jamaah->getAttributes() as $key => $value)
                        @if ($key !== 'id')
                            <td>{{ $value }}</td>
                        @endif
                    @endforeach
                    <td style="text-align: center">
                        <a href="{{ route('paket-umrah.show', $jamaah->id) }}" class="btn btn-sm btn-secondary">View</a>
                        <a href="{{ route('paket-umrah.edit', $jamaah->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('paket-umrah.destroy', $jamaah->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
<div class="col-sm-12 text-center">
    <h1>Belum Ada Data</h1>
</div>
{{ $pagination->links() }}
{{-- </div> --}}
@endsection
