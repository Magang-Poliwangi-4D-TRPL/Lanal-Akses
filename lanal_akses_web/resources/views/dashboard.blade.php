<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg d-flex p-auto">
                @if (Auth::check() && Auth::user()->hasRole('admin|pasmin|kaakun|paspotmar|pasintel|kasatkom|pasprogar|danposal|paset|komandan|palaksa'))
                
                <a href="{{ route('admin.dashboard') }}" class="link col-md-4 col-sm-4">
                    <div class="p-6 bg-white">
                        <img src="{{ URL::asset('images/admin/dashboard-admin.png') }}" alt="" srcset="" width="100%">
                    </div>
                    <p class="text-center">Dashboard Admin </p>
                </a>
                <a href="{{ route('personil.dashboard') }}" class="link col-md-4 col-sm-4">
                    <div class="p-6 bg-white">
                        <img src="{{ URL::asset('images/admin/dashboard-admin.png') }}" alt="" srcset="" width="100%">
                    </div>
                    <p class="text-center">Dashboard Personel</p>
                </a>
                @elseif(Auth::check() && Auth::user()->hasRole('personel'))
                <a href="{{ route('personil.dashboard') }}" class="link col-md-4 col-sm-4">
                    <div class="p-6 bg-white">
                        <img src="{{ URL::asset('images/admin/dashboard-admin.png') }}" alt="" srcset="" width="100%">
                    </div>
                    <p class="text-center">Dashboard Personel</p>
                </a>
                
                @endif
                <p>{{ Auth::user()->hasRole('personil') }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
