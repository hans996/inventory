<div class="row">
        @livewire('suplier-list')

        @if ($suplierUpdateStatus)
        @livewire('suplier-update')            
        @else
        @livewire('suplier-create')            
        @endif
</div>
