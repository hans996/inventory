<div>
        @if ($submissionUpdateStatus)
        @livewire('submission-update')
        @else
                @livewire('submission-create')
        @endif
        @livewire('submission-list')
</div>
