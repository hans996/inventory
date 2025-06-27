<div class="col-xl">

<div class="card mb-4">
    <div class="card-widget-separator-wrapper">
        <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-1 border-end border-sm-0 pb-3 pb-sm-0">
                        <div>
                            <h3 class="mb-1">{{ $totalItem }}</h3>
                            <p class="mb-0">Pengajuan</p>
                        </div>
                        <div class="avatar me-sm-4">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class='bx bx-align-justify bx-sm'></i>
                            </span>
                        </div>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none me-4">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start card-widget-2 border-end border-sm-0 pb-3 pb-sm-0">
                        <div>
                            <h3 class="mb-1">{{ $pending }}</h3>
                            <p class="mb-0">Pending</p>
                        </div>
                        <div class="avatar me-lg-4">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class='bx bx-list-plus bx-sm'></i>
                            </span>
                        </div>
                    </div>
                    <hr class="d-none d-sm-block d-lg-none">
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start border-end border-sm-0 pb-3 pb-sm-0 card-widget-3">
                        <div>
                            <h3 class="mb-1">{{ $proses }}</h3>
                            <p class="mb-0">Proses</p>
                        </div>
                        <div class="avatar me-sm-4">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class='bx bx-list-check bx-sm'></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex justify-content-between align-items-start border-sm-0">
                        <div>
                            <h3 class="mb-1">{{ $selesai }}</h3>
                            <p class="mb-0">Selesai</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-secondary">
                                <i class='bx bx-check-double bx-sm'></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="card mb-3">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Pengajuan Saya</h5>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group" role="group" aria-label="First group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <i class='bx bx-file-blank bx-xs' ></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <i class='bx bx-printer bx-xs' ></i>
                    </button>
                </div>
            </div>
        </div>
        <hr class="mt-0 mb-3">

        <div class="mx-4 mb-3 d-flex align-items-center justify-content-between">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <select wire:model.live="perPage" class="form-select">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                </div>
                <div class="d-flex align-items-center ms-2">
                    <select class="form-select" wire:model.live="filterPageStatus" aria-label="Default select example">
                        <option selected value="">
                            --All Status--
                        </option>
                        <option value="1">
                            Pending
                        </option>
                        <option value="2">
                            Diproses
                        </option>
                        <option value="3">
                            Selesai
                        </option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="input-group input-group-merge px-4 mb-3">
            <span class="input-group-text" ><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" wire:model="search" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" />
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th class="text-end">Jumlah</th>
                        <th class="text-center">Jenis</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Detail</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($submissions as $index => $submission)
                        <tr>
                            <td>{{ $submissions->firstItem() + $index }}</td>
                            <td>
                                <span class="fw-medium">{{ $submission->kode_permintaan }}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $submission->inventory->name }}</span>
                            </td>
                            <td class=" text-end">
                                <span class="fw-medium">{{ $submission->jumlah }} pcs</span>
                            </td>
                            <td class="text-center">
                                @if ( $submission->inventory->jenis == '1' )
                                    <span class="badge rounded-pill bg-label-primary">Sarana</span>
                                @elseif( $submission->inventory->jenis == '2' )
                                    <span class="badge rounded-pill bg-label-success">Prasarana</span>
                                @elseif ($submission->inventory->jenis == '3')
                                    <span class="badge rounded-pill bg-label-info">Lainnya</span>
                                @else
                                    <span class="badge rounded-pill bg-label-secondary">nothing</span>
                                @endif
                            </td>
                            <td class="text-center">  
                                @if ( $submission->status == '1' )
                                    <span class="badge bg-warning">pending</span>
                                @elseif ( $submission->status == '2' ) 
                                    <span class="badge bg-info">diproses</span>
                                @elseif ( $submission->status == '3' ) 
                                    <span class="badge bg-success">selesai</span>
                                @else
                                    <span class="badge bg-secondary">nothing</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button wire:click="getId({{ $submission->id }})" type="button" class="btn btn-sm btn-icon btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#backDropModal">
                                    <span class="tf-icons bx bx-show"></span>
                                </button>
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
                <small class="pagination-sm">{{ $submissions->links() }}</small>
            </div>
        </caption>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content my-0">
                <div class="modal-header border-bottom d-flex justify-content-center py-4">
                    <h4 class="modal-title" id="backDropModalTitle">Detail</h4>
                </div>
            <div class="modal-body mb-0">

                    <ul class="list-unstyled mb-0">
                        <li>
                            <span class="fw-medium">Status :
                            <span class="mx-2">
                                @if ( $status == '1' )
                                    <span class="badge bg-warning">pending</span>
                                @elseif ( $status == '2' ) 
                                    <span class="badge bg-info">diproses</span>
                                @elseif ( $status == '3' ) 
                                    <span class="badge bg-success">selesai</span>
                                @else
                                    <span class="badge bg-secondary">nothing</span>
                                @endif
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">ID :
                                <span class="mx-2">
                                    {{ $kode_permintaan }}
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
                        <li>
                            <span class="fw-medium">Jumlah :
                            <span class="mx-2">
                                    {{ !empty($jumlah) ? $jumlah . ' pcs' : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Keterangan :
                            <span class="mx-2">
                                    {{ !empty($keterangan) ? $keterangan : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="my-2">
                        <li>
                            <span class="fw-medium">Jenis :
                                <span class="mx-2">
                                    @if ( $jenis == '1' )
                                        <span>Sarana</span>
                                    @elseif( $jenis == '2' )
                                        <span>Prasarana</span>
                                    @elseif ($jenis == '3')
                                        <span>Lainnya</span>
                                    @else
                                        <span>nothing</span>
                                    @endif
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
                        <li>
                            <span class="fw-medium">Diperbarui :
                            <span class="mx-2">
                                    {{ !empty($updated_at) ? $updated_at : '-' }}
                                </span>
                            </span>
                        </li>
                        <hr class="mb-0">
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