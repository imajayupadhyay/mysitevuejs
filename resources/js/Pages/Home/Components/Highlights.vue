<template>
  <section id="highlights" class="py-10 sm:py-[72px]">
    <div class="flex justify-between items-end gap-6 mb-6 sm:mb-9 pb-[18px] border-b border-border">
      <div>
        <div class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-2.5">§ Highlights</div>
        <h2 class="font-display font-semibold text-[clamp(36px,5vw,64px)] leading-[0.95] tracking-[-0.025em] max-w-[22ch]">
          Selected <span class="italic text-text-2 font-normal">field work.</span>
        </h2>
      </div>
      <Link
        href="/portfolio#work"
        class="hidden sm:inline-flex items-center gap-1.5 font-mono text-[11px] text-text-2 px-3 py-1.5 border border-border rounded-full transition-all hover:text-amber hover:border-amber whitespace-nowrap"
      >Full log <span>→</span></Link>
    </div>

    <!-- Vertical timeline (distinct from Portfolio's horizontal Experience cards) -->
    <div class="grid gap-3.5">
      <div
        v-for="(h, i) in highlights"
        :key="h.company"
        v-motion
        :initial="{ opacity: 0, y: 24 }"
        :visible-once="{ opacity: 1, y: 0, transition: { delay: i * 80, duration: 550 } }"
        class="group relative overflow-hidden grid md:grid-cols-[180px_1fr_auto] items-start gap-4 md:gap-6 bg-surface border border-border rounded-[20px] px-5 py-5 sm:px-7 sm:py-6 transition-colors hover:border-border-hi hover:bg-surface-hi"
      >
        <!-- Period column -->
        <div class="flex flex-col gap-2 md:border-r md:border-dashed md:border-border md:pr-6">
          <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.14em]">
            <span :class="['w-1.5 h-1.5 rounded-full', h.dotClass]" />
            <span :class="h.textClass">{{ h.tag }}</span>
          </div>
          <span class="font-mono text-[11px] text-text-3">{{ h.period }}</span>
        </div>

        <!-- Main column -->
        <div class="min-w-0">
          <h3 class="font-display font-semibold text-[20px] sm:text-[22px] tracking-[-0.01em] leading-[1.2] mb-1">
            {{ h.company }}
          </h3>
          <div class="font-mono text-[12px] text-amber mb-3">{{ h.role }}</div>
          <p class="text-[13px] sm:text-[14px] leading-[1.55] text-text-2 max-w-[64ch]">{{ h.summary }}</p>
          <!-- Chip strip -->
          <div class="flex flex-wrap gap-1.5 mt-3.5">
            <span
              v-for="t in h.tags"
              :key="t"
              class="font-mono text-[10px] px-2 py-0.5 border border-border rounded-md text-text-3 bg-bg-2"
            >{{ t }}</span>
          </div>
        </div>

        <!-- Arrow indicator -->
        <div class="hidden md:flex items-center self-center text-text-3 group-hover:text-amber group-hover:translate-x-0.5 transition-all font-mono">
          →
        </div>
      </div>
    </div>

    <!-- Mobile full log link -->
    <Link
      href="/portfolio#work"
      class="sm:hidden mt-5 inline-flex items-center gap-1.5 font-mono text-[11px] text-text-2 px-3 py-1.5 border border-border rounded-full transition-all hover:text-amber hover:border-amber"
    >View full log <span>→</span></Link>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const highlights = [
  {
    tag: 'Current',
    period: 'Dec 2025 — now',
    company: 'CloudBoson Technologies',
    role: 'DevOps Engineer',
    summary: 'Managing 50+ AWS projects (Beanstalk, Lambda, SNS, SQS, RDS) and 60+ Azure production workloads. Architecting CloudFormation stacks and Azure DevOps CI/CD pipelines for zero-downtime multi-env deployments.',
    tags: ['AWS', 'Azure', 'CloudFormation', 'Azure DevOps'],
    dotClass: 'bg-lime shadow-[0_0_10px_#c8ff4d]',
    textClass: 'text-lime',
  },
  {
    tag: 'DevOps',
    period: 'Jul 2024 — Dec 2025',
    company: 'Jellyfish Technologies',
    role: 'DevOps Engineer',
    summary: 'Orchestrated multi-cloud infrastructure across Azure, AWS, and DigitalOcean at 99.9% uptime. Reduced cloud storage costs 30% via Azure Blob + S3 lifecycle policies. Owned observability with Azure Monitor + CloudWatch.',
    tags: ['GitHub Actions', 'Jenkins', 'Terraform', 'CloudWatch'],
    dotClass: 'bg-amber',
    textClass: 'text-amber',
  },
  {
    tag: 'Full Stack',
    period: 'Dec 2022 — Jul 2024',
    company: '99Notes EdTech',
    role: 'Full Stack Developer',
    summary: 'Built Laravel + modern JS web apps, managed 10+ production WordPress sites with 40% load-time gains. Administered DigitalOcean infrastructure and built RESTful APIs supporting 5,000+ concurrent users.',
    tags: ['Laravel', 'React', 'MySQL', 'DigitalOcean'],
    dotClass: 'bg-coral',
    textClass: 'text-coral',
  },
];
</script>
