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
        class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center px-0 sm:px-4 py-0 sm:py-6"
        @click.self="close"
      >
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-bg/85 backdrop-blur-md" />

        <!-- Panel -->
        <Transition
          enter-active-class="transition-all duration-300 ease-out"
          enter-from-class="opacity-0 translate-y-6 sm:translate-y-2 sm:scale-[0.97]"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-active-class="transition-all duration-200 ease-in"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-6 sm:translate-y-2 sm:scale-[0.97]"
          appear
        >
          <div
            v-if="show"
            class="relative z-10 w-full sm:max-w-[520px] max-h-[92vh] overflow-y-auto bg-surface border border-border-hi rounded-t-3xl sm:rounded-3xl shadow-[0_-30px_80px_-30px_rgba(255,149,68,0.3),0_30px_80px_-20px_rgba(0,0,0,0.8)]"
          >
            <!-- Success state -->
            <div v-if="status === 'success'" class="p-8 sm:p-10 text-center">
              <div class="w-14 h-14 mx-auto rounded-2xl bg-lime/10 border border-lime/20 flex items-center justify-center mb-5">
                <span class="text-lime text-2xl">✓</span>
              </div>
              <h3 class="font-display font-semibold text-[26px] leading-[1.05] tracking-[-0.02em] mb-2">
                Message sent<span class="text-amber">.</span>
              </h3>
              <p class="text-text-2 text-[14px] leading-[1.55] max-w-[40ch] mx-auto mb-6">
                Thanks for reaching out — I'll get back to you within 24 hours.
              </p>
              <button
                @click="close"
                class="inline-flex items-center gap-2 px-5 py-3 bg-amber text-[#1a0f08] rounded-full font-mono text-xs font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft"
              >
                Close <span>→</span>
              </button>
            </div>

            <!-- Form state -->
            <form v-else @submit.prevent="handleSubmit" autocomplete="off" novalidate>
              <!-- Header -->
              <div class="sticky top-0 z-10 flex items-center justify-between gap-4 px-5 sm:px-8 py-4 sm:py-5 border-b border-border bg-surface/95 backdrop-blur-md">
                <div class="flex items-center gap-2.5 font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-text-3">
                  <span class="w-1.5 h-1.5 rounded-full bg-amber animate-pulse-amber" />
                  <span>Get in touch</span>
                </div>
                <button
                  type="button"
                  @click="close"
                  class="w-8 h-8 flex items-center justify-center rounded-full text-text-3 hover:text-text hover:bg-surface-hi transition-colors font-mono text-sm"
                  aria-label="Close"
                >✕</button>
              </div>

              <div class="p-5 sm:p-8">
                <h3 class="font-display font-semibold text-[24px] sm:text-[30px] leading-[1.05] tracking-[-0.02em] mb-1.5">
                  Open channel<span class="text-amber">.</span>
                </h3>
                <p class="text-text-2 text-[13px] sm:text-[14px] leading-[1.55] mb-6 sm:mb-7">
                  Drop a line — I respond within 24&nbsp;hours.
                </p>

                <!-- Name + Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3.5">
                  <div>
                    <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Name *</label>
                    <input type="text" required maxlength="120" v-model="form.name" placeholder="Your name" :class="inputCls" />
                  </div>
                  <div>
                    <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Email *</label>
                    <input type="email" required maxlength="160" v-model="form.email" placeholder="you@domain.com" :class="inputCls" />
                  </div>
                </div>

                <!-- Phone -->
                <div class="mb-3.5">
                  <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">
                    Phone <span class="text-text-3 normal-case tracking-normal">(optional)</span>
                  </label>
                  <input type="tel" maxlength="40" v-model="form.phone" placeholder="+1 555 123 4567" :class="inputCls" />
                </div>

                <!-- Message -->
                <div class="mb-5">
                  <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Message *</label>
                  <textarea
                    required
                    maxlength="5000"
                    rows="4"
                    v-model="form.message"
                    placeholder="Tell me about your project..."
                    :class="[inputCls, 'resize-y min-h-[110px] leading-[1.5]']"
                  />
                </div>

                <!-- Submit -->
                <button
                  type="submit"
                  :disabled="status === 'sending'"
                  class="w-full group inline-flex items-center justify-between gap-2 px-5 py-[14px] bg-amber text-[#1a0f08] rounded-full font-mono text-xs font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft disabled:opacity-60 disabled:cursor-not-allowed"
                >
                  <span>{{ btnLabel }}</span>
                  <span class="transition-transform group-hover:translate-x-0.5">→</span>
                </button>

                <div v-if="status === 'error'" class="font-mono text-[11px] mt-3.5 text-coral">
                  {{ errorMessage }}
                </div>
                <p class="font-mono text-[10px] text-text-3 mt-3.5 text-center">
                  Response within 24h · Your info is never shared.
                </p>
              </div>
            </form>
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
  show: Boolean,
});

const emit = defineEmits(['close']);

const form = ref({ name: '', email: '', phone: '', message: '' });
const status = ref('idle');
const errorMessage = ref(null);

const inputCls = 'w-full bg-bg-2 border border-border rounded-[10px] px-3.5 py-3 font-sans text-[14px] text-text placeholder:text-text-3 outline-none transition-colors focus:border-amber focus:bg-bg';

const btnLabel = computed(() => {
  if (status.value === 'sending') return 'Sending...';
  return 'Send message';
});

// Reset state whenever modal opens fresh
watch(
  () => props.show,
  (open) => {
    if (open) {
      status.value = 'idle';
      errorMessage.value = null;
    }
  },
);

function close() {
  emit('close');
  setTimeout(() => {
    if (status.value === 'success') {
      form.value = { name: '', email: '', phone: '', message: '' };
      status.value = 'idle';
    }
  }, 300);
}

async function handleSubmit() {
  if (status.value === 'sending') return;
  status.value = 'sending';
  errorMessage.value = null;
  try {
    await axios.post('/contact', form.value);
    status.value = 'success';
  } catch (err) {
    status.value = 'error';
    errorMessage.value = err?.response?.data?.message ?? 'Something went wrong. Please try again.';
  }
}
</script>
