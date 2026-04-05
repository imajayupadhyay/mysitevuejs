<template>
  <section id="capabilities" class="py-10 sm:py-[72px]">
    <div class="flex justify-between items-end gap-6 mb-6 sm:mb-9 pb-[18px] border-b border-border">
      <div>
        <div class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-2.5">§ Capabilities</div>
        <h2 class="font-display font-semibold text-[clamp(36px,5vw,64px)] leading-[0.95] tracking-[-0.025em] max-w-[22ch]">
          Three clusters, <span class="italic text-text-2 font-normal">twelve services.</span>
        </h2>
      </div>
      <Link
        href="/services"
        class="hidden sm:inline-flex items-center gap-1.5 font-mono text-[11px] text-text-2 px-3 py-1.5 border border-border rounded-full transition-all hover:text-amber hover:border-amber whitespace-nowrap"
      >View all 12 <span>→</span></Link>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3.5">
      <Link
        v-for="(c, i) in clusters"
        :key="c.id"
        :href="`/services`"
        v-motion
        :initial="{ opacity: 0, y: 24 }"
        :visible-once="{ opacity: 1, y: 0, transition: { delay: i * 80, duration: 550 } }"
        :hovered="{ y: -4 }"
        :class="[
          'group relative overflow-hidden bg-surface border border-border rounded-[20px] px-5 py-6 sm:px-7 sm:py-8 flex flex-col transition-colors hover:bg-surface-hi',
          c.hoverBorder,
        ]"
      >
        <!-- Numbered badge + count -->
        <div class="flex items-center justify-between mb-6 sm:mb-8">
          <div :class="['font-display font-bold text-[56px] sm:text-[72px] leading-none tracking-[-0.03em] opacity-90', c.numColor]">{{ c.num }}</div>
          <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3">{{ c.count }} services</span>
        </div>

        <!-- Title -->
        <h3 class="font-display font-semibold text-[22px] sm:text-[26px] leading-[1.15] tracking-[-0.01em] mb-2">
          {{ c.title }}
        </h3>
        <p class="font-mono text-[11px] text-text-3 mb-5">{{ c.tagline }}</p>

        <!-- Service list -->
        <ul class="list-none grid gap-2 mb-6 flex-1">
          <li
            v-for="item in c.items"
            :key="item"
            :class="['relative pl-[18px] text-[13px] leading-[1.5] text-text-2 before:absolute before:left-0 before:top-[2px] before:content-[\'→\'] before:font-mono before:font-semibold', c.bulletColor]"
          >{{ item }}</li>
        </ul>

        <!-- CTA pill -->
        <span :class="['mt-auto inline-flex items-center justify-between gap-2 px-4 py-2.5 rounded-full border font-mono text-[11px] font-semibold uppercase tracking-[0.1em] transition-all group-hover:translate-x-0.5', c.ctaClass]">
          <span>View services</span>
          <span class="transition-transform group-hover:translate-x-0.5">→</span>
        </span>

        <!-- Glow + accent -->
        <div :class="['absolute -top-6 -right-6 w-[160px] h-[160px] opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none blur-3xl rounded-full', c.glow]" />
        <span :class="['absolute left-0 top-0 bottom-0 w-[2px] scale-y-0 group-hover:scale-y-100 origin-top transition-transform duration-500', c.accent]" />
      </Link>
    </div>

    <!-- Mobile "view all" -->
    <Link
      href="/services"
      class="sm:hidden mt-5 inline-flex items-center gap-1.5 font-mono text-[11px] text-text-2 px-3 py-1.5 border border-border rounded-full transition-all hover:text-amber hover:border-amber"
    >View all 12 services <span>→</span></Link>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const clusters = [
  {
    id: 'cloud',
    num: '01',
    title: 'Cloud Platforms',
    tagline: 'AWS · Azure · DigitalOcean',
    count: '4',
    items: [
      'AWS Cloud Setup (EC2, VPC, RDS)',
      'AWS Serverless (Lambda, SNS, SQS)',
      'Azure Cloud Engineering',
      'Azure DevOps Pipelines',
    ],
    numColor: 'text-amber',
    hoverBorder: 'hover:border-amber/50',
    bulletColor: 'before:text-amber',
    accent: 'bg-gradient-to-b from-amber to-transparent',
    glow: 'bg-amber/30',
    ctaClass: 'border-border text-text-2 group-hover:border-amber group-hover:text-amber',
  },
  {
    id: 'devops',
    num: '02',
    title: 'DevOps & Infrastructure',
    tagline: 'Kubernetes · Terraform · CI/CD',
    count: '4',
    items: [
      'Kubernetes Engineering (EKS, AKS)',
      'Docker & Container Orchestration',
      'Terraform Infrastructure as Code',
      'CI/CD Automation (Actions, Jenkins)',
    ],
    numColor: 'text-lime',
    hoverBorder: 'hover:border-lime/50',
    bulletColor: 'before:text-lime',
    accent: 'bg-gradient-to-b from-lime to-transparent',
    glow: 'bg-lime/30',
    ctaClass: 'border-border text-text-2 group-hover:border-lime group-hover:text-lime',
  },
  {
    id: 'reliability',
    num: '03',
    title: 'Monitoring & Web',
    tagline: 'Prometheus · Grafana · Laravel',
    count: '4',
    items: [
      'Observability (Prometheus, Grafana)',
      'Cloud Monitoring (CloudWatch, NewRelic)',
      'Full-Stack Web (Laravel, React, NGINX)',
      'AI Dev Tooling (Amazon Q, Claude Code)',
    ],
    numColor: 'text-violet',
    hoverBorder: 'hover:border-violet/50',
    bulletColor: 'before:text-violet',
    accent: 'bg-gradient-to-b from-violet to-transparent',
    glow: 'bg-violet/30',
    ctaClass: 'border-border text-text-2 group-hover:border-violet group-hover:text-violet',
  },
];
</script>
