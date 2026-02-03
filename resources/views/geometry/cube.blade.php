<x-app-layout>
    <div class="container mx-auto p-6" style="color:#000 !important;">
        <h1 class="text-2xl font-bold mb-4" style="color:#000 !important;">
            Geometría · Cubo 3D (Three.js)
        </h1>

        <div class="mb-3 text-sm" style="color:#000 !important;">
            Usa el mouse para rotar. Velocidad:
            <input id="speed" type="range" min="0" max="5" value="1" step="0.1">
        </div>

        <div id="canvas-wrap"
             style="width:100%; height:420px; border:1px solid #ddd;"></div>

        {{-- 🟢 PANEL EDUCATIVO --}}
        <div class="mt-4 p-4 rounded bg-gray-100 border">
            <h3 class="font-semibold mb-2">📐 Propiedades del Cubo</h3>

            <label class="text-sm">
                Lado:
                <input id="lado" type="number" value="1" step="0.1"
                       class="ml-2 w-20 px-1 border rounded">
            </label>

            <p class="mt-2 text-sm">
                Volumen: <strong><span id="volumen">1</span></strong>
            </p>

            <p class="text-sm">
                Área total: <strong><span id="area">6</span></strong>
            </p>
        </div>

        <form method="POST" action="{{ route('attempts.store') }}"
              class="mt-4" style="color:#000 !important;">
            @csrf
            <input type="hidden" name="module" value="geometry">
            <input type="hidden" name="exercise" value="cube-basic">
            <input type="hidden" name="score" value="1">
            <button class="px-4 py-2 bg-blue-600 text-black rounded">
                Marcar como completado
            </button>
        </form>

        @if (session('status'))
            <p class="mt-3" style="color:#000 !important;">
                {{ session('status') }}
            </p>
        @endif
    </div>

    {{-- Three.js --}}
    <script src="https://unpkg.com/three@0.160.0/build/three.min.js"></script>

    <script>
        const container = document.getElementById('canvas-wrap');

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(
            75,
            container.clientWidth / container.clientHeight,
            0.1,
            1000
        );

        const renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(container.clientWidth, container.clientHeight);
        container.appendChild(renderer.domElement);

        // 🔷 CUBO
        let lado = 1;
        let geometry = new THREE.BoxGeometry(lado, lado, lado);
        const material = new THREE.MeshNormalMaterial();
        const cube = new THREE.Mesh(geometry, material);
        scene.add(cube);

        camera.position.z = 3;
        let speed = 1;

        document.getElementById('speed')
            .addEventListener('input', e => {
                speed = parseFloat(e.target.value);
            });

        // 🟢 CÁLCULOS
        const ladoInput = document.getElementById('lado');
        const vol = document.getElementById('volumen');
        const area = document.getElementById('area');

        function actualizarCubo() {
            lado = parseFloat(ladoInput.value);

            // actualizar geometría
            cube.geometry.dispose();
            cube.geometry = new THREE.BoxGeometry(lado, lado, lado);

            // cálculos
            vol.textContent = (lado ** 3).toFixed(2);
            area.textContent = (6 * lado * lado).toFixed(2);
        }

        ladoInput.addEventListener('input', actualizarCubo);

        function animate() {
            requestAnimationFrame(animate);
            cube.rotation.x += 0.01 * speed;
            cube.rotation.y += 0.015 * speed;
            renderer.render(scene, camera);
        }
        animate();

        window.addEventListener('resize', () => {
            const w = container.clientWidth;
            const h = container.clientHeight;
            renderer.setSize(w, h);
            camera.aspect = w / h;
            camera.updateProjectionMatrix();
        });
    </script>
</x-app-layout>
