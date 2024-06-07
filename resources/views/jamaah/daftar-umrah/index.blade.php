@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-11">
        <h1>{{ __('Daftar Umrah') }}</h1>
    </div>
    <div class="col-sm-1">
        <a href="{{ route('daftar-umrah.create') }}" style="margin-top: 20px" class="btn btn-sm btn-primary float-right">Tambah</a>
    </div>
</div>
<br>
{{-- <div class="card-body"> --}}
@if ($jamaahs && $jamaahs->first())
<div class="table table-responsive card">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                    @foreach($jamaahs->first()->getAttributes() as $key => $value)
                        @if ($key !== 'id')
                            <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                        @endif
                    @endforeach

                <th style="text-align: center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jamaahs as $jamaah)
                <tr>
                    @foreach($jamaah->getAttributes() as $key => $value)
                        @if ($key !== 'id')
                            <td>{{ $value }}</td>
                        @endif
                    @endforeach
                    <td style="text-align: center">
                        <a href="{{ route('daftar-umrah.edit', $jamaah->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('daftar-umrah.destroy', $jamaah->id) }}" method="POST" style="display:inline;">
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
