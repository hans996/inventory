
<div class="row">
@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush

@csrf

<div class="col-xl">
    <div class="card mb-3">
        <h5 class="card-header">Barang Masuk</h5>
        <hr class="mt-0 mb-0">

        <div class="card-body">
            <form action="{{ url('inventory', $data->id) }}" method='post'>
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Nama</label>
                        <input wire:model.defer="name" type="text" class="form-control  @error('name') is-invalid @enderror" value="{{ $data->name }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Jumlah</label>
                        <input wire:model.defer="jumlah" type="number" min="1" class="form-control  @error('jumlah') is-invalid @enderror" value="{{ $data->jumlah }}">

                        @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Jenis</label>

                        <select wire:model.defer="jenis" class="form-select @error('jenis') is-invalid @enderror" value="{{ $data->jenis }}">
                            <option value="1">Sarana</option>
                            <option value="2">Prasarana</option>
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
                        <input type="text" wire:model.defer="lokasi" class="form-control     @error('lokasi') is-invalid @enderror" value="{{ $data->lokasi }}"> 
                        @error('lokasi')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-fullname">Keterangan</label>
                        <textarea wire:model.defer="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ $data->keterangan }}"></textarea>

                        @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-danger">Ubah</button>

            </form>
        </div>
    </div>
</div>
</div>