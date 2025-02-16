<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import ProductList from '@/Components/products/ProductList.vue';
import CartCount from "@/Components/cart/CartCount.vue";
import ProductFilters from "@/Components/products/ProductFilters.vue";

defineProps({
    cart: {
        type: Number,
    },
    cartProducts: {
        type: Array
    },
    categories: {
        type: Array
    },
    manufacturers: {
        type: Array
    },
    prices: {
        type: Array
    },
    products: {
        type: Array
    },
    selected: {
        type: Object
    }
})
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-grow justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
                <cart-count :cart="cart" />
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="flex p-6">
                        <div class="w-1/3">
                            <product-filters
                                :categories="categories"
                                :manufacturers="manufacturers"
                                :prices="prices"
                                :selected="selected"
                            />
                        </div>
                        <div class="w-2/3">
                            <product-list
                                :products="products"
                                :categories="categories"
                                :manufacturers="manufacturers"
                                :prices="prices"
                                :cart="cart"
                                :cartProducts="cartProducts"
                                :selected="selected"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
