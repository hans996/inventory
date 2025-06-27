<div>
<!-- Modal -->
    <div  wire:ignore.self class="modal fade " id="backDropModalP" data-bs-backdrop="static" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-body d-flex justify-content-center mt-4 align-items-center ">
                <div class="text-center">
                    <i class="fa-solid fa-5x fa-triangle-exclamation mb-2"></i>
                    <h5 class="text-muted">Update status ?</h5>
                </div>
            </div>
            <form wire:submit.prevent="update">
                @csrf
                <input type="hidden" wire:model.defer="requestId">
                <div class="modal-footer d-flex justify-content-between align-items-center">

                    <button wire:loading wire:loading.attr="disabled" class="btn btn-outline-secondary float-end" data-bs-dismiss="modal">
                        <span class="spinner-border spinner-border-sm text-secondary mx-3" role="status"></span>
                    </button>
                    <div wire:loading.remove>
                        <button type="reset" wire:click="cancel()" class="btn btn-outline-secondary float-end" data-bs-dismiss="modal">Batal</button>
                    </div>


                    <button wire:loading wire:loading.attr="disabled" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm text-white mx-3" role="status"></span>
                    </button> 
                    <div wire:loading.remove>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
