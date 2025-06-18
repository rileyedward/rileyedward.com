<template>
    <div class="absolute inset-0 opacity-10">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="smallGrid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <path d="M 20 0 L 0 0 0 20" fill="none" stroke="white" stroke-width="0.5" />
                </pattern>
                <pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse">
                    <rect width="100" height="100" fill="url(#smallGrid)" />
                    <path d="M 100 0 L 0 0 0 100" fill="none" stroke="white" stroke-width="1" />
                </pattern>

                <pattern id="diagonalLines" width="40" height="40" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
                    <line x1="0" y1="0" x2="0" y2="40" stroke="white" stroke-width="0.5" />
                    <line x1="20" y1="0" x2="20" y2="40" stroke="white" stroke-width="0.5" />
                </pattern>

                <pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="1" fill="white" />
                </pattern>
            </defs>

            <rect width="100%" height="100%" fill="url(#grid)" />
            <rect width="100%" height="100%" fill="url(#diagonalLines)" opacity="0.3" />
            <rect width="100%" height="100%" fill="url(#dots)" opacity="0.5" />

            <circle cx="10%" cy="20%" r="50" fill="none" stroke="white" stroke-width="0.5" opacity="0.2" />
            <circle cx="90%" cy="80%" r="70" fill="none" stroke="white" stroke-width="0.5" opacity="0.2" />
            <rect x="40%" y="40%" width="20%" height="20%" fill="none" stroke="white" stroke-width="0.5" opacity="0.2" />
        </svg>
    </div>
</template>
