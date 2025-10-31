@extends('dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">EVENTS</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('event') }}">Events</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">        
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Form Edit Event</h5>
                    </div>       
                    <div class="card-body"> 
                        <!-- Form untuk UPDATE -->
                        <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-bold">Nama Event</label>
                                    <input 
                                        type="text" 
                                        name="event_name" 
                                        class="form-control @error('event_name') is-invalid @enderror" 
                                        value="{{ old('event_name', $event->event_name) }}" 
                                        placeholder="Masukkan Nama Event">
                                    @error('event_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Lokasi</label>
                                    <input 
                                        type="text" 
                                        name="location" 
                                        class="form-control @error('location') is-invalid @enderror" 
                                        value="{{ old('location', $event->location) }}" 
                                        placeholder="Masukkan Lokasi">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Jumlah Kuota</label>
                                    <input 
                                        type="number" 
                                        name="quota" 
                                        class="form-control @error('quota') is-invalid @enderror" 
                                        value="{{ old('quota', $event->quota) }}" 
                                        placeholder="Masukkan Jumlah Kuota">
                                    @error('quota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-success">UPDATE</button>
                            </div>                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection