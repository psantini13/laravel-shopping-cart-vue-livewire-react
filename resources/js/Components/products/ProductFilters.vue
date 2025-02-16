<script setup>

import {router} from "@inertiajs/vue3";

defineProps({
    categories: {
        type: Array
    },
    manufacturers: {
        type: Array
    },
    prices: {
        type: Array
    },
    selected: {
        type: Object
    },
})

const filterProducts = (e, type, selected = []) => {
    let  updatedItems = [...(selected[type] || [])];

    if (e.target.checked) {
        updatedItems.push(e.target.value);
    } else {
        updatedItems = updatedItems.filter((item) => item !== e.target.value);
    }

    router.visit(('/dashboard'), {
        data: {
            [`selected[${type}]`]: updatedItems
        },
        preserveScroll: true,
        except: ['cart', 'cartProducts']
    })
}
</script>

<template>
    <div class="col-lg-3 mb-4">
        <form method="get">
            <h1 class="mt-4 text-4xl">Filters</h1>
            <h3 class="mt-2 mb-1 text-3xl">Price</h3>

            <div v-for="(price, index) in prices" :key="price.id">
                <input type="checkbox"
                       :id="'price_' + index"
                       :value="index"
                       name="selected[prices]"
                       :checked="selected?.prices?.includes(index.toString())"
                       @change="(e) => filterProducts(e, 'prices', selected)"
                >
                <label :for="'price_' + index" class="ml-1">
                    {{ price.name }} ({{ price.products_count }})
                </label>
            </div>

            <h3 class="mt-3 mb-1 text-3xl">Categories</h3>
            <div v-for="(category, index) in categories" :key="category.id">
                <input type="checkbox"
                       :id="'category_' + index"
                       :value="category.id"
                       name="selected[categories]"
                       :checked="selected?.categories?.includes(category.id.toString())"
                       @change="(e) => filterProducts(e, 'categories', selected)"
                >
                <label :for="'price_' + index" class="ml-1">
                    {{ category.name }} ({{ category.products_count }})
                </label>
            </div>

            <h3 class="mt-3 mb-1 text-3xl">Manufacturers</h3>
            <div v-for="(manufacturer, index) in manufacturers" :key="manufacturer.id">
                <input type="checkbox"
                       :id="'category_' + index"
                       :value="manufacturer.id"
                       name="selected[manufacturers]"
                       :checked="selected?.manufacturers?.includes(manufacturer.id.toString())"
                       @change="(e) => filterProducts(e, 'manufacturers', selected)"
                >
                <label :for="'price_' + index" class="ml-1">
                    {{ manufacturer.name }} ({{ manufacturer.products_count }})
                </label>
            </div>
        </form>
    </div>
</template>
