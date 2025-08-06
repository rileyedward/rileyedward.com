<template>
    <div class="absolute inset-0 opacity-10">
        <svg class="absolute inset-0 h-full w-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <!-- Creative geometric pattern -->
                <pattern id="geometric-mesh" x="0" y="0" width="120" height="120" patternUnits="userSpaceOnUse">
                    <path d="M0 60 L60 0 L120 60 L60 120 Z" fill="none" stroke="white" stroke-width="0.5" opacity="0.3" />
                    <circle cx="60" cy="60" r="20" fill="none" stroke="white" stroke-width="0.5" opacity="0.4" />
                </pattern>

                <!-- Portfolio grid pattern -->
                <pattern id="portfolio-grid" x="0" y="0" width="80" height="80" patternUnits="userSpaceOnUse">
                    <rect x="10" y="10" width="25" height="25" fill="none" stroke="white" stroke-width="0.5" opacity="0.2" />
                    <rect x="45" y="10" width="25" height="25" fill="none" stroke="white" stroke-width="0.5" opacity="0.2" />
                    <rect x="10" y="45" width="25" height="25" fill="none" stroke="white" stroke-width="0.5" opacity="0.2" />
                    <rect x="45" y="45" width="25" height="25" fill="none" stroke="white" stroke-width="0.5" opacity="0.2" />
                </pattern>

                <!-- Creative flow lines -->
                <pattern id="flow-lines" x="0" y="0" width="200" height="100" patternUnits="userSpaceOnUse">
                    <path d="M0 25 Q50 10 100 25 T200 25" fill="none" stroke="white" stroke-width="0.8" opacity="0.2" />
                    <path d="M0 75 Q50 90 100 75 T200 75" fill="none" stroke="white" stroke-width="0.8" opacity="0.2" />
                </pattern>

                <!-- Artistic dots pattern -->
                <pattern id="art-dots" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                    <circle cx="15" cy="15" r="1.5" fill="white" opacity="0.3" />
                    <circle cx="45" cy="15" r="1" fill="white" opacity="0.4" />
                    <circle cx="30" cy="30" r="2" fill="white" opacity="0.2" />
                    <circle cx="15" cy="45" r="1" fill="white" opacity="0.4" />
                    <circle cx="45" cy="45" r="1.5" fill="white" opacity="0.3" />
                </pattern>

                <!-- Creative network pattern -->
                <pattern id="creative-network" x="0" y="0" width="150" height="150" patternUnits="userSpaceOnUse">
                    <g opacity="0.25">
                        <circle cx="30" cy="30" r="3" fill="none" stroke="white" stroke-width="0.5" />
                        <circle cx="120" cy="30" r="3" fill="none" stroke="white" stroke-width="0.5" />
                        <circle cx="75" cy="75" r="3" fill="none" stroke="white" stroke-width="0.5" />
                        <circle cx="30" cy="120" r="3" fill="none" stroke="white" stroke-width="0.5" />
                        <circle cx="120" cy="120" r="3" fill="none" stroke="white" stroke-width="0.5" />

                        <line x1="30" y1="30" x2="120" y2="30" stroke="white" stroke-width="0.3" opacity="0.4" />
                        <line x1="30" y1="30" x2="75" y2="75" stroke="white" stroke-width="0.3" opacity="0.4" />
                        <line x1="120" y1="30" x2="75" y2="75" stroke="white" stroke-width="0.3" opacity="0.4" />
                        <line x1="75" y1="75" x2="30" y2="120" stroke="white" stroke-width="0.3" opacity="0.4" />
                        <line x1="75" y1="75" x2="120" y2="120" stroke="white" stroke-width="0.3" opacity="0.4" />
                    </g>
                </pattern>
            </defs>

            <!-- Layer 1: Base geometric mesh -->
            <rect width="100%" height="100%" fill="url(#geometric-mesh)" opacity="0.6" />

            <!-- Layer 2: Portfolio grid overlay -->
            <rect width="100%" height="100%" fill="url(#portfolio-grid)" opacity="0.8" />

            <!-- Layer 3: Flow lines for movement -->
            <rect width="100%" height="100%" fill="url(#flow-lines)" opacity="0.7" transform="rotate(15)" />

            <!-- Layer 4: Artistic dots -->
            <rect width="100%" height="100%" fill="url(#art-dots)" opacity="0.5" />

            <!-- Layer 5: Creative network connections -->
            <rect width="100%" height="100%" fill="url(#creative-network)" opacity="0.4" />

            <!-- Decorative elements -->
            <g opacity="0.15">
                <!-- Large accent circles -->
                <circle cx="20%" cy="25%" r="80" fill="none" stroke="white" stroke-width="1" opacity="0.3" />
                <circle cx="80%" cy="75%" r="120" fill="none" stroke="white" stroke-width="0.8" opacity="0.2" />

                <!-- Creative shapes -->
                <polygon
                    points="10,10 50,30 30,70 -10,50"
                    fill="none"
                    stroke="white"
                    stroke-width="0.6"
                    opacity="0.25"
                    transform="translate(70%, 20%) scale(0.8)"
                />
                <polygon
                    points="0,20 40,0 60,40 20,60"
                    fill="none"
                    stroke="white"
                    stroke-width="0.6"
                    opacity="0.25"
                    transform="translate(15%, 70%) scale(1.2)"
                />

                <!-- Artistic line elements -->
                <path d="M85% 15% Q90% 20% 95% 15% T105% 15%" fill="none" stroke="white" stroke-width="1.2" opacity="0.3" />
                <path d="M5% 85% Q10% 80% 15% 85% T25% 85%" fill="none" stroke="white" stroke-width="1.2" opacity="0.3" />
            </g>
        </svg>
    </div>
</template>
