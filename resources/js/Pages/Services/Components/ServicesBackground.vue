<template>
  <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden" aria-hidden="true">
    <!-- Grid overlay -->
    <svg class="absolute inset-0 w-full h-full opacity-[0.025]" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <pattern id="services-grid" width="56" height="56" patternUnits="userSpaceOnUse">
          <path d="M 56 0 L 0 0 0 56" fill="none" stroke="currentColor" stroke-width="0.5" class="text-text" />
        </pattern>
      </defs>
      <rect width="100%" height="100%" fill="url(#services-grid)" />
    </svg>

    <!-- Pipeline trace — top right -->
    <svg class="absolute top-[12%] -right-[40px] w-[280px] opacity-[0.08] text-amber animate-drift-float [animation-duration:38s]" viewBox="0 0 280 120" fill="none" stroke="currentColor" stroke-width="1.2">
      <circle cx="20" cy="60" r="6" />
      <path d="M26 60 L80 60" stroke-dasharray="2 4" />
      <rect x="80" y="48" width="40" height="24" rx="4" />
      <path d="M120 60 L175 60" stroke-dasharray="2 4" />
      <rect x="175" y="40" width="50" height="40" rx="4" />
      <path d="M225 60 L260 60" stroke-dasharray="2 4" />
      <circle cx="266" cy="60" r="6" />
      <circle cx="100" cy="60" r="2" fill="currentColor" />
      <circle cx="200" cy="60" r="2" fill="currentColor" />
    </svg>

    <!-- Kubernetes heptagon — mid left -->
    <svg class="absolute top-[42%] -left-[40px] w-[200px] opacity-[0.07] text-sky animate-orbit-spin [animation-duration:120s]" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="1.4">
      <polygon points="100,20 170,60 170,140 100,180 30,140 30,60" />
      <polygon points="100,50 140,72 140,128 100,150 60,128 60,72" stroke-dasharray="3 4" />
      <circle cx="100" cy="100" r="14" />
      <line x1="100" y1="50" x2="100" y2="86" />
      <line x1="140" y1="72" x2="112" y2="94" />
      <line x1="140" y1="128" x2="112" y2="106" />
      <line x1="100" y1="150" x2="100" y2="114" />
      <line x1="60" y1="128" x2="88" y2="106" />
      <line x1="60" y1="72" x2="88" y2="94" />
    </svg>

    <!-- Git branch — bottom right -->
    <svg class="absolute bottom-[18%] right-[6%] w-[160px] opacity-[0.08] text-lime animate-drift-float [animation-duration:30s] [animation-delay:-8s]" viewBox="0 0 160 200" fill="none" stroke="currentColor" stroke-width="1.4">
      <line x1="30" y1="20" x2="30" y2="180" />
      <circle cx="30" cy="40" r="6" />
      <circle cx="30" cy="100" r="6" />
      <circle cx="30" cy="160" r="6" />
      <path d="M30 70 C30 70 30 88 60 90 L110 90" />
      <line x1="110" y1="40" x2="110" y2="140" />
      <circle cx="110" cy="90" r="6" />
      <circle cx="110" cy="140" r="6" />
      <path d="M110 140 C110 140 90 160 60 160" />
    </svg>

    <!-- Cluster nodes — mid right -->
    <svg class="absolute top-[20%] right-[28%] w-[120px] opacity-[0.06] text-violet animate-drift-float [animation-duration:26s] [animation-delay:-4s]" viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="1.3">
      <circle cx="60" cy="20" r="8" />
      <circle cx="20" cy="60" r="8" />
      <circle cx="100" cy="60" r="8" />
      <circle cx="40" cy="100" r="8" />
      <circle cx="80" cy="100" r="8" />
      <line x1="60" y1="28" x2="20" y2="52" />
      <line x1="60" y1="28" x2="100" y2="52" />
      <line x1="20" y1="68" x2="40" y2="92" />
      <line x1="100" y1="68" x2="80" y2="92" />
      <line x1="40" y1="100" x2="80" y2="100" />
      <line x1="60" y1="28" x2="60" y2="100" stroke-dasharray="2 3" />
    </svg>

    <!-- Terminal blocks — bottom left -->
    <svg class="absolute bottom-[26%] left-[8%] w-[140px] opacity-[0.07] text-coral animate-drift-float [animation-duration:34s] [animation-delay:-16s]" viewBox="0 0 140 100" fill="none" stroke="currentColor" stroke-width="1.3">
      <rect x="4" y="4" width="132" height="92" rx="4" />
      <line x1="4" y1="20" x2="136" y2="20" />
      <circle cx="14" cy="12" r="2" fill="currentColor" />
      <circle cx="22" cy="12" r="2" fill="currentColor" />
      <circle cx="30" cy="12" r="2" fill="currentColor" />
      <line x1="14" y1="34" x2="40" y2="34" />
      <line x1="46" y1="34" x2="90" y2="34" />
      <line x1="14" y1="48" x2="70" y2="48" />
      <line x1="14" y1="62" x2="30" y2="62" />
      <line x1="36" y1="62" x2="110" y2="62" />
      <line x1="14" y1="76" x2="50" y2="76" />
    </svg>
  </div>
</template>
