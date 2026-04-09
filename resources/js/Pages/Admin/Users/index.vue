<template>
  <Head>
    <title>Users — Admin</title>
    <meta name="robots" content="noindex, nofollow" />
  </Head>

  <div class="max-w-[960px] mx-auto px-4 sm:px-8 py-10 sm:py-14">

    <!-- Flash success -->
    <Transition
      enter-active-class="transition-all duration-300"
      enter-from-class="opacity-0 -translate-y-2"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition-all duration-200"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="flash"
        class="flex items-center gap-2.5 px-4 py-3 rounded-xl border border-lime/25 bg-lime/10 mb-6"
      >
        <svg class="w-3.5 h-3.5 text-lime shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="font-mono text-[12px] text-lime">{{ flash }}</span>
      </div>
    </Transition>

    <!-- Page header -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 16 }"
      :enter="{ opacity: 1, y: 0, transition: { duration: 450 } }"
      class="flex items-start justify-between gap-4 mb-8"
    >
      <div>
        <p class="font-mono text-[10px] uppercase tracking-[0.16em] text-text-3 mb-1.5">Admin · Users</p>
        <h1 class="font-display font-bold text-[28px] sm:text-[36px] tracking-[-0.025em] text-text leading-none">
          Admin Users
        </h1>
        <p class="font-sans text-[13px] text-text-3 mt-2">Manage who has access to this panel.</p>
      </div>
      <button
        @click="showAddPanel = true"
        class="shrink-0 inline-flex items-center gap-2 px-4 py-2.5 rounded-full bg-amber text-[#1a0f08] font-mono text-[11px] font-semibold uppercase tracking-[0.1em] hover:bg-amber-soft transition-colors mt-1"
      >
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
        </svg>
        Add Admin
      </button>
    </div>

    <!-- Stats -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 12 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 60, duration: 400 } }"
      class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-6"
    >
      <div class="bg-surface border border-border rounded-xl px-5 py-4">
        <div class="font-mono text-[9px] uppercase tracking-[0.14em] text-text-3 mb-1.5">Total Admins</div>
        <div class="font-display font-bold text-[32px] tracking-tight text-text leading-none">{{ admins.length }}</div>
      </div>
      <div class="bg-surface border border-border rounded-xl px-5 py-4">
        <div class="font-mono text-[9px] uppercase tracking-[0.14em] text-text-3 mb-1.5">Your Account</div>
        <div class="font-mono text-[13px] text-amber font-semibold truncate">{{ authAdmin?.name ?? '—' }}</div>
        <div class="font-mono text-[10px] text-text-3 truncate mt-0.5">{{ authAdmin?.email ?? '' }}</div>
      </div>
      <div class="hidden sm:block bg-surface border border-border rounded-xl px-5 py-4">
        <div class="font-mono text-[9px] uppercase tracking-[0.14em] text-text-3 mb-1.5">Access Level</div>
        <div class="flex items-center gap-2 mt-1">
          <span class="w-1.5 h-1.5 rounded-full bg-lime shadow-[0_0_8px_#c8ff4d]" />
          <span class="font-mono text-[12px] text-lime">Full admin</span>
        </div>
      </div>
    </div>

    <!-- Admins list -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 12 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 120, duration: 450 } }"
      class="bg-surface border border-border rounded-xl overflow-hidden"
    >
      <div class="px-5 py-3.5 border-b border-border flex items-center justify-between">
        <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3">{{ admins.length }} {{ admins.length === 1 ? 'admin' : 'admins' }}</span>
      </div>

      <ul class="divide-y divide-border">
        <li
          v-for="admin in admins"
          :key="admin.id"
          class="flex items-center gap-4 px-5 py-4 group hover:bg-surface-hi transition-colors"
        >
          <!-- Avatar -->
          <div class="w-9 h-9 rounded-full bg-amber/10 border border-amber/25 flex items-center justify-center shrink-0">
            <span class="font-mono text-[13px] font-bold text-amber">{{ admin.name.charAt(0).toUpperCase() }}</span>
          </div>

          <!-- Info -->
          <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 flex-wrap">
              <span class="font-sans text-[14px] font-semibold text-text">{{ admin.name }}</span>
              <span
                v-if="admin.id === currentAdminId"
                class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber/10 border border-amber/20 font-mono text-[9px] text-amber"
              >
                <span class="w-1 h-1 rounded-full bg-amber" />
                You
              </span>
            </div>
            <div class="flex items-center gap-3 mt-0.5 flex-wrap">
              <span class="font-mono text-[11px] text-text-2">{{ admin.email }}</span>
              <span class="text-border-hi font-mono text-[10px] hidden sm:inline">·</span>
              <span class="font-mono text-[10px] text-text-3 hidden sm:inline">Joined {{ formatDate(admin.created_at) }}</span>
            </div>
          </div>

          <!-- Actions -->
          <div class="flex items-center gap-1 shrink-0">
            <!-- Edit details -->
            <button
              @click="openEdit(admin)"
              class="w-8 h-8 flex items-center justify-center rounded-lg text-text-3 hover:text-text hover:bg-bg transition-colors"
              title="Edit details"
            >
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
            </button>

            <!-- Change password -->
            <button
              @click="openPassword(admin)"
              class="w-8 h-8 flex items-center justify-center rounded-lg text-text-3 hover:text-sky hover:bg-sky/10 transition-colors"
              title="Change password"
            >
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
              </svg>
            </button>

            <!-- Delete -->
            <button
              @click="admin.id !== currentAdminId && openDelete(admin)"
              :class="[
                'w-8 h-8 flex items-center justify-center rounded-lg transition-colors',
                admin.id === currentAdminId
                  ? 'text-text-3/30 cursor-not-allowed'
                  : 'text-text-3 hover:text-coral hover:bg-coral/10'
              ]"
              :title="admin.id === currentAdminId ? 'Cannot delete your own account' : 'Delete admin'"
            >
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </button>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <!-- ── Add Admin slide-over ── -->
  <Transition
    enter-active-class="transition-opacity duration-200"
    enter-from-class="opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="transition-opacity duration-200"
    leave-from-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <div v-if="showAddPanel" class="fixed inset-0 bg-black/50 z-50" @click="closeAdd" />
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
      v-if="showAddPanel"
      class="fixed top-0 right-0 bottom-0 z-50 w-full max-w-[440px] bg-surface border-l border-border flex flex-col shadow-2xl"
    >
      <div class="flex items-center justify-between px-6 py-4 border-b border-border shrink-0">
        <div>
          <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3">New Admin</p>
          <h2 class="font-display font-bold text-[18px] tracking-tight text-text mt-0.5">Add Admin</h2>
        </div>
        <button @click="closeAdd" class="w-8 h-8 flex items-center justify-center rounded-lg text-text-3 hover:text-text hover:bg-surface-hi transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <form @submit.prevent="submitAdd" class="flex-1 overflow-y-auto px-6 py-6 space-y-4">
        <!-- Name -->
        <div class="space-y-1.5">
          <label class="block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">Full Name</label>
          <input
            v-model="addForm.name"
            type="text"
            placeholder="Ajay Upadhyay"
            :class="inputClass(addForm.errors.name)"
          />
          <p v-if="addForm.errors.name" class="font-mono text-[10px] text-coral">{{ addForm.errors.name }}</p>
        </div>

        <!-- Email -->
        <div class="space-y-1.5">
          <label class="block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">Email Address</label>
          <input
            v-model="addForm.email"
            type="email"
            placeholder="admin@example.com"
            :class="inputClass(addForm.errors.email)"
          />
          <p v-if="addForm.errors.email" class="font-mono text-[10px] text-coral">{{ addForm.errors.email }}</p>
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
          <label class="block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">Password</label>
          <div class="relative">
            <input
              v-model="addForm.password"
              :type="showAddPassword ? 'text' : 'password'"
              placeholder="Min. 8 characters"
              :class="inputClass(addForm.errors.password) + ' pr-10'"
            />
            <button type="button" @click="showAddPassword = !showAddPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-text-3 hover:text-text-2 transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path v-if="!showAddPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
              </svg>
            </button>
          </div>
          <p v-if="addForm.errors.password" class="font-mono text-[10px] text-coral">{{ addForm.errors.password }}</p>
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1.5">
          <label class="block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">Confirm Password</label>
          <input
            v-model="addForm.password_confirmation"
            :type="showAddPassword ? 'text' : 'password'"
            placeholder="Repeat password"
            :class="inputClass(null)"
          />
        </div>
      </form>

      <div class="border-t border-border px-6 py-4 flex gap-2.5 shrink-0">
        <button
          type="button"
          @click="closeAdd"
          class="flex-1 px-4 py-2.5 rounded-full border border-border font-mono text-[11px] text-text-2 hover:text-text hover:border-border-hi transition-colors"
        >
          Cancel
        </button>
        <button
          @click="submitAdd"
          :disabled="addForm.processing"
          class="flex-1 px-4 py-2.5 rounded-full bg-amber text-[#1a0f08] font-mono text-[11px] font-semibold hover:bg-amber-soft disabled:opacity-60 transition-colors"
        >
          {{ addForm.processing ? 'Creating…' : 'Create Admin' }}
        </button>
      </div>
    </div>
  </Transition>

  <!-- ── Edit Details modal ── -->
  <Transition
    enter-active-class="transition-all duration-200"
    enter-from-class="opacity-0 scale-95"
    enter-to-class="opacity-100 scale-100"
    leave-active-class="transition-all duration-150"
    leave-from-class="opacity-100 scale-100"
    leave-to-class="opacity-0 scale-95"
  >
    <div v-if="editTarget" class="fixed inset-0 bg-black/60 z-[60] flex items-center justify-center px-4" @click.self="editTarget = null">
      <div class="bg-surface border border-border rounded-2xl w-full max-w-[400px] shadow-2xl overflow-hidden">
        <div class="px-6 pt-6 pb-4 border-b border-border flex items-start justify-between gap-4">
          <div>
            <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3">Edit</p>
            <h3 class="font-display font-bold text-[20px] tracking-tight text-text mt-0.5">Update Details</h3>
          </div>
          <button @click="editTarget = null" class="w-7 h-7 flex items-center justify-center rounded-lg text-text-3 hover:text-text hover:bg-surface-hi transition-colors shrink-0 mt-0.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <form @submit.prevent="submitEdit" class="px-6 py-5 space-y-4">
          <div class="space-y-1.5">
            <label class="block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">Full Name</label>
            <input v-model="editForm.name" type="text" :class="inputClass(editForm.errors.name)" />
            <p v-if="editForm.errors.name" class="font-mono text-[10px] text-coral">{{ editForm.errors.name }}</p>
          </div>
          <div class="space-y-1.5">
            <label class="block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">Email Address</label>
            <input v-model="editForm.email" type="email" :class="inputClass(editForm.errors.email)" />
            <p v-if="editForm.errors.email" class="font-mono text-[10px] text-coral">{{ editForm.errors.email }}</p>
          </div>
        </form>

        <div class="px-6 pb-5 flex gap-2.5">
          <button
            type="button"
            @click="editTarget = null"
            class="flex-1 px-4 py-2.5 rounded-full border border-border font-mono text-[11px] text-text-2 hover:text-text hover:border-border-hi transition-colors"
          >
            Cancel
          </button>
          <button
            @click="submitEdit"
            :disabled="editForm.processing"
            class="flex-1 px-4 py-2.5 rounded-full bg-amber text-[#1a0f08] font-mono text-[11px] font-semibold hover:bg-amber-soft disabled:opacity-60 transition-colors"
          >
            {{ editForm.processing ? 'Saving…' : 'Save Changes' }}
          </button>
        </div>
      </div>
    </div>
  </Transition>

  <!-- ── Change Password modal ── -->
  <Transition
    enter-active-class="transition-all duration-200"
    enter-from-class="opacity-0 scale-95"
    enter-to-class="opacity-100 scale-100"
    leave-active-class="transition-all duration-150"
    leave-from-class="opacity-100 scale-100"
    leave-to-class="opacity-0 scale-95"
  >
    <div v-if="passwordTarget" class="fixed inset-0 bg-black/60 z-[60] flex items-center justify-center px-4" @click.self="closePassword">
      <div class="bg-surface border border-border rounded-2xl w-full max-w-[400px] shadow-2xl overflow-hidden">
        <div class="px-6 pt-6 pb-4 border-b border-border flex items-start justify-between gap-4">
          <div>
            <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3">Security</p>
            <h3 class="font-display font-bold text-[20px] tracking-tight text-text mt-0.5">Change Password</h3>
            <p class="font-mono text-[11px] text-text-3 mt-1">For <span class="text-text-2">{{ passwordTarget.name }}</span></p>
          </div>
          <button @click="closePassword" class="w-7 h-7 flex items-center justify-center rounded-lg text-text-3 hover:text-text hover:bg-surface-hi transition-colors shrink-0 mt-0.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <form @submit.prevent="submitPassword" class="px-6 py-5 space-y-4">
          <div class="space-y-1.5">
            <label class="block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">New Password</label>
            <div class="relative">
              <input
                v-model="passwordForm.password"
                :type="showNewPassword ? 'text' : 'password'"
                placeholder="Min. 8 characters"
                :class="inputClass(passwordForm.errors.password) + ' pr-10'"
              />
              <button type="button" @click="showNewPassword = !showNewPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-text-3 hover:text-text-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path v-if="!showNewPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                </svg>
              </button>
            </div>
            <p v-if="passwordForm.errors.password" class="font-mono text-[10px] text-coral">{{ passwordForm.errors.password }}</p>
          </div>
          <div class="space-y-1.5">
            <label class="block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">Confirm New Password</label>
            <input
              v-model="passwordForm.password_confirmation"
              :type="showNewPassword ? 'text' : 'password'"
              placeholder="Repeat new password"
              :class="inputClass(null)"
            />
          </div>
        </form>

        <div class="px-6 pb-5 flex gap-2.5">
          <button
            type="button"
            @click="closePassword"
            class="flex-1 px-4 py-2.5 rounded-full border border-border font-mono text-[11px] text-text-2 hover:text-text hover:border-border-hi transition-colors"
          >
            Cancel
          </button>
          <button
            @click="submitPassword"
            :disabled="passwordForm.processing"
            class="flex-1 px-4 py-2.5 rounded-full bg-sky/20 border border-sky/30 text-sky font-mono text-[11px] font-semibold hover:bg-sky/25 disabled:opacity-60 transition-colors"
          >
            {{ passwordForm.processing ? 'Updating…' : 'Update Password' }}
          </button>
        </div>
      </div>
    </div>
  </Transition>

  <!-- ── Delete confirmation modal ── -->
  <Transition
    enter-active-class="transition-all duration-200"
    enter-from-class="opacity-0 scale-95"
    enter-to-class="opacity-100 scale-100"
    leave-active-class="transition-all duration-150"
    leave-from-class="opacity-100 scale-100"
    leave-to-class="opacity-0 scale-95"
  >
    <div v-if="deleteTarget" class="fixed inset-0 bg-black/60 z-[60] flex items-center justify-center px-4" @click.self="deleteTarget = null">
      <div class="bg-surface border border-border rounded-2xl w-full max-w-[360px] shadow-2xl p-6">
        <div class="w-9 h-9 rounded-full bg-coral/10 border border-coral/20 flex items-center justify-center mb-4">
          <svg class="w-4 h-4 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </div>
        <h3 class="font-display font-bold text-[18px] text-text tracking-tight mb-1.5">Delete admin?</h3>
        <p class="font-sans text-[13px] text-text-2 leading-relaxed mb-5">
          <span class="text-text font-medium">{{ deleteTarget.name }}</span>'s account will be permanently removed and they will lose all access.
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
import { ref, computed, watch } from 'vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

