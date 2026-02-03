<x-app-layout>
    <div class="p-4">
        <h1 class="text-2xl font-bold mb-3">AR · Caja en marcador</h1>
        <p class="mb-2">
            Imprime o muestra en otra pantalla el marcador 
            <a href="https://raw.githubusercontent.com/AR-js-org/AR.js/master/aframe/examples/marker-training/examples/pattern-files/pattern-kanji.patt">
                kanji.patt
            </a> 
            o usa el marcador "hiro".
        </p>
        
        <div style="height: 70vh;">
            <!-- Incluir A-Frame -->
            <script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
            <!-- Incluir AR.js -->
            <script src="https://cdn.jsdelivr.net/gh/AR-js-org/AR.js/aframe/build/aframe-ar.js"></script>

            <!-- Configuración AR con A-Frame y AR.js -->
            <a-scene embedded arjs>
                <!-- Usamos el marcador hiro desde el archivo pattern-hiro.patt en public -->
                <!-- Si no tienes el marcador hiro, usa kanji.patt como alternativa -->
                <a-marker type="pattern" url="{{ asset('pattern-hiro.patt') }}">
                    <!-- Caja 3D que aparecerá sobre el marcador -->
                    <a-box position="0 0.5 0" material="opacity: 0.8; color: #4CC3D9;"></a-box>
                </a-marker>
                <!-- Cámara de A-Frame para visualizar el marcador -->
                <a-entity camera></a-entity>
            </a-scene>
        </div>

        <form method="POST" action="{{ route('attempts.store') }}" class="mt-3">
            @csrf
            <input type="hidden" name="module" value="ar">
            <input type="hidden" name="exercise" value="box-hiro">
            <input type="hidden" name="score" value="1">
            <button class="px-4 py-2 bg-blue-600 text-black rounded">Marcar como visto</button>
        </form>
    </div>
</x-app-layout>
