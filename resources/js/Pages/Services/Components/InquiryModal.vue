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
        class="fixed inset-0 z-50 flex items-end sm:items-center justify-center px-0 sm:px-4 py-0 sm:py-6"
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
            class="relative z-10 w-full sm:max-w-[640px] max-h-[92vh] overflow-y-auto bg-surface border border-border-hi rounded-t-3xl sm:rounded-3xl shadow-[0_-30px_80px_-30px_rgba(255,149,68,0.3),0_30px_80px_-20px_rgba(0,0,0,0.8)]"
          >
            <!-- Success state -->
            <div v-if="status === 'success'" class="p-8 sm:p-10 text-center">
              <div class="w-14 h-14 mx-auto rounded-2xl bg-lime/10 border border-lime/20 flex items-center justify-center mb-5">
                <span class="text-lime text-2xl">✓</span>
              </div>
              <h3 class="font-display font-semibold text-[26px] leading-[1.05] tracking-[-0.02em] mb-2">
                Brief received<span class="text-amber">.</span>
              </h3>
              <p class="text-text-2 text-[14px] leading-[1.55] max-w-[44ch] mx-auto mb-6">
                Thanks for the details. I'll review and reply within 24 hours with scope, timeline, and a fixed quote.
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
                  <span>Project Brief</span>
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
                  Let's scope it out<span class="text-amber">.</span>
                </h3>
                <p class="text-text-2 text-[13px] sm:text-[14px] leading-[1.55] mb-6 sm:mb-7">
                  Fill out what you know — I'll reply within 24 hours with next steps.
                </p>

                <!-- Service select -->
                <div class="mb-4">
                  <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Service</label>
                  <div class="relative">
                    <select
                      v-model="form.service"
                      required
                      :class="selectCls"
                    >
                      <option value="" disabled>Pick a service...</option>
                      <option v-for="s in services" :key="s.id" :value="s.title">{{ s.num }} · {{ s.title }}</option>
                      <option value="Other / Not sure yet">Other / Not sure yet</option>
                    </select>
                    <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-text-3 pointer-events-none font-mono text-[11px]">▾</span>
                  </div>
                </div>

                <!-- Name + Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                  <div>
                    <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Name *</label>
                    <input type="text" required maxlength="120" v-model="form.name" placeholder="Your name" :class="inputCls" />
                  </div>
                  <div>
                    <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Email *</label>
                    <input type="email" required maxlength="160" v-model="form.email" placeholder="you@domain.com" :class="inputCls" />
                  </div>
                </div>

                <!-- Phone + Company -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                  <div>
                    <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Phone <span class="text-text-3 normal-case tracking-normal">(optional)</span></label>
                    <input type="tel" maxlength="40" v-model="form.phone" placeholder="+1 555 123 4567" :class="inputCls" />
                  </div>
                  <div>
                    <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Company <span class="text-text-3 normal-case tracking-normal">(optional)</span></label>
                    <input type="text" maxlength="160" v-model="form.company" placeholder="Acme Inc." :class="inputCls" />
                  </div>
                </div>

                <!-- Budget chips -->
                <div class="mb-4">
                  <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Budget range</label>
                  <div class="flex flex-wrap gap-2">
                    <button
                      v-for="b in budgetOptions"
                      :key="b"
                      type="button"
                      @click="form.budget = form.budget === b ? '' : b"
                      :class="[
                        'px-3 py-1.5 rounded-full border font-mono text-[11px] transition-colors',
                        form.budget === b
                          ? 'border-amber bg-amber/10 text-amber'
                          : 'border-border bg-bg-2 text-text-2 hover:border-border-hi hover:text-text',
                      ]"
                    >{{ b }}</button>
                  </div>
                </div>

                <!-- Timeline chips -->
                <div class="mb-4">
                  <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Timeline</label>
                  <div class="flex flex-wrap gap-2">
                    <button
                      v-for="t in timelineOptions"
                      :key="t"
                      type="button"
                      @click="form.timeline = form.timeline === t ? '' : t"
                      :class="[
                        'px-3 py-1.5 rounded-full border font-mono text-[11px] transition-colors',
                        form.timeline === t
                          ? 'border-sky bg-sky/10 text-sky'
                          : 'border-border bg-bg-2 text-text-2 hover:border-border-hi hover:text-text',
                      ]"
                    >{{ t }}</button>
                  </div>
                </div>

                <!-- Details -->
                <div class="mb-5">
                  <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Project details *</label>
                  <textarea
                    required
                    maxlength="5000"
                    rows="5"
                    v-model="form.details"
                    placeholder="Current stack, challenges, what success looks like..."
                    :class="[inputCls, 'resize-y min-h-[120px] leading-[1.55]']"
                  />
                  <div class="flex justify-between font-mono text-[10px] text-text-3 mt-2">
                    <span>Pro tip: include stack + pain points.</span>
                    <span>{{ form.details.length }}/5000</span>
                  </div>
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
import { services, budgetOptions, timelineOptions } from '@/data/services.js';

const props = defineProps({
  show: Boolean,
  service: { type: Object, default: null },
});

const emit = defineEmits(['close']);

const form = ref({
  service: '',
  name: '',
  email: '',
  phone: '',
  company: '',
  budget: '',
  timeline: '',
  details: '',
});

const status = ref('idle');
const errorMessage = ref(null);

const inputCls = 'w-full bg-bg-2 border border-border rounded-[10px] px-3.5 py-3 font-sans text-[14px] text-text placeholder:text-text-3 outline-none transition-colors focus:border-amber focus:bg-bg';
const selectCls = inputCls + ' appearance-none pr-10 cursor-pointer';

const btnLabel = computed(() => {
  if (status.value === 'sending') return 'Sending brief...';
  return 'Send brief';
});

// Pre-fill service when modal opens with a specific service
watch(
  () => props.show,
  (open) => {
    if (open) {
      status.value = 'idle';
      errorMessage.value = null;
      if (props.service?.title) {
        form.value.service = props.service.title;
      } else if (!form.value.service) {
        form.value.service = '';
      }
    }
  },
);

function close() {
  emit('close');
  // Reset form after close animation
  setTimeout(() => {
    if (status.value === 'success') {
      form.value = {
        service: '', name: '', email: '', phone: '',
        company: '', budget: '', timeline: '', details: '',
      };
      status.value = 'idle';
    }
  }, 300);
}

async function handleSubmit() {
  if (status.value === 'sending') return;
  status.value = 'sending';
  errorMessage.value = null;
  try {
    await axios.post('/service-inquiry', form.value);
    status.value = 'success';
  } catch (err) {
    status.value = 'error';
    errorMessage.value = err?.response?.data?.message ?? 'Something went wrong. Please try again.';
  }
}
</script>
