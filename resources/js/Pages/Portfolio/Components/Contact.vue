<template>
  <section id="contact" class="py-10 sm:py-[60px]">
    <div class="flex justify-between items-end gap-6 mb-6 sm:mb-9 pb-[18px] border-b border-border">
      <div>
        <div class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-2.5">§ Contact</div>
        <h2 class="font-display font-semibold text-[clamp(36px,5vw,64px)] leading-[0.95] tracking-[-0.025em] max-w-[20ch]">
          Open <span class="italic text-text-2 font-normal">channel.</span>
        </h2>
      </div>
      <div class="hidden sm:block font-mono text-[11px] text-text-3 uppercase tracking-[0.1em] whitespace-nowrap">Response &lt; 24h</div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3.5">
      <!-- Left — Info card -->
      <div
        v-motion
        :initial="{ opacity: 0, y: 24 }"
        :visible-once="{ opacity: 1, y: 0, transition: { duration: 550 } }"
        class="bg-surface border border-border rounded-3xl px-5 py-6 sm:px-8 sm:py-9 flex flex-col"
      >
        <h3 class="font-display font-semibold text-[clamp(28px,4vw,52px)] leading-[0.95] tracking-[-0.025em] mb-3 sm:mb-4">
          Let's build<br />
          <span class="italic font-medium bg-gradient-to-r from-amber to-coral bg-clip-text text-transparent">something reliable.</span>
        </h3>
        <p class="text-text-2 text-[14px] sm:text-[15px] leading-[1.55] mb-5 sm:mb-6 max-w-[42ch]">
          Open to DevOps, Cloud Engineering, and Infrastructure roles. Drop a line — I respond within 24 hours.
        </p>

        <div class="grid gap-px bg-border rounded-xl overflow-hidden mt-auto">
          <a
            v-for="l in links"
            :key="l.key"
            :href="l.href"
            :target="l.external ? '_blank' : undefined"
            :rel="l.external ? 'noopener noreferrer' : undefined"
            class="group grid grid-cols-[64px_1fr_auto] sm:grid-cols-[88px_1fr_auto] gap-3 sm:gap-3.5 items-center px-3.5 py-3 sm:px-4 sm:py-3.5 bg-surface text-text transition-colors hover:bg-surface-hi"
          >
            <span class="font-mono text-[9px] sm:text-[10px] uppercase tracking-[0.14em] text-text-3">{{ l.key }}</span>
            <span class="font-mono text-[12px] sm:text-[13px] text-text truncate">{{ l.val }}</span>
            <span class="font-mono text-[14px] text-text-3 transition-all group-hover:text-amber group-hover:translate-x-0.5">→</span>
          </a>
        </div>
      </div>

      <!-- Right — Form -->
      <div
        v-motion
        :initial="{ opacity: 0, y: 24 }"
        :visible-once="{ opacity: 1, y: 0, transition: { delay: 50, duration: 550 } }"
        class="bg-surface border border-border rounded-3xl p-5 sm:p-8"
      >
        <div class="flex items-center gap-2.5 font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-text-3 mb-5">
          <span class="w-1.5 h-1.5 rounded-full bg-amber" />
          <span>Send a message</span>
        </div>

        <form @submit.prevent="handleSubmit" autocomplete="off" novalidate>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3.5">
            <div>
              <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Name</label>
              <input
                type="text"
                required
                maxlength="120"
                v-model="form.name"
                placeholder="Your name"
                :class="inputCls"
              />
            </div>
            <div>
              <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Email</label>
              <input
                type="email"
                required
                maxlength="160"
                v-model="form.email"
                placeholder="you@domain.com"
                :class="inputCls"
              />
            </div>
          </div>

          <div class="mb-3.5">
            <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">
              Phone <span class="text-text-3 normal-case tracking-normal">(optional)</span>
            </label>
            <input
              type="tel"
              maxlength="40"
              v-model="form.phone"
              placeholder="+1 555 123 4567"
              :class="inputCls"
            />
          </div>

          <div class="mb-3.5">
            <label class="block font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-text-3 mb-2">Message</label>
            <textarea
              required
              maxlength="5000"
              rows="4"
              v-model="form.message"
              placeholder="Tell me about your project..."
              :class="[inputCls, 'resize-y min-h-[100px] leading-[1.5]']"
            />
          </div>

          <button
            type="submit"
            :disabled="status === 'sending'"
            class="inline-flex items-center gap-2.5 px-[22px] py-[13px] bg-amber text-[#1a0f08] rounded-full font-mono text-xs font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft hover:translate-x-0.5 disabled:opacity-60 disabled:cursor-not-allowed disabled:transform-none"
          >
            {{ btnLabel }} <span>→</span>
          </button>

          <div class="font-mono text-[11px] mt-3.5 min-h-4">
            <span v-if="status === 'error'" class="text-coral">{{ errorMessage }}</span>
          </div>
        </form>
      </div>
    </div>

    <SuccessModal :show="showSuccessModal" @close="showSuccessModal = false" />
  </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';
import SuccessModal from '@/Components/Global/SuccessModal.vue';

const form = ref({ name: '', email: '', phone: '', message: '' });
const status = ref('idle');
const errorMessage = ref(null);
const showSuccessModal = ref(false);

const btnLabel = computed(() => {
  if (status.value === 'sending') return 'Sending...';
  if (status.value === 'success') return 'Message sent ✓';
  return 'Send message';
});

const inputCls = 'w-full bg-bg-2 border border-border rounded-[10px] px-3.5 py-3 font-sans text-[14px] text-text placeholder:text-text-3 outline-none transition-colors focus:border-amber focus:bg-bg';

async function handleSubmit() {
  if (status.value === 'sending') return;
  status.value = 'sending';
  errorMessage.value = null;
  try {
    await axios.post('/contact', form.value);
    status.value = 'success';
    form.value = { name: '', email: '', phone: '', message: '' };
    showSuccessModal.value = true;
    setTimeout(() => { status.value = 'idle'; }, 4000);
  } catch (err) {
    status.value = 'error';
    errorMessage.value = err?.response?.data?.error ?? 'Something went wrong.';
  }
}

const links = [
  { key: 'Email', val: 'ajayupadhyaydevops@gmail.com', href: 'mailto:ajayupadhyaydevops@gmail.com', external: false },
  { key: 'Phone', val: '+91 97179 69678', href: 'tel:+919717969678', external: false },
  { key: 'GitHub', val: 'github.com/imajayupadhyay', href: 'https://github.com/imajayupadhyay', external: true },
  { key: 'LinkedIn', val: 'ajay-upadhyay-devops', href: 'https://www.linkedin.com/in/ajay-upadhyay-devops/', external: true },
  { key: 'Location', val: 'New Delhi, India · IST', href: 'https://maps.google.com/?q=New%20Delhi%2C%20India', external: true },
];
</script>
