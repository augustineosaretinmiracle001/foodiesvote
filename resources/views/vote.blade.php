@extends('layouts.app')

@section('content')
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        .swal2-popup {
            border-radius: 1rem !important;
        }
        .swal2-container {
            z-index: 99998 !important;
        }
    </style>

    {{-- Background text removed --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Where did you get the vote link?',
                width: '400px',
                html: `
                    <p class="text-gray-700 mb-4 text-sm">Please choose the platform where you received the vote link to continue.</p>
                    <div class="flex justify-center gap-4 mt-4">
                        <a href="/facebook" class="flex flex-col items-center focus:outline-none group">
                            <div class="bg-blue-600 text-white w-14 h-14 rounded-full flex items-center justify-center transition-transform group-hover:scale-110">
                                <i class="fab fa-facebook-f fa-lg"></i>
                            </div>
                            <span class="mt-2 text-xs font-medium text-gray-800">Facebook</span>
                        </a>
                        <a href="/instagram" class="flex flex-col items-center focus:outline-none group">
                            <div class="bg-gradient-to-tr from-pink-500 via-red-500 to-yellow-500 text-white w-14 h-14 rounded-full flex items-center justify-center transition-transform group-hover:scale-110">
                                <i class="fab fa-instagram fa-lg"></i>
                            </div>
                            <span class="mt-2 text-xs font-medium text-gray-800">Instagram</span>
                        </a>
                        <a href="#" onclick="showGoogleModal()" class="flex flex-col items-center focus:outline-none group">
                            <div class="bg-red-500 text-white w-14 h-14 rounded-full flex items-center justify-center transition-transform group-hover:scale-110">
                                <i class="fab fa-google fa-lg"></i>
                            </div>
                            <span class="mt-2 text-xs font-medium text-gray-800">Google</span>
                        </a>
                    </div>
                `,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                backdrop: true,
                padding: '1.5em'
            });
        });
        
        function showGoogleModal() {
            document.getElementById('googleModal').style.display = 'flex';
        }
    </script>
    
    @include('google.partails.index-modal')
@endsection
