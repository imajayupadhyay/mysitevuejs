<template>
  <Head>
    <title>Ajay Upadhyay — DevOps &amp; Cloud Engineer</title>
    <meta name="description" content="DevOps &amp; Cloud Engineer specializing in AWS, Azure, Kubernetes, Terraform, and CI/CD pipelines. 3+ years of experience, 4 certifications. Open to new roles — based in New Delhi, India." />
    <meta name="keywords" content="DevOps Engineer, Cloud Engineer, AWS, Azure, Kubernetes, Terraform, CI/CD, Infrastructure as Code, Site Reliability Engineer, New Delhi, India" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://ajayupadhyay.com/" />
    <!-- Open Graph -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://ajayupadhyay.com/" />
    <meta property="og:title" content="Ajay Upadhyay — DevOps &amp; Cloud Engineer" />
    <meta property="og:description" content="DevOps &amp; Cloud Engineer specializing in AWS, Azure, Kubernetes, Terraform, and CI/CD pipelines. 3+ years of experience, 4 certifications." />
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Ajay Upadhyay — DevOps &amp; Cloud Engineer" />
    <meta name="twitter:description" content="DevOps &amp; Cloud Engineer specializing in AWS, Azure, Kubernetes, Terraform, and CI/CD pipelines. 3+ years of experience, 4 certifications." />
  </Head>
  <div>
    <BackgroundLayer />
    <section class="relative z-[1] min-h-screen flex items-center">
      <div class="max-w-[1240px] mx-auto px-4 sm:px-7 py-16 sm:py-24 w-full">
        <!-- Status pill -->
        <div
          v-motion
          :initial="{ opacity: 0, y: 16 }"
          :enter="{ opacity: 1, y: 0, transition: { duration: 500 } }"
          class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full border border-border bg-surface font-mono text-[11px] text-text-2 mb-6 sm:mb-9"
        >
          <span class="w-1.5 h-1.5 rounded-full bg-lime shadow-[0_0_10px_#c8ff4d]" />
          <span>Available for new roles</span>
          <span class="text-text-3">·</span>
          <span>New Delhi · IST</span>
        </div>

        <!-- Headline -->
        <h1
          v-motion
          :initial="{ opacity: 0, y: 24 }"
          :enter="{ opacity: 1, y: 0, transition: { delay: 80, duration: 650 } }"
          class="font-display font-bold tracking-[-0.035em] leading-[0.88] text-[clamp(44px,10vw,156px)] max-w-[14ch] mb-5 sm:mb-7"
        >
          Ship infra<br />
          that stays&nbsp;<span class="italic font-medium bg-gradient-to-r from-amber to-coral bg-clip-text text-transparent">up.</span>
        </h1>

        <!-- Subcopy -->
        <p
          v-motion
          :initial="{ opacity: 0, y: 16 }"
          :enter="{ opacity: 1, y: 0, transition: { delay: 180, duration: 500 } }"
          class="text-text-2 text-[15px] sm:text-[17px] leading-[1.55] max-w-[56ch] mb-8 sm:mb-10 font-sans"
        >
          I'm <span class="text-text font-medium">{{ personalInfo.name }}</span> — a DevOps &amp;
          Cloud Engineer architecting multi-cloud infrastructure, CI/CD pipelines, and observability
          across AWS &amp; Azure. Three years in, four certifications deep.
        </p>

        <!-- CTAs -->
        <div
          v-motion
          :initial="{ opacity: 0, y: 16 }"
          :enter="{ opacity: 1, y: 0, transition: { delay: 280, duration: 500 } }"
          class="flex flex-wrap items-center gap-3 mb-10 sm:mb-16"
        >
          <Link
            href="/portfolio"
            class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-amber text-[#1a0f08] font-mono text-[12px] font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft hover:translate-x-0.5"
          >View portfolio <span>→</span></Link>
          <Link
            href="/services"
            class="inline-flex items-center gap-2 px-5 py-3 rounded-full border border-border bg-surface font-mono text-[12px] text-text-2 transition-colors hover:text-text hover:border-border-hi hover:bg-surface-hi"
          >Services ↗</Link>
        </div>

        <!-- Quick stats strip -->
        <div
          v-motion
          :initial="{ opacity: 0 }"
          :enter="{ opacity: 1, transition: { delay: 450, duration: 600 } }"
          class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-3.5 max-w-3xl border-t border-border pt-5 sm:pt-7"
        >
          <div v-for="s in quickStats" :key="s.label">
            <div class="font-display font-bold text-[32px] sm:text-[44px] leading-none tracking-[-0.02em] text-text">{{ s.value }}</div>
            <div class="font-mono text-[9px] sm:text-[10px] uppercase tracking-[0.14em] text-text-3 mt-2 sm:mt-2.5">{{ s.label }}</div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import BackgroundLayer from '@/Components/Global/BackgroundLayer.vue';
import { personalInfo } from '@/data/resume.js';

defineOptions({ layout: MainLayout });

const quickStats = [
  { value: '3+', label: 'Years' },
  { value: '110+', label: 'Projects' },
  { value: '99.9%', label: 'Uptime' },
  { value: '4', label: 'Certs' },
];
</script>
