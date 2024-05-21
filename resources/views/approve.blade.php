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
                @if (session('status'))
                    <div class="alert alert-{{ session('status') }}">
                        {{ session('message') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{__('Mã giao dịch')}}</th>
                        <th>{{__('Loại giao dịch')}}</th>
                        <th>{{__('Người nhận')}}</th>
                        <th>{{__('Tổng số tiền')}}</th>
                        <th>{{__('Hình thức chuyển')}}</th>
                        <th>{{__('Người tạo')}}</th>
                        <th>{{__('Ngày tạo')}}</th>
                        <th>{{__('Cấp duyệt')}}</th>
                        <th>{{__('Trạng thái duyệt')}}</th>
                        <th>{{__('Chức năng')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($datas as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{__('transaction-type-' . $data->transaction_type)}}</td>
                            <td>{{ $data->receiver->name }}</td>
                            <td>{{ number_format($data->total_money, 0, ',', '.') }}đ</td>
                            <td>{{__('form-type-' . $data->form)}}</td>
                            <td>{{ $data->creator->name }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>{{ $data->approve_level }}/1</td>
                            <td>
                                <span class="{{__('status_class-' . $data->status)}} ">
                                    {{__('status-' . $data->status)}}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    @if ($data->status == 1)
                                        <a href="{!! route('approve.edit', [$data->id]) !!}" class="btn btn-primary btn-sm">
                                            <i class="glyphicon glyphicon-edit"></i>{{ __('Approve') }}
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">Chưa có dữ liệu.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
