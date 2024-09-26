<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark">
            {{ __('Upload CSV') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="bg-white shadow rounded">
                <div class="p-4 text-dark">
                    <form id="submitForm" action="{{ route('csv.process') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="csv_file" class="form-label">Choose CSV</label>
                            <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
                        </div>
                        <button type="submit" class="btn btn-secondary mt-3">Subir archivo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay Loader -->
    <div id="loaderOverlay" class="loader-overlay d-none">
        <div class="text-center">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <div class="mt-3 text-light">
                Procesando archivo, por favor espere...
            </div>
        </div>
    </div>

    <!-- JavaScript para mostrar el loader al enviar el formulario -->
    <script>
        document.getElementById('submitForm').addEventListener('submit', function() {
            // Mostrar el overlay loader
            document.getElementById('loaderOverlay').classList.remove('d-none');

            // Deshabilitar el botón para evitar múltiples envíos
            this.querySelector('button[type="submit"]').disabled = true;
        });
    </script>

    <!-- Estilos personalizados para el loader -->
    <style>
        /* Overlay que cubre toda la pantalla */
        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Asegurarse de que esté sobre todo */
        }

        /* Hacer que el loader no se muestre inicialmente */
        .d-none {
            display: none;
        }

        /* Estilo del spinner */
        .spinner-border {
            width: 4rem;
            height: 4rem;
        }

        /* Texto del loader */
        .text-light {
            color: #fff;
        }
    </style>
</x-app-layout>
