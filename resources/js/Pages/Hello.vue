<template>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center">
        <div
            v-motion
            :initial="{ opacity: 0, y: -40 }"
            :enter="{ opacity: 1, y: 0, transition: { duration: 800 } }"
            class="text-center"
        >
            <h1
                v-motion
                :initial="{ scale: 0.8, opacity: 0 }"
                :enter="{ scale: 1, opacity: 1, transition: { delay: 300, duration: 600 } }"
                class="text-6xl font-bold text-indigo-600 mb-4"
            >
                Hello, World!
            </h1>

            <p
                v-motion
                :initial="{ opacity: 0 }"
                :enter="{ opacity: 1, transition: { delay: 700, duration: 600 } }"
                class="text-xl text-gray-500 mb-8"
            >
                Laravel &bull; Vue &bull; Inertia.js &bull; Tailwind CSS &bull; Framer Motion
            </p>

            <button
                v-motion
                :initial="{ opacity: 0, y: 20 }"
                :enter="{ opacity: 1, y: 0, transition: { delay: 1000, duration: 500 } }"
                :hovered="{ scale: 1.05 }"
                :tapped="{ scale: 0.95 }"
                class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-semibold shadow-lg hover:bg-indigo-700 transition-colors cursor-pointer"
            >
                Get Started
            </button>
        </div>
    </div>
</template>

<script setup>
</script>
