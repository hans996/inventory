@extends('layouts.main-layout')
{{-- @include('layouts.components.menu') --}}


@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

<div class="col-xl">
  <div class="card mb-3">
      <h5 class="card-header">Data Ruang</h5>
      <hr class="mt-0 mb-0">

      <div class="card-body">
        <form action="{{ url('data-ruang', $data->id) }}" method='post'>
            @csrf
            @method('PUT')
              <div class="row">
                  <div class="mb-3 col-md-6">
                      <label class="form-label" for="basic-default-fullname">Nama</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" id="name">

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <span>{{ $message }}</span>
                          </span>
                      @enderror
                  </div>
                  <div class="mb-3 col-md-6">
                      <label class="form-label" for="basic-default-fullname">Jumlah</label>
                      <input name="jumlah" id="jumlah" type="number" min="1" class="form-control  @error('jumlah') is-invalid @enderror" value="{{ $data->jumlah }}">

                      @error('jumlah')
                          <span class="invalid-feedback" role="alert">
                              <span>{{ $message }}</span>
                          </span>
                      @enderror
                  </div>
                  <div class="mb-3 col-md-6">
                      <label class="form-label" for="basic-default-fullname">Jenis</label>

                      <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror" value="{{ $data->jenis }}">
                          <option value="2">Prasarana</option>
                        <option value="1">Sarana</option>
                          <option value="3">Lainnya</option>
                      </select>

                      @error('jenis')
                          <span class="invalid-feedback" role="alert">
                              <span>{{ $message }}</span>
                          </span>
                      @enderror
                  </div>
                
                  <div class="mb-3 col-md-6">
                      <label class="form-label" for="basic-default-fullname">Lokasi</label>
                      <input type="text" name="lokasi" id="lokasi" class="form-control     @error('lokasi') is-invalid @enderror" value="{{ $data->lokasi }}"> 
                      @error('lokasi')
                          <span class="invalid-feedback" role="alert">
                              <span>{{ $message }}</span>
                          </span>
                      @enderror
                  </div>
                  <div class="mb-3 col-md-6">
                      <label class="form-label" for="basic-default-fullname">Keterangan</label>
                      <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ $data->keterangan }}">{{ $data->keterangan }}</textarea>

                      @error('keterangan')
                          <span class="invalid-feedback" role="alert">
                              <span>{{ $message }}</span>
                          </span>
                      @enderror
                  </div>
              </div>
              <button type="submit" class="float-end btn btn-primary">ubah</button>

              {{-- <button type="submit" wire:loading wire:loading.attr="disabled" class="float-end btn btn-primary">
                  <span class="spinner-border spinner-border-sm text-white mx-4" role="status"></span>
              </button>
              <button wire:loading.remove type="submit" class="float-end btn btn-primary">
                  <span>ubah</span>
              </button> --}}
          </form>
      </div>
  </div>
</div>

</div>

@endsection