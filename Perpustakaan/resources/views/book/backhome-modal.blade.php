<!-- Backhome Modal-->
<div class="modal fade" id="modalBackHome" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Konfirmasi') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Anda yakin akan kembali ke halaman utama?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('Batal') }}</button>
                <a href="{{ route('book.index') }}" class="btn btn-primary">{{ __('Kembali') }}</a>
            </div>
        </div>
    </div>
</div>