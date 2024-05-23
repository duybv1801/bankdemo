<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trang chủ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Chưa có gì!
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Mã giao dịch')}}</strong></div>
                            <div class="col-md-8">{{ $bill->id }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Loại giao dịch')}}</strong></div>
                            <div class="col-md-8">{{__('transaction-type-' . $bill->transaction_type)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Nguồn tiền')}}</strong></div>
                            <div class="col-md-8">{{__('meta-type-' . $bill->fund)}} _ {{ $meta->accout_number }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Tài khoản nhận')}}</strong></div>
                            <div class="col-md-8">{{ $bill->receiver_account }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Người nhận')}}</strong></div>
                            <div class="col-md-8">{{ $bill->receiver->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Ngân hàng nhận')}}</strong></div>
                            <div class="col-md-8">{{ $bill->bank }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Số tiền')}}</strong></div>
                            <div class="col-md-8">{{ number_format($bill->money, 0, ',', '.') }}đ</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Phí giao dịch')}}</strong></div>
                            <div class="col-md-8">{{ number_format($bill->fee, 0, ',', '.') }}đ</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Tổng số tiền')}}</strong></div>
                            <div class="col-md-8">{{ number_format($bill->total_money, 0, ',', '.') }}đ</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Nội dung')}}</strong></div>
                            <div class="col-md-8">{{ $bill->content }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Hình thức chuyển')}}</strong></div>
                            <div class="col-md-8">{{__('form-type-' . $bill->form)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Người tạo')}}</strong></div>
                            <div class="col-md-8">{{ $bill->creator->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Ngày tạo')}}</strong></div>
                            <div class="col-md-8">{{ $bill->created_at }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Cấp duyệt')}}</strong></div>
                            <div class="col-md-8">{{ $bill->approve_level }}/1</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-3"><strong>{{__('Trạng thái duyệt')}}</strong></div>
                            <div class="col-md-8">{{__('status-' . $bill->status)}}</div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center mt-3">
                    <form method="POST" action="{{ route('approve.update', $bill->id) }}" class="d-inline-block" id="approveForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                        <input type="hidden" name="status" value="2">
                        <input type="hidden" name="money" value="{{ $bill->money }}">
                        <input type="hidden" name="total_money" value="{{ $bill->total_money }}">
                        <input type="hidden" name="sender" value="{{ $meta->accout_number }}">
                        <input type="hidden" name="receiver" value="{{ $bill->receiver_account }}">

                        <button type="submit" class="btn btn-success mail-btn">{{ __('Đồng ý') }}</button>
                    </form>
                    <button class="btn btn-danger d-inline-block ml-2" data-toggle="modal" type="submit"
                            data-target="#cancelModal" data-id="{{ $bill->id }}">
                        {{ __('Từ chối') }}
                    </button>
                </div>
                @include('modals.otp-modal')
                @include('modals.reject-modal')
            </div>
        </div>
    </div>
</x-app-layout>
