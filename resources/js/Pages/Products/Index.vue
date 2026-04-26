<script setup>
defineProps({
    products: Array,
});
</script>

<template>
    <div class="relative min-h-screen bg-[#0f172a] text-white overflow-hidden">
        <!-- Background Coffee Beans -->
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-10 left-10 text-6xl">☕</div>
            <div class="absolute top-40 right-20 text-5xl">☕</div>
            <div class="absolute bottom-20 left-32 text-7xl">☕</div>
            <div class="absolute bottom-40 right-10 text-6xl">☕</div>
        </div>

        <div class="relative p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-yellow-400">
                ☕ BrewHub Coffee Menu
            </h1>

            <div class="grid md:grid-cols-3 gap-6">
                <div
                    v-for="p in products"
                    :key="p.id"
                    class="bg-[#1e293b] border border-yellow-500/20 rounded-2xl p-5 shadow-lg hover:scale-105 transition"
                >
                    <h2 class="text-xl font-semibold text-yellow-300 mb-1">
                        {{ p.name }}
                    </h2>

                    <span
                        class="text-xs bg-yellow-500 text-black px-2 py-1 rounded"
                    >
                        {{ p.category }}
                    </span>

                    <p class="text-sm text-gray-300 mt-2">
                        {{ p.description }}
                    </p>

                    <p class="text-lg font-bold text-yellow-400 mt-3">
                        Rp {{ p.price }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
