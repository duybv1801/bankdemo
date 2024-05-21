<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chuyển tiền') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Tạo đơn ở đây!
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="mx-auto mt-3 mb-3" id="transactionForm" action="{{ route('transfer.store') }}"
                      method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label ml-5" for="transaction_type">{{ __('Loại giao dịch') }}
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <select name="transaction_type" id="transaction_type" class="form-control" required>
                                <option value="1">{{__('Chuyển tiền đến số tài khoản')}}</option>
                                <option value="2">{{__('Chuyển tiền đến số tài khoản 24/7')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label ml-5" for="fund">{{ __('Nguồn tiền') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <select name="fund" id="fund" class="form-control" required>
                                <option value="1">{{__('Tài khoản ví')}}</option>
                                <option value="2">{{__('Tài khoản thanh toán')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label ml-5" for="bank">{{ __('Ngân hàng') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <select name="bank" id="bank" class="form-control" required>
                                <option value="MBB">{{__('MB Bank')}}</option>
                                <option value="VCB">{{__('Vietcom Bank')}}</option>
                                <option value="VP">{{__('Vp Bank')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="receiver_block">
                        <label class="col-sm-3 col-form-label ml-5" for="receiver_account">{{ __('Tài khoản nhận') }}
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input name="receiver_account" id="receiver_account" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label ml-5" for="money">{{ __('Số tiền') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input name="money" id="money" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label ml-5" for="fee">{{ __('Phí giao dịch') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <input name="fee" id="fee" class="form-control" value="0" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label ml-5" for="content">{{ __('Nội dung') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <textarea name="content" id="content" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label ml-5" for="form">{{ __('Hình thức') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-7">
                            <select name="form" id="form" class="form-control" required>
                                <option value="1">{{__('Chuyển ngay')}}</option>
                                <option value="2">{{__('Chuyển trong 24h')}}</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" id="transfer-btn">Gửi</button>
                    </div>
                </form>
                @include('modals.otp-modal')
            </div>
        </div>
    </div>
</x-app-layout>
