<div id="popup" class="fixed top-0 right-0 m-4 p-4 bg-green-500 bg-opacity-50 rounded shadow-lg hidden">
    <div class="text-white">
        @if ($type === 'success')
            {{ __($message) }}
        @elseif($type === 'error')
            <div class="alert alert-danger">
                {{ __($message) }}
            </div>
        @endif
    </div>
</div>
<script>
    // logeado laert
    setTimeout(function() {
        var popup = document.getElementById('popup');
        popup.classList.remove('hidden');
        popup.style.opacity = '1'; // Agregar opacidad para la transición
        popup.style.transform = 'translateY(0)'; // Agregar transformación para el movimiento

        setTimeout(function() {
            popup.style.opacity = '0'; // Ocultar con transición de opacidad
            popup.style.transform = 'translateY(-20px)'; // Movimiento hacia arriba
        }, 2000);
    }, 500);
</script>
