<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

defineProps({ products: Array });

const showToast = ref(false);

// 🔥 mapping gambar sesuai nama produk (FIX NO RANDOM NGACO)
const getImage = (p) => {
    const name = p.name.toLowerCase();

    if (name.includes("espresso"))
        return "https://images.unsplash.com/photo-1511920170033-f8396924c348?w=400";
    if (name.includes("latte"))
        return "https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400";
    if (name.includes("cappuccino"))
        return "https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=400";
    if (name.includes("americano"))
        return "https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=400";
    if (name.includes("mocha"))
        return "https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=400";
    if (name.includes("v60"))
        return "https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=400";
    if (name.includes("cold brew"))
        return "https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400";
    if (name.includes("macchiato"))
        return "https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400";
    if (name.includes("affogato"))
        return "https://images.unsplash.com/photo-1470337458703-46ad1756a187?w=400";
    if (name.includes("flat white"))
        return "https://images.unsplash.com/photo-1498804103079-a6351b050096?w=400";
    if (name.includes("ristretto"))
        return "https://images.unsplash.com/photo-1511920170033-f8396924c348?w=400";
    if (name.includes("lungo"))
        return "https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=400";
    if (name.includes("piccolo"))
        return "https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400";
    if (name.includes("cortado"))
        return "https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=400";
    if (name.includes("irish"))
        return "https://images.unsplash.com/photo-1470337458703-46ad1756a187?w=400";
    if (name.includes("vietnam"))
        return "https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400";
    if (name.includes("japanese"))
        return "https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=400";
    if (name.includes("tubruk"))
        return "https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=400";
    if (name.includes("gula aren"))
        return "https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=400";
    if (name.includes("tonic"))
        return "https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=400";

    // fallback tetap random tapi aman
    return `https://picsum.photos/400/300?random=${p.id}`;
};

const addToCart = (id) => {
    router.post(
        `/cart/add/${id}`,
        {},
        {
            onSuccess: () => {
                showToast.value = true;
                setTimeout(() => (showToast.value = false), 2000);
            },
        },
    );
};
</script>

<template>
    <div class="min-h-screen bg-[#0f172a] text-white relative overflow-hidden">
        <!-- ✅ TOAST -->
        <div
            v-if="showToast"
            class="fixed top-5 right-5 bg-yellow-500 text-black px-4 py-2 rounded shadow-lg z-50"
        >
            Berhasil ditambahkan ke keranjang
        </div>

        <!-- BACKGROUND -->
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-10 left-10 text-6xl">☕</div>
            <div class="absolute top-40 right-20 text-5xl">☕</div>
            <div class="absolute bottom-20 left-32 text-7xl">☕</div>
            <div class="absolute bottom-40 right-10 text-6xl">☕</div>
        </div>

        <!-- NAVBAR -->
        <div
            class="relative flex justify-between items-center px-8 py-4 border-b border-yellow-500/20"
        >
            <a href="/products" class="text-xl font-bold text-yellow-400">
                BrewHub ☕
            </a>

            <div class="flex gap-4 items-center">
                <a href="/history" class="text-yellow-400 hover:underline">
                    Riwayat
                </a>
                <a href="/cart" class="text-2xl hover:scale-110 transition">
                    🛒
                </a>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="relative p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-yellow-400">
                Coffee Menu
            </h1>

            <div class="grid md:grid-cols-3 gap-6">
                <div
                    v-for="p in products"
                    :key="p.id"
                    class="bg-[#1e293b] rounded-2xl overflow-hidden shadow-lg transform hover:scale-105 hover:shadow-yellow-500/20 transition duration-300 group"
                >
                    <!-- IMAGE -->
                    <div class="h-44 overflow-hidden relative">
                        <img
                            :src="getImage(p)"
                            @error="
                                (e) =>
                                    (e.target.src = `https://picsum.photos/400/300?random=${p.id}`)
                            "
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                        />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"
                        ></div>
                    </div>

                    <!-- CONTENT -->
                    <div class="p-5">
                        <h2 class="text-yellow-300 font-bold text-lg">
                            {{ p.name }}
                        </h2>

                        <p class="text-sm mt-2 text-gray-300 line-clamp-3">
                            {{ p.description }}
                        </p>

                        <p class="mt-2 text-yellow-400 font-bold">
                            Rp {{ p.price }}
                        </p>

                        <a
                            :href="`/products/${p.id}`"
                            class="block text-blue-400 mt-2 hover:underline"
                        >
                            Detail
                        </a>

                        <button
                            @click="addToCart(p.id)"
                            class="mt-3 w-full bg-yellow-500 text-black py-2 rounded hover:bg-yellow-400 transition"
                        >
                            Add to Cart 🛒
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
