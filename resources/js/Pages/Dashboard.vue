<script setup>
import { ref } from "vue";
import { Head, router, usePage } from "@inertiajs/vue3";

const open = ref(false);
const toggleSidebar = () => (open.value = !open.value);

// ✅ ambil user login
const user = usePage().props.auth.user;

// ✅ logout function
const logout = () => {
    router.post("/logout");
};
</script>

<template>
    <Head title="Dashboard" />

    <div
        class="min-h-screen bg-[#1a1f2e] text-[#fff8e7] relative overflow-hidden"
    >
        <!-- ☕ NAVBAR (AUTH FIX) -->
        <div
            class="flex justify-between items-center px-8 py-4 border-b border-yellow-500/20"
        >
            <a href="/products" class="text-xl font-bold text-yellow-400">
                BrewHub ☕
            </a>

            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-300">
                    {{ user?.name }}
                </span>

                <button
                    @click="logout"
                    class="border border-red-400 px-3 py-1 rounded hover:bg-red-500 hover:text-white transition"
                >
                    Logout
                </button>
            </div>
        </div>

        <!-- ☕ SIDEBAR -->
        <div
            :class="[
                'fixed top-0 left-0 h-full w-[300px] p-6 z-50 transition-all duration-300 shadow-xl',
                open ? 'translate-x-0' : '-translate-x-full',
            ]"
            style="background: linear-gradient(180deg, #28334a, #a67c52)"
        >
            <h1 class="text-2xl font-bold border-b pb-4 border-yellow-400">
                ☕ BrewHub
            </h1>

            <div class="mt-6 space-y-3">
                <a
                    href="/products"
                    class="block bg-white/20 p-3 rounded hover:bg-white/30"
                >
                    → Produk
                </a>
                <a
                    href="/cart"
                    class="block bg-white/20 p-3 rounded hover:bg-white/30"
                >
                    → Keranjang
                </a>
                <a
                    href="/history"
                    class="block bg-white/20 p-3 rounded hover:bg-white/30"
                >
                    → Riwayat
                </a>
            </div>
        </div>

        <!-- OVERLAY -->
        <div
            v-if="open"
            @click="toggleSidebar"
            class="fixed inset-0 bg-black/60 z-40"
        ></div>

        <!-- TOGGLE BUTTON -->
        <button
            @click="toggleSidebar"
            class="fixed top-20 left-6 z-50 w-14 h-14 rounded-full border-2 border-yellow-400 flex flex-col justify-center items-center gap-1"
            style="background: linear-gradient(135deg, #a67c52, #d4a574)"
        >
            <span class="w-6 h-1 bg-black"></span>
            <span class="w-6 h-1 bg-black"></span>
            <span class="w-6 h-1 bg-black"></span>
        </button>

        <!-- ☕ CONTENT -->
        <div
            class="flex flex-col items-center justify-center min-h-[80vh] text-center"
        >
            <h1 class="text-4xl font-bold text-[#d4a574] mb-4">
                Dolce Esperienza del Caffè
            </h1>

            <h2 class="mb-8">BrewHub Caffetteria ☕</h2>

            <div class="flex gap-4 flex-wrap justify-center">
                <a
                    href="/products"
                    class="bg-yellow-500 text-black px-6 py-3 rounded hover:bg-yellow-400 transition"
                >
                    Produk
                </a>

                <a
                    href="/cart"
                    class="border border-yellow-400 px-6 py-3 rounded hover:bg-yellow-400 hover:text-black transition"
                >
                    🛒 Keranjang
                </a>

                <a
                    href="/history"
                    class="border border-yellow-400 px-6 py-3 rounded hover:bg-yellow-400 hover:text-black transition"
                >
                    📜 Riwayat
                </a>
            </div>
        </div>
    </div>
</template>
