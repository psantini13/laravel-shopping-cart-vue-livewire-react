<script setup>
defineProps({
    cart: {
        type: Number,
    }
})
</script>

<template>
    <div class="px-4 py-3 leading-normal text-blue-700 bg-blue-100 rounded-lg text-right w-1/3">
        <i class="fa fa-shopping-cart"></i>
        Cart ({{ cart }})
    </div>
</template>
