<div class="row">
    @livewire('position-list')

    @if ($positionUpdateStatus)
        @livewire('position-update')
    @else
        @livewire('position-create')
    @endif
</div>
