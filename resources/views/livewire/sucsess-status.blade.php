<div>
<!-- Modal -->
    <div  wire:ignore.self class="modal fade " id="backDropModalS" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan barang ke inventory</h5>
                </div>
                <form wire:submit.prevent="update">
                    @csrf
                    <div class="modal-body d-flex justify-content-center mt-0 align-items-center ">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="basic-default-fullname">Nama</label>
                                <input disabled wire:model.defer="name" type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Nama">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="basic-default-fullname">Jumlah</label>
                                <input wire:model.defer="jumlah" type="number" class="form-control  @error('jumlah') is-invalid @enderror" placeholder="Jumlah">

                                @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="basic-default-fullname">Jenis</label>

                                <select wire:model.defer="jenis" class="form-select @error('jenis') is-invalid @enderror">
                                    <option>---Pilih jenis---</option>
                                    <option value="1">Sarana</option>
                                    <option value="2">Prasarana</option>
                                    <option value="3">Lainnya</option>
                                </select>

                                @error('jenis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="basic-default-fullname">Lokasi</label>
                                <input type="text" wire:model.defer="lokasi" class="form-control @error('lokasi') is-invalid @enderror" placeholder="Lokasi"></input>

                                @error('lokasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="basic-default-fullname">Keterangan</label>
                                <textarea wire:model.defer="keterangan" class="form-control     @error('keterangan') is-invalid @enderror" placeholder="Keterangan"></textarea>

                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button wire:loading wire:loading.attr="disabled" class="me-2 float-end btn btn-secondary">
                            <span class="spinner-border spinner-border-sm text-white mx-3" role="status"></span>
                        </button>
                        <div  wire:loading.remove>
                            <button type="reset" wire:click="cancel()" class="me-2 float-end btn btn-secondary" data-bs-dismiss="modal">
                                <span>Batal</span>
                            </button>
                        </div>

                        <button wire:loading wire:loading.attr="disabled" type="submit" class="float-end btn btn-primary">
                            <span class="spinner-border spinner-border-sm text-white mx-3" role="status"></span>
                        </button>
                        <button wire:loading.remove class="float-end btn btn-primary">
                            <span>Tambahkan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>