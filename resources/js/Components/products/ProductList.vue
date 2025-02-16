<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    cartProducts: {
        type: Array,
    },
    products: {
        type: Array,
    },
})
</script>

<template>
    <div class="flex flex-wrap">
        <div class="w-1/3 p-3" v-for="(product) in products" :key="product.id + '_product'">
            <div class="rounded-md">
                <a href="#"><img src="https://dummyimage.com/700x400/babde8/1320d1.jpg&text=Demo+Product+700+x+400" alt=""></a>
                <div class="mt-3">
                    <a href="#" class="text-2xl text-indigo-500 hover:underline">{{ product.name }}</a>
                </div>
                <h5 class="mt-3">$ {{ product.price }}</h5>
                <p class="mt-3">{{ product.description }}</p>

                <div class="mt-4 border-t pt-6 flex justify-end">
                    <Link
                        :href="'/products/cart/add-or-remove/' + product.id"
                        method="post"
                        as="button"
                        type="button"
                        v-if="!cartProducts.includes(product.id)"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        href="#">
                        Add to Cart
                    </Link>
                    <Link
                        :href="'/products/cart/add-or-remove/' + product.id"
                        method="post"
                        as="button"
                        type="button"
                        v-if="cartProducts.includes(product.id)"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                        href="#">
                        Remove from Cart
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
