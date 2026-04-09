<template>
  <Head>
    <title>Contacts — Admin</title>
    <meta name="robots" content="noindex, nofollow" />
  </Head>

  <div class="max-w-[1100px] mx-auto px-4 sm:px-8 py-10">

    <!-- Page header -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 16 }"
      :enter="{ opacity: 1, y: 0, transition: { duration: 450 } }"
      class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8"
    >
      <div>
        <p class="font-mono text-[10px] uppercase tracking-[0.16em] text-text-3 mb-1.5">Admin · Contacts</p>
        <h1 class="font-display font-bold text-[28px] sm:text-[36px] tracking-[-0.025em] text-text leading-none">
          Contact Messages
        </h1>
      </div>

      <!-- Search -->
      <div class="relative w-full sm:w-64">
        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-text-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input
          v-model="search"
          type="text"
          placeholder="Search messages…"
          class="w-full bg-surface border border-border rounded-lg pl-9 pr-4 py-2.5 font-mono text-[12px] text-text placeholder-text-3 outline-none focus:border-amber/40 focus:ring-1 focus:ring-amber/15 transition-all"
        />
      </div>
    </div>

    <!-- Stats row -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 12 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 60, duration: 400 } }"
      class="grid grid-cols-3 gap-3 sm:gap-4 mb-6"
    >
      <div class="bg-surface border border-border rounded-xl px-4 py-4">
        <div class="font-mono text-[9px] uppercase tracking-[0.14em] text-text-3 mb-1.5">Total</div>
        <div class="font-display font-bold text-[28px] sm:text-[34px] tracking-tight text-text leading-none">{{ stats.total }}</div>
      </div>
      <div class="bg-surface border border-border rounded-xl px-4 py-4">
        <div class="font-mono text-[9px] uppercase tracking-[0.14em] text-text-3 mb-1.5">Unread</div>
        <div class="font-display font-bold text-[28px] sm:text-[34px] tracking-tight text-coral leading-none">{{ stats.unread }}</div>
      </div>
      <div class="bg-surface border border-border rounded-xl px-4 py-4">
        <div class="font-mono text-[9px] uppercase tracking-[0.14em] text-text-3 mb-1.5">Read</div>
        <div class="font-display font-bold text-[28px] sm:text-[34px] tracking-tight text-amber leading-none">{{ stats.read }}</div>
      </div>
    </div>

    <!-- Filter tabs -->
    <div
      v-motion
      :initial="{ opacity: 0 }"
      :enter="{ opacity: 1, transition: { delay: 100, duration: 400 } }"
      class="flex items-center gap-1 mb-5 bg-surface border border-border rounded-lg p-1 w-fit"
    >
      <button
        v-for="tab in statusTabs"
        :key="tab.value"
        @click="setStatus(tab.value)"
        :class="[
          'px-3.5 py-1.5 rounded-md font-mono text-[11px] tracking-wide transition-all',
          activeStatus === tab.value
            ? 'bg-amber text-[#1a0f08] font-semibold'
            : 'text-text-3 hover:text-text'
        ]"
      >
        {{ tab.label }}
      </button>
    </div>

    <!-- Table -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 12 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 140, duration: 450 } }"
      class="bg-surface border border-border rounded-xl overflow-hidden"
    >
      <!-- Empty state -->
      <div v-if="contacts.data.length === 0" class="py-16 flex flex-col items-center gap-3 text-center">
        <svg class="w-8 h-8 text-text-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
        <p class="font-mono text-[12px] text-text-3">No messages found</p>
      </div>

      <!-- Table -->
      <div v-else class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="border-b border-border">
              <th class="text-left px-5 py-3 font-mono text-[9px] uppercase tracking-[0.14em] text-text-3">Name</th>
              <th class="text-left px-5 py-3 font-mono text-[9px] uppercase tracking-[0.14em] text-text-3 hidden sm:table-cell">Email</th>
              <th class="text-left px-5 py-3 font-mono text-[9px] uppercase tracking-[0.14em] text-text-3 hidden lg:table-cell">Message</th>
              <th class="text-left px-5 py-3 font-mono text-[9px] uppercase tracking-[0.14em] text-text-3 hidden md:table-cell">Date</th>
              <th class="text-left px-5 py-3 font-mono text-[9px] uppercase tracking-[0.14em] text-text-3">Status</th>
              <th class="px-5 py-3" />
            </tr>
          </thead>
          <tbody class="divide-y divide-border">
            <tr
              v-for="contact in contacts.data"
              :key="contact.id"
              class="group transition-colors hover:bg-surface-hi"
            >
              <!-- Name -->
              <td class="px-5 py-4">
                <div class="font-sans text-[13px] font-medium text-text leading-tight">{{ contact.name }}</div>
                <div class="sm:hidden font-mono text-[11px] text-text-3 mt-0.5 truncate max-w-[140px]">{{ contact.email }}</div>
              </td>

              <!-- Email -->
              <td class="px-5 py-4 hidden sm:table-cell">
                <span class="font-mono text-[11px] text-text-2">{{ contact.email }}</span>
              </td>

              <!-- Message preview -->
              <td class="px-5 py-4 hidden lg:table-cell max-w-[260px]">
                <span class="font-sans text-[12px] text-text-3 line-clamp-1">{{ contact.message }}</span>
              </td>

              <!-- Date -->
              <td class="px-5 py-4 hidden md:table-cell whitespace-nowrap">
                <span class="font-mono text-[11px] text-text-3">{{ formatDate(contact.created_at) }}</span>
              </td>

              <!-- Status -->
              <td class="px-5 py-4">
                <span
                  :class="[
                    'inline-flex items-center gap-1.5 px-2 py-1 rounded-full font-mono text-[10px]',
                    contact.read_at
                      ? 'bg-amber/10 text-amber border border-amber/20'
                      : 'bg-coral/10 text-coral border border-coral/20'
                  ]"
                >
                  <span :class="['w-1 h-1 rounded-full', contact.read_at ? 'bg-amber' : 'bg-coral']" />
                  {{ contact.read_at ? 'Read' : 'Unread' }}
                </span>
              </td>

              <!-- Actions -->
              <td class="px-5 py-4">
                <div class="flex items-center justify-end gap-1">
                  <!-- View -->
                  <button
                    @click="openPanel(contact)"
                    class="w-7 h-7 flex items-center justify-center rounded-md text-text-3 hover:text-text hover:bg-bg transition-colors"
                    title="View message"
                  >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </button>

                  <!-- Toggle read -->
                  <button
                    @click="toggleRead(contact)"
                    :class="[
                      'w-7 h-7 flex items-center justify-center rounded-md transition-colors',
                      contact.read_at
                        ? 'text-text-3 hover:text-amber hover:bg-amber/10'
                        : 'text-text-3 hover:text-lime hover:bg-lime/10'
                    ]"
                    :title="contact.read_at ? 'Mark as unread' : 'Mark as read'"
                  >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                  </button>

                  <!-- Delete -->
                  <button
                    @click="confirmDelete(contact)"
                    class="w-7 h-7 flex items-center justify-center rounded-md text-text-3 hover:text-coral hover:bg-coral/10 transition-colors"
                    title="Delete message"
                  >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div
        v-if="contacts.last_page > 1"
        class="border-t border-border px-5 py-3.5 flex items-center justify-between gap-4"
      >
        <span class="font-mono text-[11px] text-text-3">
          {{ contacts.from }}–{{ contacts.to }} of {{ contacts.total }}
        </span>
        <div class="flex items-center gap-1">
          <Link
            v-for="link in contacts.links"
            :key="link.label"
            :href="link.url ?? '#'"
            :class="[
              'px-3 py-1.5 rounded-md font-mono text-[11px] transition-colors',
              !link.url ? 'text-text-3 pointer-events-none' :
              link.active
                ? 'bg-amber text-[#1a0f08] font-semibold'
                : 'text-text-2 hover:bg-surface-hi hover:text-text'
            ]"
            preserve-scroll
            v-html="link.label"
          />
        </div>
      </div>
    </div>
  </div>

  <!-- ── View slide-over panel ── -->
  <Transition
    enter-active-class="transition-opacity duration-200"
    enter-from-class="opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="transition-opacity duration-200"
    leave-from-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <div v-if="panelContact" class="fixed inset-0 bg-black/50 z-50" @click="closePanel" />
  </Transition>

  <Transition
    enter-active-class="transition-transform duration-300 ease-out"
    enter-from-class="translate-x-full"
    enter-to-class="translate-x-0"
    leave-active-class="transition-transform duration-250 ease-in"
    leave-from-class="translate-x-0"
    leave-to-class="translate-x-full"
  >
    <div
      v-if="panelContact"
      class="fixed top-0 right-0 bottom-0 z-50 w-full max-w-[480px] bg-surface border-l border-border flex flex-col shadow-2xl"
    >
      <!-- Panel header -->
      <div class="flex items-center justify-between px-6 py-4 border-b border-border shrink-0">
        <div>
          <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3">Message</p>
          <h2 class="font-display font-bold text-[18px] tracking-tight text-text mt-0.5">{{ panelContact.name }}</h2>
        </div>
        <button @click="closePanel" class="w-8 h-8 flex items-center justify-center rounded-lg text-text-3 hover:text-text hover:bg-surface-hi transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Panel body -->
      <div class="flex-1 overflow-y-auto px-6 py-5 space-y-5">

        <!-- Contact info -->
        <div class="grid grid-cols-1 gap-3">
          <div class="flex items-start gap-3 p-3.5 rounded-lg bg-bg border border-border">
            <svg class="w-3.5 h-3.5 text-text-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <div>
              <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-text-3 mb-0.5">Email</p>
              <p class="font-mono text-[12px] text-text">{{ panelContact.email }}</p>
            </div>
          </div>
          <div v-if="panelContact.phone" class="flex items-start gap-3 p-3.5 rounded-lg bg-bg border border-border">
            <svg class="w-3.5 h-3.5 text-text-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <div>
              <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-text-3 mb-0.5">Phone</p>
              <p class="font-mono text-[12px] text-text">{{ panelContact.phone }}</p>
            </div>
          </div>
          <div class="flex items-start gap-3 p-3.5 rounded-lg bg-bg border border-border">
            <svg class="w-3.5 h-3.5 text-text-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <div>
              <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-text-3 mb-0.5">Received</p>
              <p class="font-mono text-[12px] text-text">{{ formatDate(panelContact.created_at) }}</p>
            </div>
          </div>
        </div>

        <!-- Message body -->
        <div>
          <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-text-3 mb-2">Message</p>
          <div class="p-4 rounded-lg bg-bg border border-border">
            <p class="font-sans text-[14px] text-text-2 leading-relaxed whitespace-pre-wrap">{{ panelContact.message }}</p>
          </div>
        </div>

      </div>

      <!-- Panel footer actions -->
      <div class="border-t border-border px-6 py-4 flex items-center gap-2.5 shrink-0">
        <button
          @click="toggleRead(panelContact)"
          :class="[
            'flex-1 flex items-center justify-center gap-2 px-4 py-2.5 rounded-full border font-mono text-[11px] transition-all',
            panelContact.read_at
              ? 'border-border text-text-2 hover:border-border-hi hover:text-text'
              : 'border-amber/30 bg-amber/10 text-amber hover:bg-amber/15'
          ]"
        >
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
          </svg>
          {{ panelContact.read_at ? 'Mark as unread' : 'Mark as read' }}
        </button>

        <button
          @click="confirmDelete(panelContact)"
          class="flex items-center justify-center gap-2 px-4 py-2.5 rounded-full border border-coral/30 bg-coral/10 text-coral font-mono text-[11px] hover:bg-coral/15 transition-all"
        >
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          Delete
        </button>
      </div>
    </div>
  </Transition>

  <!-- ── Delete confirmation modal ── -->
  <Transition
    enter-active-class="transition-all duration-200"
    enter-from-class="opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="transition-all duration-150"
    leave-from-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <div v-if="deleteTarget" class="fixed inset-0 bg-black/60 z-[60] flex items-center justify-center px-4">
      <div
        class="bg-surface border border-border rounded-2xl p-6 w-full max-w-[360px] shadow-2xl"
        @click.stop
      >
        <div class="w-9 h-9 rounded-full bg-coral/10 border border-coral/20 flex items-center justify-center mb-4">
          <svg class="w-4 h-4 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </div>
        <h3 class="font-display font-bold text-[18px] text-text tracking-tight mb-1.5">Delete message?</h3>
        <p class="font-sans text-[13px] text-text-2 leading-relaxed mb-5">
          Message from <span class="text-text font-medium">{{ deleteTarget.name }}</span> will be permanently removed.
        </p>
        <div class="flex gap-2.5">
          <button
            @click="deleteTarget = null"
            class="flex-1 px-4 py-2.5 rounded-full border border-border font-mono text-[11px] text-text-2 hover:text-text hover:border-border-hi transition-colors"
          >
            Cancel
          </button>
          <button
            @click="executeDelete"
            :disabled="deleting"
            class="flex-1 px-4 py-2.5 rounded-full bg-coral text-white font-mono text-[11px] font-semibold hover:opacity-90 disabled:opacity-60 transition-opacity"
          >
            {{ deleting ? 'Deleting…' : 'Delete' }}
          </button>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

