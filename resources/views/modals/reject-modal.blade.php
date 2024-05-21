<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog"
     aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">
                    {{ __('Từ chối giao dịch') }}</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('approve.update', $bill->id) }}" >
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cancelReason">{{ __('Lý do từ chối') }}
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="cancelReason" name="reason" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="status" value="3">
                    <div class="form-group row text-center">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">{{ __('Xác nhận') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
