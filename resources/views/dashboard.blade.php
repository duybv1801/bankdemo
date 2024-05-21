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
            </div>
        </div>
    </div>
</x-app-layout>