const props = defineProps({
  contacts: Object,
  filters:  Object,
  stats:    Object,
});

// ── State ──────────────────────────────────────────────────────────────────
const search       = ref(props.filters?.search ?? '');
const activeStatus = ref(props.filters?.status ?? '');
const panelContact = ref(null);
const deleteTarget = ref(null);
const deleting     = ref(false);

const statusTabs = [
  { label: 'All',    value: '' },
  { label: 'Unread', value: 'unread' },
  { label: 'Read',   value: 'read' },
];

// ── Search (debounced) ─────────────────────────────────────────────────────
let searchTimer = null;
watch(search, (val) => {
  clearTimeout(searchTimer);
  searchTimer = setTimeout(() => {
    router.get('/admin/contacts', { search: val, status: activeStatus.value }, {
      preserveState: true,
      preserveScroll: true,
      replace: true,
    });
  }, 350);
});

// ── Status filter ──────────────────────────────────────────────────────────
function setStatus(value) {
  activeStatus.value = value;
  router.get('/admin/contacts', { search: search.value, status: value }, {
    preserveState: true,
    preserveScroll: true,
    replace: true,
  });
}

// ── Panel ──────────────────────────────────────────────────────────────────
function openPanel(contact) {
  panelContact.value = contact;
  if (!contact.read_at) toggleRead(contact);
}
function closePanel() {
  panelContact.value = null;
}

// ── Toggle read ────────────────────────────────────────────────────────────
function toggleRead(contact) {
  router.patch(`/admin/contacts/${contact.id}/toggle-read`, {}, {
    preserveScroll: true,
    onSuccess: () => {
      // reflect change in open panel
      if (panelContact.value?.id === contact.id) {
        panelContact.value = {
          ...panelContact.value,
          read_at: panelContact.value.read_at ? null : new Date().toISOString(),
        };
      }
    },
  });
}

// ── Delete ─────────────────────────────────────────────────────────────────
function confirmDelete(contact) {
  deleteTarget.value = contact;
}
function executeDelete() {
  deleting.value = true;
  router.delete(`/admin/contacts/${deleteTarget.value.id}`, {
    preserveScroll: true,
    onSuccess: () => {
      deleting.value = false;
      deleteTarget.value = null;
      closePanel();
    },
    onError: () => { deleting.value = false; },
  });
}

// ── Helpers ────────────────────────────────────────────────────────────────
function formatDate(iso) {
  return new Date(iso).toLocaleDateString('en-IN', {
    day: '2-digit', month: 'short', year: 'numeric',
  });
}
</script>
