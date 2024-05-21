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
                    Xin chào, {{auth()->user()->name}}!
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{__('Nguồn tiền')}}</th>
                        <th>{{__('Số tài khoản')}}</th>
                        <th>{{__('Hạn mức tối đa')}}</th>
                        <th>{{__('Số dư')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($metas as $meta)
                        <tr>
                            <td>{{__('meta-type-' . $meta->accout_type)}}</td>
                            <td>{{ $meta->accout_number }}</td>
                            <td>{{ number_format($meta->transaction_limit, 0, ',', '.') }}đ</td>
                            <td>{{ number_format($meta->surplus, 0, ',', '.') }}đ</td>
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
