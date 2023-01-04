<div class="modal modal-child fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __($title) }}</h5>
                <button type="button"  class="btn-close btn-close-child" data-bs-dismiss="" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @yield('modal-body-child')
            </div>
            <div class="modal-footer">
                @yield('modal-footer')    
            </div>
        </div>
    </div>
</div>