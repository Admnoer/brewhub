<script setup>
defineProps({ product: Object });
</script>

<template>
    <div class="min-h-screen bg-[#0f172a] text-white p-8">
        <a href="/products" class="text-yellow-400 font-bold"> BrewHub ☕ </a>

        <div v-if="product">
            <h1 class="text-3xl text-yellow-400 mt-6">
                {{ product.name || "Tidak ada nama" }}
            </h1>

            <p class="mt-3 text-gray-300">
                {{ product.description || "Deskripsi kosong" }}
            </p>

            <p class="mt-3 text-yellow-400 font-bold">
                Rp {{ product.price || 0 }}
            </p>
        </div>

        <div v-else>Produk tidak ditemukan</div>
    </div>
</template>
