@extends('dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">EVENTS</h1>
                </div><div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('event') }}">Events</a>
                        </li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div></div></div></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">        
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Form Tambah Event</h5>
                        </div>       
                        <div class="card-body"> 
                            <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weightbold">Nama Event</label>
                                    <input type="text" class="form-control @error('event_name') is-invalid @enderror" name="event_name" value="{{ old('event_name') }}" placeholder="Masukkan Nama Event">
                                    @error('event_name')
                                    <div class="invalid-feedback">x
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weightbold">Lokasi</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{old('location') }}" placeholder="Masukkan Lokasi">
                                    @error('location')
                                    <div class="invalid-feedback">x
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            <div class="form-group col-md-6">
                                <label class="font-weightbold">Jumlah Kuota</label>
                                <input type="number" class="form-control @error('quota') is-invalid @enderror" name="quota" value="{{old('pages') }}" placeholder="Masukkan Jumlah Kuota">
                                @error('quota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            </div>
                            <div class="text-right">
                                <button  href="{{ route('event.store')}}" type="submit" class="btn btn-success">SIMPAN</button>
                            </div>                        
                        </form>
                    </div>
                    </div></div></div></div></div>
@endsection