const props = defineProps({
  admins:         Array,
  currentAdminId: Number,
});

const page        = usePage();
const authAdmin   = computed(() => page.props.authAdmin);

// Flash message (auto-dismiss after 3s)
const flash = ref(page.props.flash?.success ?? null);
watch(() => page.props.flash?.success, (val) => {
  if (val) {
    flash.value = val;
    setTimeout(() => { flash.value = null; }, 3000);
  }
}, { immediate: true });

// ── State ──────────────────────────────────────────────────────────────────
const showAddPanel    = ref(false);
const showAddPassword = ref(false);
const showNewPassword = ref(false);
const editTarget      = ref(null);
const passwordTarget  = ref(null);
const deleteTarget    = ref(null);
const deleting        = ref(false);

// ── Forms ──────────────────────────────────────────────────────────────────
const addForm = useForm({
  name: '', email: '', password: '', password_confirmation: '',
});

const editForm = useForm({
  name: '', email: '',
});

const passwordForm = useForm({
  password: '', password_confirmation: '',
});

// ── Helpers ────────────────────────────────────────────────────────────────
function inputClass(hasError) {
  return [
    'w-full bg-bg border rounded-lg px-4 py-3 font-mono text-[12px] text-text placeholder-text-3 outline-none transition-all',
    hasError
      ? 'border-coral/50 ring-1 ring-coral/20'
      : 'border-border focus:border-amber/40 focus:ring-1 focus:ring-amber/15',
  ].join(' ');
}

