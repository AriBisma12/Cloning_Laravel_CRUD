@extends('dashboard')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">TICKETS</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('ticket') }}">Tickets</a></li>
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
            <h5 class="mb-0">Form Edit Ticket</h5>
          </div>

          <div class="card-body">
            <form action="{{ route('ticket.update', $ticket->id) }}" method="POST">
              @csrf
              @method('PUT')

              {{-- dropdown event --}}
              <div class="form-group">
                <label class="font-weight-bold">Pilih Event</label>
                <select name="id_event" class="form-control @error('id_event') is-invalid @enderror">
                  <option value="">-- Pilih Event --</option>
                  @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ old('id_event', $ticket->id_event) == $event->id ? 'selected' : '' }}>
                      {{ $event->event_name }}
                    </option>
                  @endforeach
                </select>
                @error('id_event') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Jenis Tiket</label>
                  <input type="text"
                         name="ticket_type"
                         class="form-control @error('ticket_type') is-invalid @enderror"
                         value="{{ old('ticket_type', $ticket->ticket_type) }}"
                         placeholder="Contoh: VIP, Reguler">
                  @error('ticket_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-6">
                  <label class="font-weight-bold">Harga</label>
                  <input type="number"
                         name="price"
                         class="form-control @error('price') is-invalid @enderror"
                         value="{{ old('price', $ticket->price) }}"
                         min="0" step="1"
                         placeholder="Masukkan Harga">
                  @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="text-right">
                <button type="submit" class="btn btn-success">UPDATE</button>
                <a href="{{ route('ticket.index') }}" class="btn btn-secondary">KEMBALI</a>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection