<script setup>
defineProps({ carts: Array });
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

        <div class="p-8">
            <h1 class="text-3xl text-yellow-400 mb-6">Riwayat</h1>

            <div v-if="carts.length === 0">Belum ada transaksi</div>

            <div v-for="cart in carts" :key="cart.id" class="mb-4">
                <div class="font-bold text-yellow-300">
                    Order #{{ cart.id }}
                </div>

                <div v-for="item in cart.items" :key="item.id">
                    {{ item.product.name }} - {{ item.qty }}x
                </div>

                <div class="text-yellow-400">Rp {{ cart.total }}</div>
            </div>
        </div>
    </div>
</template>
