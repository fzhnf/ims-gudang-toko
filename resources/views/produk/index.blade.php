<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        @include('components.produk-tableview')
        <script>
            // Simpan URL halaman awal sebelum melakukan pencarian
            let originalUrl = document.location.href;

            // Fungsi untuk menampilkan tombol "Back"
            function showBackButton() {
                document.getElementById("backButton").classList.remove("hidden");
            }

            // Fungsi untuk menyembunyikan tombol "Back"
            function hideBackButton() {
                document.getElementById("backButton").classList.add("hidden");
            }

            // Fungsi untuk menghapus parameter pencarian dari URL
            function removeSearchParam() {
                const urlWithoutSearch = new URL(originalUrl);
                urlWithoutSearch.searchParams.delete("search");
                return urlWithoutSearch.toString();
            }

            // Cek apakah ada parameter pencarian pada URL, lalu tampilkan atau sembunyikan tombol "Back"
            document.addEventListener("DOMContentLoaded", function () {
                const searchParam = new URLSearchParams(window.location.search).get("search");
                if (searchParam) {
                    showBackButton();
                } else {
                    hideBackButton();
                }
            });

            // Fungsi untuk kembali ke halaman awal sebelum melakukan pencarian saat tombol "Back" diklik
            document.getElementById("backButton").addEventListener("click", function () {
                const urlWithoutSearch = removeSearchParam();
                window.location.href = urlWithoutSearch; // Kembali ke URL halaman awal sebelum melakukan pencarian
            });
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