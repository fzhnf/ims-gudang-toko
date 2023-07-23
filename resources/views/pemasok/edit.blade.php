<x-app-layout>
    <x-slot name="slot">
        <button type="submit" onclick="window.location='{{ url('pemasok') }}'" class="text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-2 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-700 float-right mb-2">
            <i class="fa-solid fa-arrow-left pr-1"></i>Kembali
        </button>
        <h1 class="text-2xl font-semibold mb-2 text-green-600/100 dark:text-blue-500/100">Edit Pemasok</h1>
        <form method="POST" action="{{ url('pemasok/'.$txtid) }}"> 
        @csrf
        @method('PUT')
            <div class="mb-4">
                <label for="txtpemasok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pemasok</label>
                <input type="text" id="txtpemasok" name="txtpemasok" value="{{ $txtpemasok }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mb-6">
                <label for="txtdomisili" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domisili</label>
                <input type="text" id="txtdomisili" name="txtdomisili" value="{{ $txtdomisili }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-2 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-700">
                <i class="fa-solid fa-floppy-disk pr-1"></i>Save
            </button>
        </form>  
    </x-slot>   
</x-app-layout>
