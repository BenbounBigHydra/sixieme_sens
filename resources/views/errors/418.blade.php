<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>418 - I'm a teapot</title>
    <link rel="icon" type="image/png" href="/images/roby_teapot_favicon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Jersey+20&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body class="bg-[#fffbf1] text-black font-inter h-full w-full">
    
    <!-- Conteneur principal qui prend toute la hauteur/largeur et centre son contenu -->
    <div class="h-full w-full flex flex-col items-center justify-center p-4">
        
        <!-- Le groupe avec la bulle et le robot -->
        <div class="flex flex-col-reverse md:flex-row items-center justify-center gap-6 md:gap-8">
            
            <!-- Roby Teapot -->
            <img src="/images/roby_teapot.png" alt="Roby Teapot" class="h-48 md:h-64 object-contain shrink-0" />
            
            <!-- Speech Bubble (Fixe et petite: w-64 soit 256px) -->
            <div class="relative bg-[#1a81e7] text-white p-5 md:p-6 border-[3px] border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] w-64 z-20">
                <div class="font-['Jersey_20'] tracking-wide text-4xl leading-none text-left mb-2">
                    418<br/>I'm a teapot !
                </div>

                <!-- Arrow for desktop (pointing left towards Roby) -->
                <div class="hidden md:block absolute top-10 -left-[15px] w-0 h-0 border-y-[12px] border-y-transparent border-r-[15px] border-r-black"></div>
                <div class="hidden md:block absolute top-[43px] -left-[10px] w-0 h-0 border-y-[9px] border-y-transparent border-r-[12px] border-r-[#1a81e7] z-10"></div>

                <!-- Arrow for mobile (pointing down towards Roby) -->
                <div class="block md:hidden absolute -bottom-[15px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[12px] border-x-transparent border-t-[15px] border-t-black"></div>
                <div class="block md:hidden absolute -bottom-[10px] left-1/2 -translate-x-1/2 w-0 h-0 border-x-[9px] border-x-transparent border-t-[12px] border-t-[#1a81e7] z-10"></div>
            </div>

        </div>
    </div>

</body>
</html>
