<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Panel Administrador</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: linear-gradient(135deg,#0f172a,#020617); font-family:'Poppins',sans-serif; color:#fff; overflow:hidden; }
    .wrap { height:100vh; display:flex; align-items:center; justify-content:center; perspective:1400px; }
    .card {
      width:900px; max-width:92%;
      padding:2.25rem;
      border-radius:18px;
      background:linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
      box-shadow: 0 20px 60px rgba(2,6,23,0.7);
      transition: transform .18s ease, box-shadow .18s ease;
      transform-style: preserve-3d;
      backdrop-filter: blur(6px);
      border: 1px solid rgba(255,255,255,0.04);
    }
    .title { font-size:2.25rem; font-weight:700; letter-spacing:-0.02em; }
    .sub { margin-top:0.6rem; opacity:0.9; }
    .grid { display:flex; gap:1rem; margin-top:1.25rem; }
    .tile {
      flex:1; padding:1rem; border-radius:12px; background:linear-gradient(135deg,#0ea5e9,#7c3aed);
      box-shadow: inset 0 -8px 20px rgba(0,0,0,0.25);
      transform: translateZ(30px);
    }
    /* float animation */
    @keyframes floaty { 0%{ transform: translateY(0)} 50%{ transform: translateY(-12px)} 100%{ transform: translateY(0)} }
    .card { animation: floaty 6s ease-in-out infinite; }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card" id="card">
      <div class="header">
        <div class="title">Bienvenido Administrador 👑</div>
        <div class="sub">Panel de control — gestión completa del sistema</div>
      </div>

      <div class="grid">
        <div class="tile">
          <h3 class="font-semibold">Usuarios</h3>
          <p class="text-sm mt-1">Crear, editar y asignar roles.</p>
        </div>
        <div class="tile">
          <h3 class="font-semibold">Simulaciones</h3>
          <p class="text-sm mt-1">Agregar/editar módulos de aprendizaje.</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    // efecto 3D de tilt (mouse)
    (function(){
      const card = document.getElementById('card');
      if(!card) return;
      const parent = card.parentElement;
      parent.addEventListener('mousemove', (e) => {
        const rect = parent.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width;
        const y = (e.clientY - rect.top) / rect.height;
        const rotateY = (x - 0.5) * 18; // +/- grados
        const rotateX = (0.5 - y) * 12;
        card.style.transform = `rotateY(${rotateY}deg) rotateX(${rotateX}deg) translateZ(20px)`;
        card.style.boxShadow = `${-rotateY*0.8}px ${Math.abs(rotateX)*1.6 + 12}px 40px rgba(2,6,23,0.6)`;
      });
      parent.addEventListener('mouseleave', ()=> {
        card.style.transform = '';
        card.style.boxShadow = '';
      });
    })();
  </script>
</body>
</html>
