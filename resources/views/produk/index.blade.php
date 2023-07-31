<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>
    <script>
        function deleteData(name) {
            message = confirm(`Yakin ingin menghapus ${name}?`)
            if(message) return true
            else return false
        }
    </script>

    <x-slot name="slot">
        @include('components.produk-tableview')
        <script>
            function deleteData(name) {
                message = confirm(`Yakin ingin menghapus ${name}?`)
                if(message) return true
                else return false
            }
        </script>
    </x-slot>
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>