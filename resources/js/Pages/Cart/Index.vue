<script setup>
defineProps({ cart: Object });

import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const showReceipt = ref(false);

const checkout = () => {
    showReceipt.value = true;
};

const confirmCheckout = () => {
    router.post(
        "/cart/checkout",
        {},
        {
            onSuccess: () => {
                showReceipt.value = false;
                window.location.href = "/history";
            },
            onError: () => {
                alert("Checkout gagal");
            },
        },
    );
};
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
            <h1 class="text-3xl text-yellow-400 mb-6">Keranjang</h1>

            <div v-if="!cart || cart.items.length === 0">Keranjang kosong</div>

            <div v-else>
                <div
                    v-for="item in cart.items"
                    :key="item.id"
                    class="bg-[#1e293b] p-4 rounded mb-3"
                >
                    {{ item.product.name }} - {{ item.qty }}x
                    <br />
                    Rp {{ item.qty * item.price }}
                </div>

                <div class="font-bold text-yellow-400">
                    Total: Rp {{ cart.total }}
                </div>

                <button
                    @click="checkout"
                    class="mt-4 bg-yellow-500 text-black px-4 py-2 rounded"
                >
                    Checkout
                </button>
            </div>
        </div>

        <!-- 🔥 POPUP -->
        <div
            v-if="showReceipt"
            class="fixed inset-0 z-50 flex items-center justify-center"
        >
            <!-- overlay (tidak ganggu klik) -->
            <div class="absolute inset-0 bg-black/70 pointer-events-none"></div>

            <!-- popup box -->
            <div
                class="relative z-50 bg-white text-black p-6 rounded w-96 pointer-events-auto"
            >
                <h2 class="text-xl font-bold mb-4">Struk Pembelian</h2>

                <div v-for="item in cart.items" :key="item.id">
                    {{ item.product.name }} - {{ item.qty }}x
                </div>

                <hr class="my-3" />

                <p class="font-bold">Total: Rp {{ cart.total }}</p>

                <button
                    @click="confirmCheckout"
                    class="mt-4 w-full bg-green-500 px-4 py-2 rounded"
                >
                    OK
                </button>
            </div>
        </div>
    </div>
</template>
