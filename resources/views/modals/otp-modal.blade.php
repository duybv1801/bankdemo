<div id="otpPopup" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nhập mã OTP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="otpInput" class="form-control" placeholder="Nhập mã OTP">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary otpSubmitBtn" id="otpSubmitBtn">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
