<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark">
            {{ __('Data Process') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="bg-white shadow rounded">
                <div class="p-4 text-dark">
                    <!-- Formulario -->
                    <form id="submitForm" action="{{ route('csv.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Selector múltiple para las columnas a eliminar -->
                        <div class="mb-3">
                            <label class="form-label">Selecciona las columnas que deseas eliminar:</label>

                            <select name="columns_to_drop[]" id="columns_to_drop" class="form-select" multiple size="5">
                                @foreach ($columns as $column)
                                    <option value="{{ $column }}">{{ $column }}</option>
                                @endforeach
                            </select>

                            <small class="form-text text-muted">
                                Mantén presionada la tecla <strong>Ctrl</strong> (Windows) o <strong>Cmd</strong> (Mac) para seleccionar múltiples columnas.
                            </small>
                        </div>

                        <!-- Campo n_clusters (Número) -->
                        <div class="mb-3">
                            <label for="n_clusters" class="form-label">Número de clusters</label>
                            <input type="number" class="form-control" id="n_clusters" name="n_clusters" required>
                        </div>

                        <!-- Radios normalizar? (Sí/No) -->
                        <div class="mb-3">
                            <label class="form-label">¿Normalizar?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="normalize" id="normalize_yes" value="1" required>
                                <label class="form-check-label" for="normalize_yes">Sí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="normalize" id="normalize_no" value="0" required>
                                <label class="form-check-label" for="normalize_no">No</label>
                            </div>
                        </div>

                        <!-- Campo session_id (Número) -->
                        <div class="mb-3">
                            <label for="session_id" class="form-label">Session ID</label>
                            <input type="number" class="form-control" id="session_id" name="session_id" required>
                        </div>

                        <!-- Enviar el nombre del archivo CSV subido anteriormente -->
                        <input type="hidden" name="file_name" value="{{ $fileName }}">

                        <!-- Botón para enviar el formulario -->
                        <button type="submit" class="btn btn-secondary mt-3">Enviar</button>
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
                Generando cluster, por favor no abandone esta página, el proceso puede tardar unos minutos...
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

        /* Animación de los puntos en el texto */
        .dots::after {
            content: '';
            display: inline-block;
            width: 0.8em;
            text-align: left;
            animation: dots 1.5s steps(5, end) infinite;
        }

        /* Definir la animación de los puntos */
        @keyframes dots {
            0%, 20% {
                content: '';
            }
            40% {
                content: '.';
            }
            60% {
                content: '..';
            }
            80%, 100% {
                content: '...';
            }
        }
    </style>
</x-app-layout>
