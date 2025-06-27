@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush


<div class="col-xl">

    <div class="card mb-3">

        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Inventaris</h5>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group" role="group" aria-label="First group">
                    <button wire:click="generatePdf()" type="button" class="btn btn-sm btn-outline-secondary">
                        <i class='bx bx-printer bx-xs' ></i>
                    </button>
                </div>
            </div>
        </div>
        <hr class="mt-0 mb-3">
        <div class="card-header d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <select wire:model.live="perPage" class="form-select">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </div>
            </div>
        </div>

        
        <div class="input-group input-group-merge px-4 mb-3">
            <span class="input-group-text"><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" wire:model="search" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th class="text-end">Jumlah</th>
                        <th class="text-center">Jenis</th>
                        <th class="text-center">Masuk</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Detail</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($inventories as $index => $data)
                        <tr>
                            <td>{{ $inventories->firstItem() + $index }}</td>
                            <td>
                                <span class="fw-medium">{{ $data->kode_barang }}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $data->name }}</span>
                            </td>
                            <td class="text-end">
                                <span class="fw-medium">{{ $data->jumlah }} pcs</span>
                            </td>
                            <td class="text-center">
                                @if ( $data->jenis == '1' )
                                    <span class="badge rounded-pill bg-label-primary">Sarana</span>
                                @elseif( $data->jenis == '2' )
                                    <span class="badge rounded-pill bg-label-success">Prasarana</span>
                                @elseif ($data->jenis == '3')
                                    <span class="badge rounded-pill bg-label-info">Lainnya</span>
                                @else
                                    <span class="badge rounded-pill bg-label-secondary">nothing</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="fw-medium">{{ \Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM YYYY', 'ID') }}</span>
                            </td>

                            <td>
                                <span class="fw-medium">{{ $data->keterangan }}</span>
                            </td>
                            <td class="text-center"> 
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href='{{ url('inventory/'.$data->id.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                                    <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('inventory.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Del</button>
                                    </form>    
                                </div>
                            </td>
                        
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <h4 class="text-muted my-3">
                                Tidak ada data ditemukan !
                                </h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <caption>
            <div class="d-flex align-items-center justify-content-center mt-3">
                <small class="pagination-sm">{{ $inventories->links() }}</small>
            </div>
        </caption>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="backDropModalX" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content my-0">
                <div class="modal-header border-bottom d-flex justify-content-center py-4">
                    <h4 class="modal-title" id="backDropModalTitle">Detail</h4>
                </div>
            <div class="modal-body mb-0">

                    <ul class="list-unstyled mb-0">
                        <li>
                            <span class="fw-medium">ID :
                                <span class="mx-2">
                                    {{ $kode_barang }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Nama :
                                <span class="mx-2">
                                    {{ !empty($name) ? $name : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        {{--<li>
                            <span class="fw-medium">Nama :
                                <span class="mx-2">
                                    {{ !empty($suplier) ? $suplier : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        {{-- <li>
                            <span class="fw-medium">Jumlah :
                            <span class="mx-2">
                                    {{ !empty($user_id) ? $user_id . ' pcs' : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2"> --}}
                        <li>
                            <span class="fw-medium">Keterangan :
                            <span class="mx-2">
                                    {{ !empty($lokasi) ? $lokasi : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Dibuat :
                                <span class="mx-2">
                                    {{ $created_at }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        {{-- <li>
                            <span class="fw-medium">Diperbarui :
                            <span class="mx-2">
                                    {{ !empty($updated_at) ? $updated_at : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="mb-0"> --}}
                    </ul>

                @if ($kode_barang)
                    <div class="alert alert-primary mb-0 mt-3" role="alert">
                        Barang telah tersedia, cek inventaris. ID <span class="fw-bold">{{ $kode_barang }}</span>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="cancel()" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>

</div>