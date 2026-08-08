<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo e($page->title); ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* --- ESTILOS GENERALES --- */
        body { 
            margin: 0; 
            padding: 0; 
            background-color: #434343; 
            font-family: 'Plus Jakarta Sans', Arial, sans-serif; 
            display: flex;
            min-height: 100vh;
            color: #e5e5e5;
        }

        /* --- CONFIGURACIÓN DEL SIDEBAR GENERAL DE INDEX (SIN CAMBIOS) --- */
        .sidebar {
            width: 260px;
            height: 100vh;
            background-color: #2a2a2a;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 3px 0 10px rgba(0,0,0,0.2);
        }

        .sidebar-top {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #444;
        }
        .sidebar-top .logo-link img {
            width: 120px;
            height: auto;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 20px 10px;
            flex-grow: 1;
        }
        .sidebar-nav a {
            color: #b8b8b8;
            text-decoration: none;
            font-family: 'Archivo Black', sans-serif;
            font-size: 14px;
            padding: 14px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            text-align: left;
        }
        .sidebar-nav a i {
            font-size: 16px;
            width: 20px;
        }
        .sidebar-nav a:hover {
            color: white;
            background-color: #333;
        }
        .sidebar-nav a.active {
            color: white;
            background-color: #3498db;
        }

        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid #444;
            background-color: #222;
            position: relative;
        }
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 5px;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .sidebar-user:hover {
            background-color: #2a2a2a;
        }
        .sidebar-user .gear-icon {
            width: 35px;
            height: 35px;
            transition: transform 0.3s;
        }
        .sidebar-user:hover .gear-icon {
            transform: rotate(45deg);
        }
        .user-info {
            display: flex;
            flex-direction: column;
            color: white;
            font-family: 'Archivo Black', sans-serif;
            text-align: left;
        }
        .user-name {
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 140px;
        }
        .user-role {
            font-size: 10px;
            color: #888;
            font-family: Arial, sans-serif;
            margin-top: 2px;
        }

        .gear-dropdown {
            display: none;
            position: absolute;
            bottom: 70px;
            left: 15px;
            right: 15px;
            background-color: #f0f0f0;
            border-radius: 8px;
            box-shadow: 0 -5px 15px rgba(0,0,0,0.3);
            padding: 8px;
            z-index: 1100;
            text-align: left;
        }
        .logout-button {
            background-color: red;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-family: 'Archivo Black', sans-serif;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1010;
            background: #2a2a2a;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: white;
            border-radius: 2px;
        }

        /* --- CONTENEDOR DE LA INDUCCIÓN DE DOS COLUMNAS --- */
        .report-container { 
            flex-grow: 1;
            padding: 40px 30px; 
            margin-left: 260px;
            transition: margin-left 0.3s ease;
            box-sizing: border-box;
            display: grid;
            grid-template-columns: 1fr 340px; 
            gap: 30px;
            align-items: flex-start;
        }

        /* --- NUEVO REDISEÑO DE LA TARJETA DE CONTENIDO CENTRAL --- */
        .card { 
            background: #121212; 
            padding: 40px; 
            border-radius: 20px; 
            width: 100%; 
            box-sizing: border-box;
            box-shadow: 0 20px 50px rgba(0,0,0,0.6);
            border: 1px solid #222222;
        }

        h1 { 
            font-family: 'Archivo Black', sans-serif; 
            font-size: 32px; 
            margin-top: 0; 
            margin-bottom: 25px; 
            color: #ffffff; 
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
            letter-spacing: -0.5px;
            line-height: 1.3;
        }

        /* BOTONES DE NAVEGACIÓN PREMIUM MINIMALISTAS */
        .nav-buttons { 
            display: flex; 
            flex-wrap: wrap; 
            justify-content: space-between; 
            width: 100%; 
            margin-bottom: 35px; 
            gap: 15px;
        }
        .btn-nav { 
            background-color: transparent; 
            color: #ffffff; 
            border: 1px solid #404040; 
            padding: 14px 28px; 
            cursor: pointer; 
            text-decoration: none; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            border-radius: 8px; 
            font-size: 13px; 
            transition: all 0.25s ease; 
            text-align: center;
            flex: 1;
            min-width: 130px; 
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .btn-nav:hover:not(:disabled) { 
            background-color: #ffffff; 
            color: #000000; 
            border-color: #ffffff;
            transform: translateY(-1px); 
        }
        .btn-nav:disabled { 
            opacity: 0.2; 
            cursor: not-allowed; 
            border-color: #222;
            color: #555;
        }

        /* VIDEO CONTENEDOR */
        .video-container {
            position: relative;
            padding-bottom: 56.25%; 
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            margin-bottom: 35px;
            background: #000;
            border: 1px solid #262626;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .section-title { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            font-weight: 700;
            font-size: 14px; 
            margin-bottom: 12px; 
            display: block; 
            color: #ffffff; 
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .url-box { 
            background: #161616; 
            padding: 18px; 
            border-radius: 8px; 
            margin-bottom: 30px; 
            text-align: left;
            word-break: break-all;
            border: 1px solid #262626;
        }

        /* CONTENIDO EDITABLE ENRIQUECIDO */
        .page-rich-content {
            text-align: left; 
            background: #161616; 
            padding: 30px; 
            margin-bottom: 35px; 
            border-radius: 12px; 
            box-sizing: border-box;
            border: 1px solid #262626;
            color: #d1d1d1;
            line-height: 1.7;
            font-size: 15px;
        }

        /* CAJA DE ADJUNTOS */
        .attachment-box { 
            background: #1a1a1a; 
            padding: 20px; 
            border-radius: 10px; 
            border: 1px dashed #404040; 
            margin: 30px 0; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            gap: 12px; 
            flex-wrap: wrap; 
            transition: all 0.2s ease;
        }
        .attachment-box:hover {
            border-color: #ffffff;
            background: #222222;
        }

        /* EVALUACIONES EN NEGRO Y BLANCO */
        .question-container { 
            margin-top: 45px; 
            border-top: 1px solid #262626; 
            padding-top: 35px; 
        }
        .question-card { 
            margin-bottom: 20px; 
            padding: 25px; 
            background: #161616; 
            border-radius: 12px; 
            border-left: 4px solid #ffffff; 
            text-align: left;
            border-top: 1px solid #262626;
            border-right: 1px solid #262626;
            border-bottom: 1px solid #262626;
        }
        .question-text { 
            font-weight: 600; 
            font-size: 16px; 
            display: block; 
            margin-bottom: 18px; 
            overflow-wrap: break-word; 
            color: #ffffff;
        }

        .input-abierta { 
            width: 100%; 
            padding: 14px; 
            background-color: #0d0d0d;
            border: 1px solid #333333; 
            border-radius: 8px; 
            box-sizing: border-box;
            color: #ffffff;
            font-size: 14.5px;
            font-family: inherit;
            transition: border-color 0.2s;
        }
        .input-abierta:focus {
            outline: none;
            border-color: #ffffff;
        }

        /* Personalización de Radios */
        .radio-label {
            display: flex; 
            align-items: center;
            gap: 10px;
            margin: 12px 0; 
            cursor: pointer; 
            font-weight: normal; 
            color: #c5c5c5;
            font-size: 14.5px;
            transition: color 0.2s;
        }
        .radio-label:hover {
            color: #ffffff;
        }
        .radio-label input[type="radio"] {
            accent-color: #ffffff;
            width: 16px;
            height: 16px;
        }

        .btn-enviar { 
            background: #ffffff; 
            color: #000000; 
            border: 1px solid #ffffff; 
            padding: 18px 40px; 
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 15px; 
            border-radius: 8px; 
            cursor: pointer; 
            transition: all 0.25s ease; 
            width: 100%;
            margin-top: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .btn-enviar:hover { 
            background: #000000; 
            color: #ffffff; 
            border-color: #404040;
            box-shadow: 0 10px 20px rgba(0,0,0,0.4); 
        }

        .success-box {
            background: #161616; 
            color: #ffffff; 
            padding: 20px; 
            border-radius: 10px; 
            font-weight: 600; 
            text-align: center;
            border: 1px solid #27ae60;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        /* --- SIDEBAR DE PROGRESO (SIN CAMBIOS DE DISEÑO) --- */
        .progress-sidebar {
            background-color: #1a1a1a;
            border: 2px solid #666666;
            border-radius: 18px;
            padding: 20px 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            position: sticky;
            top: 30px;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            box-sizing: border-box;
        }

        .progress-sidebar-title {
            font-family: 'Archivo Black', sans-serif;
            font-size: 16px;
            color: #ffffff;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
        }

        .progress-sidebar-subtitle {
            font-size: 12px;
            color: #9e9e9e;
            margin-bottom: 20px;
            display: block;
            text-align: left;
        }

        .progress-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .progress-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            text-align: left;
            box-sizing: border-box;
            max-width: 100%;
        }

        .progress-item.unlocked {
            cursor: pointer;
            background-color: rgba(255, 255, 255, 0.03);
        }
        .progress-item.unlocked:hover {
            background-color: rgba(255, 255, 255, 0.08);
        }

        .progress-item.active {
            background-color: #2a2a2a !important;
            border-left: 4px solid #3498db;
        }

        .progress-item.locked {
            cursor: not-allowed;
            opacity: 0.4;
            background-color: transparent;
        }

        .status-bubble {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .status-bubble.completed {
            background-color: #27ae60;
            color: white;
        }
        .status-bubble.current {
            background-color: #3498db;
            color: white;
        }
        .status-bubble.waiting {
            border: 2px solid #666666;
            color: #9e9e9e;
        }
        .status-bubble.locked-icon {
            background-color: rgba(0, 0, 0, 0.3);
            color: #666666;
            border: 1px solid #444;
        }

        .module-info {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            flex-grow: 1;
        }
        .module-title {
            font-size: 13px;
            font-weight: 600;
            color: #ffffff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .progress-item.active .module-title {
            color: #3498db;
            font-weight: 700;
        }
        .module-status-text {
            font-size: 10px;
            color: #9e9e9e;
            margin-top: 2px;
        }

        .progress-sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .progress-sidebar::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        .progress-sidebar::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 10px;
        }

        /* REGLAS MULTIMEDIA DEL ALCANCE INTERNO */
        .card div img, .card img {
            max-width: 100% !important;
            height: auto !important;
            display: block;
            margin: 20px auto; 
            box-sizing: border-box;
            border-radius: 10px;
            border: 1px solid #333;
        }
        .card div {
            max-width: 100%;
            overflow-x: auto; 
            box-sizing: border-box;
        }

        /* --- RESPONSIVIDAD --- */
        @media (max-width: 1100px) {
            .report-container {
                grid-template-columns: 1fr; 
            }
            .progress-sidebar {
                position: relative;
                top: 0;
                max-height: none;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .menu-toggle { 
                display: flex; 
            }
            .report-container {
                margin-left: 0;
                padding-top: 80px;
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media (max-width: 480px) {
            .card {
                padding: 25px 15px; 
            }
            h1 {
                font-size: 24px; 
            }
            .btn-nav {
                padding: 12px 15px;
                font-size: 11px;
            }
            .page-rich-content {
                padding: 20px 15px;
            }
        }
        

                /* Contenedor del Logo */
        .sidebar-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;          /* Espaciado interno para que no pegue a los bordes */
            background-color: #212529; /* El gris oscuro actual de tu fondo (o el que prefieras) */
        }

        /* Ajuste directo a la imagen del logo */
        .sidebar-logo img {
            width: 100%;            /* Se adapta al ancho del contenedor */
            max-width: 140px;       /* Ajusta este número (en píxeles) para darle el tamaño ideal */
            height: auto;           /* Mantiene la proporción original para que no se deforme */
            object-fit: contain;    /* Asegura que se renderice limpio */
            display: block;
        }


        /* 1. Contenedor principal de la lección / contenido */
        .content-container, .main-content, .card {
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            padding: 15px; /* Un espaciado interno adecuado para móvil */
            overflow-x: hidden; /* Evita que el contenedor genere scroll horizontal */
            
            /* Aplicando la paleta Gris y Blanco */
            background-color: #000000; /* Fondo blanco para el bloque de lectura */
            color: #212529; /* Texto gris oscuro/negro para máxima legibilidad */
            border-radius: 8px;
        }

        /* 2. Regla de oro para evitar el desborde de textos y etiquetas HTML */
        .content-container p, 
        .content-container span, 
        .content-container h1, 
        .content-container h2, 
        .content-container h3, 
        .content-container code {
            white-space: normal;      /* Permite el flujo natural del texto */
            word-wrap: break-word;     /* Rompe palabras ridículamente largas (como enlaces o rutas) */
            word-break: break-word;    /* Refuerzo para navegadores móviles */
            max-width: 100%;
        }

        /* 3. Ajuste para los botones superiores (Volver / Finalizar) en Móvil */
        .buttons-container {
            display: flex;
            gap: 10px;
            width: 100%;
            margin-bottom: 20px;
        }

        .buttons-container a, 
        .buttons-container button {
            flex: 1; /* Hace que ambos botones midan exactamente lo mismo en móvil */
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }

        /* 1. Asegurar el contenedor del Sidebar complete el alto de la pantalla sin desbordarse */
.sidebar {
    display: flex;
    flex-direction: column;
    
    /* SOLUCIÓN MEDIDAS MÓVILES MODERNAS */
    height: 100vh;          /* Fallback para navegadores antiguos */
    height: 100dvh;         /* Alto dinámico real en móviles (Dynamic VH) */
    
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 260px;           /* Ajusta al ancho que manejes en tu diseño */
    z-index: 1000;
    overflow: hidden;       /* Bloquea el scroll general del contenedor */
    background-color: #2a2a2a;
}

/* 2. El truco maestro: El navegador central ocupa el espacio restante y es el ÚNICO que genera scroll */
.sidebar-nav {
    flex: 1;
    overflow-y: auto; /* Si hay muchos enlaces en pantallas pequeñas, solo se deslizarán estos */
    display: flex;
    flex-direction: column;
}

/* 3. Fijar el Footer de forma permanente en la base del sidebar */
.sidebar-footer {
    margin-top: auto; /* Empuja el footer firmemente hacia abajo */
    padding: 15px;
    background-color: #1a1a1a; /* Pon el color exacto de tu fondo para delimitarlo */
    position: relative; /* Clave para el posicionamiento del menú desplegable */
}

/* 4. Evitar que el dropdown del engranaje se corte al abrirse en móviles cortos */
.gear-dropdown {
    position: absolute;
    bottom: 100%; /* Hace que el menú de cerrar sesión abra hacia ARRIBA del footer */
    left: 15px;
    right: 15px;
    margin-bottom: 10px;
    z-index: 1010;
}
    </style>
</head>
<body>

    <div class="menu-toggle" onclick="toggleSidebar()">
        <span></span><span></span><span></span>
    </div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <?php if(auth()->user()->role === 'admin'): ?>
                <a href="/admin"> 
                    <img src="<?php echo e(asset('images/logob.png')); ?>" alt="Logo">
                </a>
            <?php else: ?>
                <img src="<?php echo e(asset('images/logob.png')); ?>" alt="Logo" style="cursor: default; pointer-events: none;">
            <?php endif; ?>
        </div>

        <nav class="sidebar-nav">
            <?php if(auth()->user()->role !== 'admin'): ?>
                <a href="/lobby" class="<?php echo e(request()->is('lobby*') ? 'active' : ''); ?>">
                    <i class="fas fa-home"></i> LOBBY
                </a>
            <?php endif; ?>

            <a href="<?php echo e(route('induction.start')); ?>" class="<?php echo e(request()->routeIs('induction.*') ? 'active' : ''); ?>">
                <i class="fas fa-graduation-cap"></i> INDUCCIÓN
            </a>

            <?php if(auth()->user()->role === 'admin'): ?>
                <a href="/users" class="<?php echo e(request()->is('users*') ? 'active' : ''); ?>">
                    <i class="fas fa-users"></i> USUARIOS
                </a>
                <a href="/pages" class="<?php echo e(request()->is('pages*') ? 'active' : ''); ?>">
                    <i class="fas fa-file-alt"></i> PÁGINAS
                </a>
                <a href="<?php echo e(route('admin.reports')); ?>" class="<?php echo e(request()->routeIs('admin.reports') ? 'active' : ''); ?>">
                    <i class="fas fa-chart-bar"></i> REPORTES
                </a>
            <?php endif; ?>
        </nav>

        <div class="sidebar-footer">
            <?php if(Auth::check()): ?>
                <div class="sidebar-user" onclick="toggleGearMenu(event)">
                    <img src="<?php echo e(asset('images/gear.png')); ?>" alt="Ajustes" class="gear-icon">
                    <div class="user-info">
                        <span class="user-name"><?php echo e(Auth::user()->name); ?></span>
                        <span class="user-role">
                            <?php echo e(Auth::user()->role === 'admin' ? 'Administrador' : 'Usuario'); ?>

                        </span>
                    </div>
                    
                    <div class="gear-dropdown" id="gearDropdown">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="logout-button">
                                <i class="fas fa-sign-out-alt"></i> SALIR
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </aside>

        <div class="report-container">
            
            <div class="card">
                
                <div class="nav-buttons">
                    
                    <?php if(!empty($prevPageUrl)): ?>
                        <a href="<?php echo e($prevPageUrl); ?>" class="btn-nav">VOLVER</a>
                    <?php else: ?>
                        <button class="btn-nav" disabled>VOLVER</button>
                    <?php endif; ?>

                    
                    <?php if(!empty($nextPageUrl)): ?>
                        <?php if((Auth::user() && Auth::user()->role === 'admin') || $isCompleted): ?>
                            <?php if(str_contains($nextPageUrl, 'completed')): ?>
                                <a href="<?php echo e($nextPageUrl); ?>" class="btn-nav" style="background:#ffffff; color:#000000; border-color:#ffffff;">FINALIZAR INDUCCIÓN</a>
                            <?php else: ?>
                                <a href="<?php echo e($nextPageUrl); ?>" class="btn-nav" style="background:#ffffff; color:#000000; border-color:#ffffff;">SIGUIENTE</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <button class="btn-nav" disabled title="Responde para avanzar">SIGUIENTE</button>
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="btn-nav" disabled>FIN DE CONTROL</button>
                    <?php endif; ?>
                </div>

            
                <?php if(Auth::user() && Auth::user()->role === 'admin' && isset($pages) && $pages->count() > 0): ?>
                    
                    
                    <?php
                        $puestosUnicos = [];
                        foreach ($pages as $p) {
                            $destinado = $p->destinado_a;

                            // Si es un array/JSON, recorremos sus elementos
                            if (is_array($destinado)) {
                                foreach ($destinado as $val) {
                                    $destinadoValue = trim($val);
                                    $destinadoLower = mb_strtolower($destinadoValue);

                                    if (
                                        $destinadoValue !== '' && 
                                        !in_array($destinadoLower, ['estadia', 'estadía', 'ambos', 'todos', 'colaborador'])
                                    ) {
                                        if (!in_array($destinadoValue, $puestosUnicos)) {
                                            $puestosUnicos[] = $destinadoValue;
                                        }
                                    }
                                }
                            } 
                            // Si viene como string
                            elseif (is_string($destinado)) {
                                $destinadoValue = trim($destinado);
                                $destinadoLower = mb_strtolower($destinadoValue);

                                if (
                                    $destinadoValue !== '' && 
                                    !in_array($destinadoLower, ['estadia', 'estadía', 'ambos', 'todos', 'colaborador'])
                                ) {
                                    if (!in_array($destinadoValue, $puestosUnicos)) {
                                        $puestosUnicos[] = $destinadoValue;
                                    }
                                }
                            }
                        }
                    ?>

                    <div style="background-color: #161616; padding: 25px 20px; border-radius: 15px; width: 100%; margin-bottom: 35px; box-sizing: border-box; border: 1px solid #262626;">
                        
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; margin-bottom: 20px; border-bottom: 1px solid #262626; padding-bottom: 15px;">
                            <a href="/admin" 
                            style="display: inline-flex; align-items: center; justify-content: center; padding: 10px 16px; border-radius: 20px; font-weight: bold; text-decoration: none; font-size: 13px; background-color: #ffffff; color: #000000; transition: all 0.2s ease; font-family:'Plus Jakarta Sans';"
                            title="Regresar a Vista de Admin">
                                <i class="fas fa-home" style="margin-right: 6px;"></i> Admin
                            </a>
                            
                            <button type="button" onclick="filtrarPorCategoria('todos')" id="btn-tab-todos"
                                    style="background-color: #333333; color: white; border: 1px solid #555; padding: 10px 20px; border-radius: 20px; font-weight: bold; font-size: 13px; cursor: pointer; font-family:'Plus Jakarta Sans'; transition: 0.2s;">
                                Mostrar Todas
                            </button>
                            <button type="button" onclick="filtrarPorCategoria('Colaborador')" id="btn-tab-colaborador"
                                    style="background-color: #0d0d0d; color: #a0a0a0; border: 1px solid #262626; padding: 10px 20px; border-radius: 20px; font-weight: bold; font-size: 13px; cursor: pointer; font-family:'Plus Jakarta Sans'; transition: 0.2s;">
                                Filtro
                            </button>
                            <button type="button" onclick="filtrarPorCategoria('Ambos')" id="btn-tab-ambos"
                                    style="background-color: #0d0d0d; color: #a0a0a0; border: 1px solid #262626; padding: 10px 20px; border-radius: 20px; font-weight: bold; font-size: 13px; cursor: pointer; font-family:'Plus Jakarta Sans'; transition: 0.2s;">
                                Generales (Ambos)
                            </button>
                        </div>

                        
                        <div id="panel-puestos-colaborador" style="display: none; background-color: #0d0d0d; padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #262626;">
                            <div style="font-size: 11px; color: #666; font-weight: bold; margin-bottom: 10px; text-transform: uppercase; text-align: center; font-family:'Plus Jakarta Sans';">
                                Filtrar por Puesto:
                            </div>
                            <div style="display: flex; flex-wrap: wrap; gap: 8px; justify-content: center;">
                                <button type="button" onclick="filtrarPorPuesto('todos-puestos')" class="btn-puesto-filtro" data-puesto-btn="todos-puestos"
                                        style="background-color: #333333; color: white; border: 1px solid #555; padding: 6px 12px; border-radius: 15px; font-size: 12px; font-weight: bold; cursor: pointer; font-family:'Plus Jakarta Sans';">
                                    [Todos los puestos]
                                </button>
                                
                                <?php $__currentLoopData = $puestosUnicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $puesto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" onclick="filtrarPorPuesto('<?php echo e($puesto); ?>')" class="btn-puesto-filtro" data-puesto-btn="<?php echo e($puesto); ?>"
                                            style="background-color: #1c1c1c; color: #a0a0a0; border: 1px solid #262626; padding: 6px 12px; border-radius: 15px; font-size: 12px; cursor: pointer; font-family:'Plus Jakarta Sans'; transition: 0.2s;">
                                        <?php echo e($puesto); ?>

                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        
                        <div style="display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; align-items: center;">
                            <?php $contadorGlobal = 1; ?>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $targetUrl = Route::currentRouteName() === 'induction.show'
                                        ? route('induction.show', !empty($p->slug) ? $p->slug : $p->id)
                                        : route('pages.show', $p->slug);

                                    $isCurrentPage = $page->id === $p->id;

                                    // Normalizar destinado_a a un array para procesar sin errores
                                    $destinadoArray = is_array($p->destinado_a) 
                                        ? $p->destinado_a 
                                        : [$p->destinado_a];

                                    // Convertir a minúsculas para comparaciones
                                    $destinadoLowerArray = array_map(function($item) {
                                        return mb_strtolower(trim((string)$item));
                                    }, $destinadoArray);

                                    // Texto visible para mostrar en el badge/burbuja
                                    $destinadoValue = implode(', ', array_filter($destinadoArray));

                                    // Determinar categoría principal y puesto específico para los data-attributes
                                    $categoriaFiltro = 'colaborador';
                                    $puestoFiltro = '';

                                    if (
                                        in_array('ambos', $destinadoLowerArray) || 
                                        in_array('todos', $destinadoLowerArray)
                                    ) {
                                        $categoriaFiltro = 'ambos';
                                        $puestoFiltro = 'ambos';
                                    } elseif (
                                        in_array('estadia', $destinadoLowerArray) || 
                                        in_array('estadía', $destinadoLowerArray)
                                    ) {
                                        $categoriaFiltro = 'estadia';
                                        $puestoFiltro = 'estadia';
                                    } else {
                                        // Asignar el puesto específico omitiendo palabras reservadas
                                        foreach ($destinadoArray as $val) {
                                            $cleaned = trim((string)$val);
                                            $cleanedLower = mb_strtolower($cleaned);
                                            if ($cleaned !== '' && !in_array($cleanedLower, ['colaborador', 'estadia', 'estadía', 'ambos', 'todos'])) {
                                                $puestoFiltro = $cleaned;
                                                break;
                                            }
                                        }
                                        
                                        if (empty($puestoFiltro)) {
                                            $puestoFiltro = $categoriaFiltro;
                                        }
                                    }
                                ?>
                                
                                <a href="<?php echo e($targetUrl); ?>" 
                                class="burbuja-induccion"
                                data-destinado="<?php echo e($categoriaFiltro); ?>"
                                data-puesto="<?php echo e($puestoFiltro); ?>"
                                data-current="<?php echo e($isCurrentPage ? 'true' : 'false'); ?>"
                                style="display: inline-flex; flex-direction: column; align-items: center; justify-content: center; padding: 8px 20px; border-radius: 25px; font-weight: bold; text-decoration: none; font-size: 13px; transition: all 0.2s ease; line-height: 1.2; text-align: center; font-family:'Plus Jakarta Sans';
                                        <?php echo e($isCurrentPage ? 'background-color: #333333; color: white; border: 1px solid #555;' : 'background-color: #0d0d0d; color: #a0a0a0; border: 1px solid #262626;'); ?>">
                                    
                                    <span>Pág <?php echo e($contadorGlobal++); ?>: <?php echo e(Str::limit($p->title, 16)); ?></span>
                                    
                                    <span style="font-size: 9px; margin-top: 4px; padding: 1px 7px; border-radius: 10px; font-weight: normal; opacity: 0.85; text-transform: uppercase; letter-spacing: 0.5px;
                                                <?php echo e($isCurrentPage ? 'background-color: #ffffff; color: #000000;' : 'background-color: #1c1c1c; color: #888;'); ?>">
                                        <?php echo e($destinadoValue); ?>

                                    </span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <h1><?php echo e($page->title); ?></h1>

                
                <?php
                    $videoPath = !empty($page->video_file) ? $page->video_file : (!empty($page->video_url) ? $page->video_url : null);
                ?>

                <?php if($videoPath): ?>
                    <?php
                        $rawUrl = trim($videoPath);
                        $embedUrl = null;
                        $isDirectFile = false;

                        // Detección de archivos subidos (.mp4, .webm, .ogg o ruta interna)
                        if (preg_match('/\.(mp4|webm|ogg)($|\?)/i', $rawUrl) || str_contains($rawUrl, 'videos/')) {
                            $isDirectFile = true;
                            // Si la ruta comienza con http usamos esa, de lo contrario usamos Storage o asset
                            if (str_starts_with($rawUrl, 'http://') || str_starts_with($rawUrl, 'https://')) {
                                $videoSrc = $rawUrl;
                            } else {
                                $videoSrc = asset('storage/' . ltrim($rawUrl, '/'));
                            }
                        }
                        // Detección YouTube
                        elseif (preg_match('/(?:youtube\.com\/(?:watch\?.*v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/i', $rawUrl, $matches)) {
                            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=0&rel=0';
                        }
                        // Detección Vimeo
                        elseif (preg_match('/vimeo\.com\/(?:.*\/)?(\d+)/i', $rawUrl, $matches)) {
                            $embedUrl = 'https://player.vimeo.com/video/' . $matches[1];
                        }
                        // Detección Google Drive
                        elseif (str_contains($rawUrl, 'drive.google.com')) {
                            $embedUrl = preg_replace('/\/view(\?.*)?$/', '/preview', $rawUrl);
                        }
                        else {
                            $embedUrl = $rawUrl;
                        }
                    ?>

                    <div style="width: 100%; margin-top: 20px; margin-bottom: 25px;">
                        <?php if($isDirectFile): ?>
                            <video controls style="width: 100%; max-height: 500px; border-radius: 12px; background-color: #000000; outline: none; border: 1px solid #262626;">
                                <source src="<?php echo e($videoSrc); ?>" type="video/mp4">
                                Tu navegador no soporta la reproducción de video HTML5.
                            </video>
                        <?php else: ?>
                            <div style="position: relative; width: 100%; padding-top: 56.25%; background: #000000; border-radius: 12px; overflow: hidden; border: 1px solid #262626;">
                                <iframe src="<?php echo e($embedUrl); ?>" 
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen></iframe>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                
                <?php if(isset($page->url) && $page->url != ''): ?>
                    <span class="section-title">Información Adicional:</span>
                    <div class="url-box">
                        <?php if(filter_var($page->url, FILTER_VALIDATE_URL)): ?>
                            <a href="<?php echo e($page->url); ?>" target="_blank" style="color:#ffffff; font-weight:bold; text-decoration: underline;"><?php echo e($page->url); ?></a>
                        <?php else: ?>
                            <?php echo e($page->url); ?>

                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                
                <?php if($page->content): ?>
                    <span class="section-title">Instrucciones / Contenido:</span>
                    <div class="page-rich-content">
                        <?php echo $page->content; ?>

                    </div>
                <?php endif; ?>

                
                <?php if($page->attachment): ?>
                    <div class="attachment-box">
                        <i class="fas fa-file-download" style="font-size: 20px; color: #ffffff;"></i>
                        <a href="<?php echo e(route('pages.download', $page->id)); ?>" style="color: #ffffff; font-weight: bold; text-decoration: none; font-size: 14.5px;">
                            Descargar Material de Apoyo
                        </a>
                    </div>
                <?php endif; ?>

                
                <?php if(isset($questions) && $questions->count() > 0): ?>
                    <div class="question-container">
                        <h2 style="font-family:'Archivo Black'; font-size:20px; color: #ffffff; text-align: left; margin-bottom: 25px; letter-spacing: 0.5px;">Evaluación</h2>
                        <form action="<?php echo e(route('questions.answer')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="page_id" value="<?php echo e($page->id); ?>">

                            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="question-card">
                                    <span class="question-text"><?php echo e($question->question_text); ?></span>
                                    
                                    <?php 
                                        $userResponse = $question->userResponses()->where('user_id', Auth::id())->first();
                                        $isAnswered = !!$userResponse;
                                    ?>

                                    <?php if($question->question_type === 'opcion_multiple'): ?>
                                        <?php $options = is_string($question->options) ? json_decode($question->options, true) : $question->options; ?>
                                        <?php if($options): ?>
                                            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label class="radio-label">
                                                    <input type="radio" name="answers[<?php echo e($question->id); ?>]" value="<?php echo e($val); ?>" 
                                                        <?php echo e($isAnswered ? 'disabled' : ''); ?>

                                                        <?php echo e(($isAnswered && $userResponse->answer == $val) ? 'checked' : ''); ?> required>
                                                    <?php echo e($val); ?>

                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <input type="text" name="answers[<?php echo e($question->id); ?>]" class="input-abierta" 
                                            placeholder="Escribe tu respuesta aquí..."
                                            value="<?php echo e($isAnswered ? $userResponse->answer : ''); ?>"
                                            <?php echo e($isAnswered ? 'disabled' : 'required'); ?>>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if(!$isCompleted): ?>
                                <button type="submit" class="btn-enviar">ENVIAR EVALUACIÓN</button>
                            <?php else: ?>
                                <div class="success-box">
                                    <i class="fas fa-check-circle" style="color: #27ae60; font-size: 18px;"></i> Sección completada con éxito, puedes avanzar.
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            
            <aside class="progress-sidebar">
                <h3 class="progress-sidebar-title">Contenido de la inducción</h3>
                <span class="progress-sidebar-subtitle">Lleva tu propio ritmo de aprendizaje</span>
                
                <div class="progress-list">
                    <?php if(isset($sidebarProgress) && count($sidebarProgress) > 0): ?>
                        <?php $__currentLoopData = $sidebarProgress; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $itemProgress): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php
                                // Recorremos de forma segura las variables de filtrado para cada item de la lista lateral
                                $itemDestinado = !empty($itemProgress['destinado_a']) ? trim($itemProgress['destinado_a']) : (!empty($itemProgress['destinado']) ? trim($itemProgress['destinado']) : 'Colaborador');
                                $itemArea = !empty($itemProgress['area_colaborador']) ? trim($itemProgress['area_colaborador']) : 'Ninguna';
                                $itemPuesto = !empty($itemProgress['tipo_colaborador']) ? trim($itemProgress['tipo_colaborador']) : 'Ninguno';
                            ?>

                            <?php if($itemProgress['is_locked']): ?>
                                <div class="progress-item locked filtrable-sidebar"
                                    data-destinado="<?php echo e($itemDestinado); ?>"
                                    data-area="<?php echo e($itemArea); ?>"
                                    data-puesto="<?php echo e($itemPuesto); ?>">
                                    <div class="status-bubble locked-icon">
                                        <i class="fas fa-lock" style="font-size: 10px;"></i>
                                    </div>
                                    <div class="module-info">
                                        <span class="module-title"><?php echo e($itemProgress['title']); ?></span>
                                        <span class="module-status-text">Bloqueado</span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <a href="<?php echo e(route('induction.show', !empty($itemProgress['slug']) ? $itemProgress['slug'] : $itemProgress['id'])); ?>" 
                                class="progress-item unlocked <?php echo e($itemProgress['is_active'] ? 'active' : ''); ?> filtrable-sidebar"
                                data-destinado="<?php echo e($itemDestinado); ?>"
                                data-area="<?php echo e($itemArea); ?>"
                                data-puesto="<?php echo e($itemPuesto); ?>">
                                    
                                    <?php if($itemProgress['is_completed']): ?>
                                        <div class="status-bubble completed" title="Completado">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    <?php elseif($itemProgress['is_active']): ?>
                                        <div class="status-bubble current" title="Viendo ahora">
                                            <i class="fas fa-play" style="font-size: 9px;"></i>
                                        </div>
                                    <?php else: ?>
                                        <div class="status-bubble waiting" title="Disponible para repaso">
                                            <?php echo e($index + 1); ?>

                                        </div>
                                    <?php endif; ?>

                                    <div class="module-info">
                                        <span class="module-title"><?php echo e($itemProgress['title']); ?></span>
                                        <span class="module-status-text">
                                            <?php if($itemProgress['is_completed']): ?>
                                                Completado
                                            <?php elseif($itemProgress['is_active']): ?>
                                                Estudiando ahora
                                            <?php else: ?>
                                                Repasar clase
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </a>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <span class="progress-sidebar-subtitle" style="font-style: italic;">No hay módulos cargados.</span>
                    <?php endif; ?>
                </div>
            </aside>

        </div>

            <script>
                // =========================================================================
                // 0. CONTROL INTERACTIVO DEL SIDEBAR Y ENGRANAJE (FOOTER MÓVIL)
                // =========================================================================
                function toggleSidebar() {
                    const sidebar = document.getElementById('sidebar');
                    if (sidebar) {
                        sidebar.classList.toggle('active');
                    }
                }

                function toggleGearMenu(event) {
                    event.stopPropagation();
                    const dropdown = document.getElementById('gearDropdown');
                    if (dropdown) {
                        dropdown.classList.toggle('active');
                        if (dropdown.style.display === 'block') {
                            dropdown.style.display = 'none';
                        } else {
                            dropdown.style.display = 'block';
                        }
                    }
                }

                document.addEventListener('click', function(event) {
                    const sidebar = document.getElementById('sidebar');
                    const menuToggle = document.querySelector('.menu-toggle');
                    const dropdown = document.getElementById('gearDropdown');
                    
                    if (sidebar && sidebar.classList.contains('active')) {
                        if (menuToggle && !sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                            sidebar.classList.remove('active');
                        } else if (!menuToggle && !sidebar.contains(event.target)) {
                            sidebar.classList.remove('active');
                        }
                    }

                    if (dropdown) {
                        const gearIcon = document.querySelector('.sidebar-user');
                        if (gearIcon && !gearIcon.contains(event.target)) {
                            dropdown.style.display = 'none';
                            dropdown.classList.remove('active');
                        }
                    }
                });

                // =========================================================================
                // 1. AUXILIAR: NORMALIZAR TEXTOS (Quita acentos y limpia espacios)
                // =========================================================================
                function normalizarTexto(texto) {
                    if (!texto) return '';
                    return texto.toString()
                        .trim()
                        .toLowerCase()
                        .normalize("NFD")
                        .replace(/[\u0300-\u036f]/g, "")
                        .replace(/\.+$/, "");
                }

                // =========================================================================
                // 2. FILTRADO PRINCIPAL Y PUESTOS (NIVEL 1 Y 2)
                // =========================================================================
                function marcarPuestoActivo(puestoTarget) {
                    const botonesPuesto = document.querySelectorAll('.btn-puesto-filtro');
                    const targetNorm = normalizarTexto(puestoTarget);

                    botonesPuesto.forEach(btn => {
                        const btnPuesto = normalizarTexto(btn.getAttribute('data-puesto-btn'));
                        if (btnPuesto === targetNorm) {
                            btn.style.setProperty('background-color', '#ffffff', 'important');
                            btn.style.setProperty('color', '#000000', 'important');
                        } else {
                            btn.style.setProperty('background-color', '#1c1c1c', 'important');
                            btn.style.setProperty('color', '#a0a0a0', 'important');
                        }
                    });
                }

                function filtrarPorCategoria(categoria) {
                    const elementos = document.querySelectorAll('.burbuja-induccion, .filtrable-sidebar');
                    const panelPuestos = document.getElementById('panel-puestos-colaborador');
                    const catTarget = normalizarTexto(categoria);

                    const botonesTabs = {
                        todos: document.getElementById('btn-tab-todos'),
                        colaborador: document.getElementById('btn-tab-colaborador'),
                        ambos: document.getElementById('btn-tab-ambos')
                    };

                    Object.keys(botonesTabs).forEach(key => {
                        if (botonesTabs[key]) {
                            if (key === catTarget) {
                                botonesTabs[key].style.setProperty('background-color', '#ffffff', 'important');
                                botonesTabs[key].style.setProperty('color', '#000000', 'important');
                            } else {
                                botonesTabs[key].style.setProperty('background-color', '#0d0d0d', 'important');
                                botonesTabs[key].style.setProperty('color', '#a0a0a0', 'important');
                            }
                        }
                    });

                    if (catTarget === 'colaborador') {
                        if (panelPuestos) panelPuestos.style.display = 'block';
                        marcarPuestoActivo('todos-puestos');
                    } else {
                        if (panelPuestos) panelPuestos.style.display = 'none';
                    }

                    elementos.forEach(el => {
                        const dest = normalizarTexto(el.getAttribute('data-destinado'));
                        const displayStyle = el.classList.contains('filtrable-sidebar') ? 'flex' : 'inline-flex';

                        if (catTarget === 'todos' || dest === catTarget) {
                            el.style.setProperty('display', displayStyle, 'important');
                        } else {
                            el.style.setProperty('display', 'none', 'important');
                        }
                    });
                }

                function filtrarPorPuesto(puesto) {
                    const elementos = document.querySelectorAll('.burbuja-induccion, .filtrable-sidebar');
                    const puestoTarget = normalizarTexto(puesto);

                    marcarPuestoActivo(puesto);

                    elementos.forEach(el => {
                        const dest = normalizarTexto(el.getAttribute('data-destinado'));
                        const puestoElemento = normalizarTexto(el.getAttribute('data-puesto'));
                        const displayStyle = el.classList.contains('filtrable-sidebar') ? 'flex' : 'inline-flex';

                        if (dest === 'colaborador') {
                            if (puestoTarget === 'todos-puestos' || puestoElemento === puestoTarget) {
                                el.style.setProperty('display', displayStyle, 'important');
                            } else {
                                el.style.setProperty('display', 'none', 'important');
                            }
                        }
                    });
                }
            </script>
</body>

</html><?php /**PATH C:\Users\jairg\OneDrive\Escritorio\I-DEB proyecto estadia\Programa induccion\Proyecto-CursoInduc\resources\views/pages/template.blade.php ENDPATH**/ ?>