<template>
    <div class="absolute inset-0 opacity-15">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="hexagons" width="50" height="43.4" patternUnits="userSpaceOnUse" patternTransform="scale(2)">
                    <path d="M25,0 L50,14.4 L50,38.4 L25,52.8 L0,38.4 L0,14.4 Z" fill="none" stroke="white" stroke-width="0.5" />
                </pattern>

                <pattern id="circuits" width="100" height="100" patternUnits="userSpaceOnUse">
                    <path d="M10,10 L90,10 L90,90 L10,90 Z" fill="none" stroke="white" stroke-width="0.5" />
                    <path d="M10,10 L50,50 L90,10" fill="none" stroke="white" stroke-width="0.5" />
                    <path d="M10,90 L50,50 L90,90" fill="none" stroke="white" stroke-width="0.5" />
                    <circle cx="10" cy="10" r="3" fill="none" stroke="white" stroke-width="0.5" />
                    <circle cx="90" cy="10" r="3" fill="none" stroke="white" stroke-width="0.5" />
                    <circle cx="10" cy="90" r="3" fill="none" stroke="white" stroke-width="0.5" />
                    <circle cx="90" cy="90" r="3" fill="none" stroke="white" stroke-width="0.5" />
                    <circle cx="50" cy="50" r="5" fill="none" stroke="white" stroke-width="0.5" />
                </pattern>

                <pattern id="techDots" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="0.8" fill="white" />
                </pattern>
            </defs>

            <rect width="100%" height="100%" fill="url(#hexagons)" opacity="0.4" />
            <rect width="100%" height="100%" fill="url(#circuits)" opacity="0.3" />
            <rect width="100%" height="100%" fill="url(#techDots)" opacity="0.4" />

            <circle cx="15%" cy="15%" r="100" fill="none" stroke="white" stroke-width="0.5" opacity="0.2" />
            <circle cx="85%" cy="85%" r="120" fill="none" stroke="white" stroke-width="0.5" opacity="0.2" />
            <rect x="40%" y="30%" width="20%" height="40%" fill="none" stroke="white" stroke-width="0.5" opacity="0.15" rx="10" ry="10" />

            <line x1="5%" y1="50%" x2="25%" y2="50%" stroke="white" stroke-width="0.5" opacity="0.2" />
            <line x1="75%" y1="50%" x2="95%" y2="50%" stroke="white" stroke-width="0.5" opacity="0.2" />
            <line x1="5%" y1="55%" x2="15%" y2="55%" stroke="white" stroke-width="0.5" opacity="0.2" />
            <line x1="85%" y1="55%" x2="95%" y2="55%" stroke="white" stroke-width="0.5" opacity="0.2" />
            <line x1="5%" y1="60%" x2="20%" y2="60%" stroke="white" stroke-width="0.5" opacity="0.2" />
            <line x1="80%" y1="60%" x2="95%" y2="60%" stroke="white" stroke-width="0.5" opacity="0.2" />
        </svg>
    </div>
</template>
