$(document).ready(function(){
    $('#receiver_account').on('blur', function(){
        var accountNumber = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/ajax/receiver',
            data: {account_number: accountNumber},
            success: function(response){
                if(response.user_name) {
                    var receiverInput = `
                        <div class="form-group row" id="receiver-group">
                            <label class="col-sm-3 col-form-label ml-5" for="receiver">Người nhận</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="receiver" name="receiver" value="${response.user_name}" readonly>
                                <input type="hidden" id="receiver_id" name="receiver_id" value="${response.user_id}">
                            </div>
                        </div>`;
                    $('#receiver-group').remove();
                    $('#receiver_block').after(receiverInput);
                    $('#receiver-error').remove();
                } else {
                    var errorMessage = '<small id="receiver-error" class="text-danger">Không có tài khoản này</small>';
                    $('#receiver-error').remove();
                    $('#receiver-group').remove();
                    $('#receiver_account').after(errorMessage);
                }
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    });

    handleFormSubmit('transactionForm', 'otpPopup');
    handleFormSubmit('approveForm', 'otpPopup');

    var otpVerified = false;

    function sendOTP(email, token, callback) {
        $.ajax({
            type: 'POST',
            url: '/ajax/send-otp',
            data: {
                _token: token,
                email: email,
            },
            success: function(response) {
                callback(response);
            },
            error: function(xhr, status, error) {
                console.error('Error sending OTP:', error);
                callback({ success: false });
            }
        });
    }

    function verifyOTP(otp, token, callback) {
        $.ajax({
            type: 'POST',
            url: '/ajax/verify-otp',
            data: {
                otp: otp,
                _token: token
            },
            success: function(response) {
                callback(response);
            },
            error: function(xhr, status, error) {
                callback({ success: false });
            }
        });
    }

    function handleFormSubmit(formId, otpPopupId) {
        $('#' + formId).submit(function (e) {
            if (!otpVerified) {
                e.preventDefault();
                $('#' + otpPopupId).modal('show');
                var email = $('#' + formId + ' input[name="email"]').val();
                var token = $('#' + formId + ' input[name="_token"]').val();
                sendOTP(email, token, function(response) {
                    if (response.success) {
                        var message = '<small id="message" class="text-success">Đã gửi OTP</small>';
                        $('#message').remove();
                        $('#otpInput').after(message);
                    } else {
                        var message = '<small id="message" class="text-danger">Gửi OTP thất bại, vui lòng gửi lại đơn</small>';
                        $('#message').remove();
                        $('#otpSubmitBtn').remove();
                        $('#otpInput').after(message);
                    }
                });
            }
        });
    }

    $('#otpSubmitBtn').click(function() {
        var otp = $('#otpInput').val();
        var token = $('#token').val();

        verifyOTP(otp, token, function(response) {
            if (response.success) {
                otpVerified = true;
                $('#otpPopup').modal('hide');
                $('#transactionForm').off('submit').submit();
                $('#approveForm').off('submit').submit();
            } else {
                var message = '<small id="message" class="text-danger">Xác thực thất bại, vui lòng thử lại</small>';
                $('#message').remove();
                $('#otpInput').after(message);
            }
        });
    });

    // let otpVerified = false;
    //
    // $('#transactionForm').submit(function (e) {
    //     if (!otpVerified) {
    //         e.preventDefault();
    //         $('#otpPopup').modal('show');
    //         var email = $('input[name="email"]').val();
    //         var token = $('input[name="_token"]').val();
    //         sendOTP(email, token, function(response) {
    //             if (response.success) {
    //                 var message = '<small id="message" class="text-success">Đã gửi OTP</small>';
    //                 $('#message').remove();
    //                 $('#otpInput').after(message);
    //             } else {
    //                 var message = '<small id="message" class="text-danger">Gửi OTP thất bại, vui lòng gửi lại đơn</small>';
    //                 $('#message').remove();
    //                 $('#otpSubmitBtn').remove();
    //                 $('#otpInput').after(message);
    //             }
    //         });
    //     }
    // });
    //
    // function sendOTP(email, token, callback) {
    //     $.ajax({
    //         type: 'POST',
    //         url: '/ajax/send-otp',
    //         data: {
    //             _token: token,
    //             email: email,
    //         },
    //         success: function(response) {
    //             callback(response);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error sending OTP:', error);
    //             callback({ success: false });
    //         }
    //     });
    // }
    //
    // $('#otpSubmitBtn').click(function() {
    //     var otp = $('#otpInput').val();
    //     var token = $('#token').val();
    //
    //     verifyOTP(otp, token, function(response) {
    //         if (response.success) {
    //             otpVerified = true;
    //             $('#otpPopup').modal('hide');
    //             $('#transactionForm').off('submit').submit();
    //         } else {
    //             var message = '<small id="message" class="text-danger">Xác thực thất bại, vui lòng thử lại</small>';
    //             $('#message').remove();
    //             $('#otpInput').after(message);
    //         }
    //     });
    // });
    //
    // function verifyOTP(otp, token, callback) {
    //     $.ajax({
    //         type: 'POST',
    //         url: '/ajax/verify-otp',
    //         data: {
    //             otp: otp,
    //             _token: token
    //         },
    //         success: function(response) {
    //             callback(response);
    //         },
    //         error: function(xhr, status, error) {
    //             callback({ success: false });
    //         }
    //     });
    // }
});

