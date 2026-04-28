<script setup>
defineProps({ products: Array });

import { router } from "@inertiajs/vue3";
const addToCart = (id) => router.post(`/cart/add/${id}`);
</script>

<template>
    <div class="min-h-screen bg-[#0f172a] text-white">
        <!-- NAVBAR -->
        <div
            class="flex justify-between items-center px-8 py-4 border-b border-yellow-500/20"
        >
            <a href="/products" class="text-xl font-bold text-yellow-400">
                BrewHub ☕
            </a>

            <div class="flex gap-4 items-center">
                <a href="/history" class="text-yellow-400 hover:underline">
                    Riwayat
                </a>
                <a href="/cart" class="text-2xl"> 🛒 </a>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-yellow-400">
                Coffee Menu
            </h1>

            <div class="grid md:grid-cols-3 gap-6">
                <div
                    v-for="p in products"
                    :key="p.id"
                    class="bg-[#1e293b] p-5 rounded-xl"
                >
                    <h2 class="text-yellow-300 font-bold">{{ p.name }}</h2>

                    <p class="text-sm mt-2 text-gray-300 line-clamp-3">
                        {{ p.description }}
                    </p>

                    <p class="mt-2 text-yellow-400 font-bold">
                        Rp {{ p.price }}
                    </p>

                    <a
                        :href="`/products/${p.id}`"
                        class="block text-blue-400 mt-2"
                    >
                        Detail
                    </a>

                    <button
                        @click="addToCart(p.id)"
                        class="mt-3 w-full bg-yellow-500 text-black py-2 rounded"
                    >
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