function formatDate(iso) {
  return new Date(iso).toLocaleDateString('en-IN', {
    day: '2-digit', month: 'short', year: 'numeric',
  });
}

// ── Add ────────────────────────────────────────────────────────────────────
function closeAdd() {
  showAddPanel.value = false;
  addForm.reset();
  addForm.clearErrors();
}

function submitAdd() {
  addForm.post('/admin/users', {
    onSuccess: () => { closeAdd(); },
  });
}

// ── Edit ───────────────────────────────────────────────────────────────────
function openEdit(admin) {
  editForm.name  = admin.name;
  editForm.email = admin.email;
  editTarget.value = admin;
}

function submitEdit() {
  editForm.put(`/admin/users/${editTarget.value.id}`, {
    onSuccess: () => { editTarget.value = null; },
  });
}

// ── Password ───────────────────────────────────────────────────────────────
function openPassword(admin) {
  passwordForm.reset();
  passwordTarget.value = admin;
}

function closePassword() {
  passwordTarget.value = null;
  passwordForm.reset();
  showNewPassword.value = false;
}

function submitPassword() {
  passwordForm.patch(`/admin/users/${passwordTarget.value.id}/password`, {
    onSuccess: () => { closePassword(); },
  });
}

// ── Delete ─────────────────────────────────────────────────────────────────
function openDelete(admin) {
  deleteTarget.value = admin;
}

function executeDelete() {
  deleting.value = true;
  router.delete(`/admin/users/${deleteTarget.value.id}`, {
    onSuccess: () => {
      deleting.value = false;
      deleteTarget.value = null;
    },
    onError: () => { deleting.value = false; },
  });
}
</script>
