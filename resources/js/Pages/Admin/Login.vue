<template>
  <Head>
    <title>Admin Login</title>
    <meta name="robots" content="noindex, nofollow" />
  </Head>

  <div class="min-h-screen bg-bg flex items-center justify-center relative px-4">
    <BackgroundLayer />

    <div
      v-motion
      :initial="{ opacity: 0, y: 24, scale: 0.98 }"
      :enter="{ opacity: 1, y: 0, scale: 1, transition: { duration: 550 } }"
      class="relative z-[1] w-full max-w-[420px]"
    >

      <!-- Card -->
      <div class="bg-surface border border-border rounded-2xl overflow-hidden shadow-[0_32px_80px_rgba(0,0,0,0.5)]">

        <!-- Card header -->
        <div class="px-6 sm:px-8 pt-8 pb-6 border-b border-border">
          <div class="flex items-center gap-2.5 mb-5">
            <div class="w-8 h-8 rounded-lg bg-amber/10 border border-amber/20 flex items-center justify-center">
              <svg class="w-4 h-4 text-amber" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <div>
              <div class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3">Restricted Access</div>
              <div class="font-mono text-[11px] font-semibold tracking-[0.12em] text-amber">§ Admin Panel</div>
            </div>
          </div>

          <h1 class="font-display font-bold text-[26px] sm:text-[30px] tracking-[-0.025em] text-text leading-tight">
            Welcome back.
          </h1>
          <p class="font-sans text-text-3 text-[13px] mt-1.5 leading-relaxed">
            Sign in to access your admin dashboard.
          </p>
        </div>

        <!-- Form -->
        <form @submit.prevent="submit" class="px-6 sm:px-8 py-6 space-y-4">

          <!-- Global error -->
          <div
            v-if="form.errors.email"
            v-motion
            :initial="{ opacity: 0, y: -6 }"
            :enter="{ opacity: 1, y: 0, transition: { duration: 300 } }"
            class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-lg border border-coral/30 bg-coral/10"
          >
            <svg class="w-3.5 h-3.5 text-coral shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-mono text-[11px] text-coral">{{ form.errors.email }}</span>
          </div>

          <!-- Email -->
          <div class="space-y-1.5">
            <label class="block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">
              Email address
            </label>
            <input
              v-model="form.email"
              type="email"
              autocomplete="email"
              required
              placeholder="admin@example.com"
              :class="[
                'w-full bg-bg border rounded-lg px-4 py-3 font-mono text-[13px] text-text placeholder-text-3 outline-none transition-all',
                form.errors.email
                  ? 'border-coral/50 ring-1 ring-coral/20'
                  : 'border-border focus:border-amber/40 focus:ring-1 focus:ring-amber/15'
              ]"
            />
          </div>

          <!-- Password -->
          <div class="space-y-1.5">
            <label class="block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">
              Password
            </label>
            <div class="relative">
              <input
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                autocomplete="current-password"
                required
                placeholder="••••••••"
                class="w-full bg-bg border border-border rounded-lg px-4 py-3 font-mono text-[13px] text-text placeholder-text-3 outline-none transition-all focus:border-amber/40 focus:ring-1 focus:ring-amber/15 pr-11"
              />
              <button
                type="button"
                @click="showPassword = !showPassword"
                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-text-3 hover:text-text-2 transition-colors"
              >
                <svg v-if="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                </svg>
              </button>
            </div>
          </div>

          <!-- Remember me -->
          <label class="flex items-center gap-2.5 cursor-pointer select-none group">
            <div class="relative w-4 h-4">
              <input v-model="form.remember" type="checkbox" class="sr-only" />
              <div
                :class="[
                  'w-4 h-4 rounded border transition-all',
                  form.remember
                    ? 'bg-amber border-amber'
                    : 'bg-bg border-border group-hover:border-border-hi'
                ]"
              >
                <svg v-if="form.remember" class="w-full h-full text-[#1a0f08] p-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7" />
                </svg>
              </div>
            </div>
            <span class="font-mono text-[11px] text-text-3 group-hover:text-text-2 transition-colors">Keep me signed in</span>
          </label>

          <!-- Submit -->
          <button
            type="submit"
            :disabled="form.processing"
            class="w-full flex items-center justify-center gap-2 px-5 py-3.5 rounded-full bg-amber text-[#1a0f08] font-mono text-[12px] font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft disabled:opacity-60 disabled:cursor-not-allowed mt-2"
          >
            <svg v-if="form.processing" class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            <span>{{ form.processing ? 'Signing in…' : 'Sign in →' }}</span>
          </button>

        </form>

        <!-- Footer note -->
        <div class="px-6 sm:px-8 pb-6">
          <div class="flex items-center gap-2 pt-5 border-t border-border">
            <svg class="w-3 h-3 text-text-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <span class="font-mono text-[10px] text-text-3 leading-relaxed">
              This URL is private. Do not share it.
            </span>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import BackgroundLayer from '@/Components/Global/BackgroundLayer.vue';

const showPassword = ref(false);

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

function submit() {
  form.post('/ajayupadhyay-secure-login', {
    onError: () => form.reset('password'),
  });
}
</script>
