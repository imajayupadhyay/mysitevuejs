<template>
  <Teleport to="body">
    <Transition
      enter-active-class="transition-all duration-300 ease-out"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition-all duration-200 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="show"
        class="fixed inset-0 z-50 flex items-center justify-center px-4"
        @click.self="$emit('close')"
      >
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-bg/80 backdrop-blur-sm" />

        <!-- Panel -->
        <Transition
          enter-active-class="transition-all duration-300 ease-out"
          enter-from-class="opacity-0 scale-95 translate-y-2"
          enter-to-class="opacity-100 scale-100 translate-y-0"
          leave-active-class="transition-all duration-200 ease-in"
          leave-from-class="opacity-100 scale-100 translate-y-0"
          leave-to-class="opacity-0 scale-95 translate-y-2"
          appear
        >
          <div
            v-if="show"
            class="relative z-10 w-full max-w-sm bg-surface border border-border rounded-3xl p-8 shadow-2xl"
          >
            <!-- Close button -->
            <button
              @click="$emit('close')"
              class="absolute top-4 right-4 w-7 h-7 flex items-center justify-center rounded-full text-text-3 hover:text-text hover:bg-surface-hi transition-colors font-mono text-sm"
            >
              ✕
            </button>

            <!-- Icon -->
            <div class="w-12 h-12 rounded-2xl bg-amber/10 border border-amber/20 flex items-center justify-center mb-5">
              <span class="text-amber text-xl">✓</span>
            </div>

            <!-- Heading -->
            <h3 class="font-display font-semibold text-[28px] leading-[1] tracking-[-0.02em] mb-2">
              Message sent<span class="text-amber">.</span>
            </h3>
            <p class="text-text-2 text-[14px] leading-[1.55] mb-6">
              Thanks for reaching out — I'll get back to you within 24 hours.
            </p>

            <!-- Divider -->
            <div class="h-px bg-border mb-5" />

            <!-- Meta row -->
            <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.14em] text-text-3 mb-5">
              <span class="w-1.5 h-1.5 rounded-full bg-lime" />
              <span>Response &lt; 24h · IST</span>
            </div>

            <!-- CTA -->
            <button
              @click="$emit('close')"
              class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-amber text-[#1a0f08] rounded-full font-mono text-xs font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft"
            >
              Got it <span>→</span>
            </button>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
defineProps({ show: Boolean });
defineEmits(['close']);
</script>
