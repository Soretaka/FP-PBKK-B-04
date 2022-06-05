<!-- Delete Modal-->
<div class="modal fade" id="modalDelete-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Konfirmasi') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">{{ __('category.delete') }}<b>{{ $category->kategori_buku }}</b>?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('Batal') }}</button>
                <form action="{{ route('category.delete-data', $category->id) }}" method="POST">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <button class="btn btn-danger" type="submit">{{ __('Hapus') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>