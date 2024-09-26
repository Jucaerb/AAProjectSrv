<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 text-dark">
            {{ __('Response') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="bg-white shadow rounded">
                <div class="p-4 text-dark">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="data:image/png;base64,{{ $elbow_plot_base64 }}" class="d-block mx-auto" style="max-height: 400px; object-fit: contain;" alt="Elbow Plot">
                            </div>
                            <div class="carousel-item">
                                <img src="data:image/png;base64,{{ $silhouette_plot_base64 }}" class="d-block mx-auto" style="max-height: 400px; object-fit: contain;" alt="Silhouette Plot">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon custom-control-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon custom-control-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        /* Cambiar el color de los botones del carrusel */
        .custom-control-icon {
            background-color: black; /* Puedes cambiar a otro color si lo prefieres */
        }

        /* Asegurar que las imágenes del carrusel se centren y se ajusten */
        .carousel-inner img {
            max-height: 400px; /* Ajusta la altura máxima según tu necesidad */
            object-fit: contain; /* Asegura que la imagen se ajuste sin distorsionar */
        }
    </style>
</x-app-layout>
