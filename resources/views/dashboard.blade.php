<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <br>
                <div class="container-fluid">
                    Dashboard Amin
                </div>
                <br>
            </div>
        </div>
    </div>
    @section('footeradd')
    <script>
        // $(function () {
        //     $.LoadingOverlay("show", {
        //         imageAnimation: 'fadein',
        //         fade: [5, 5],
        //         progressSpeed: '9000',
        //         background: "rgba(60, 60, 60, 0.4)"
        //     });
        // });

    </script>
    @endsection
</x-app-layout>
