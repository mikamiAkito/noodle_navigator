<script setup>
import HeaderPage from '@/Components/HeaderPage.vue';
import FooterPage from '@/Components/FooterPage.vue';
import { onMounted } from 'vue';

const props = defineProps({
  bookMarkItems: Array
});

onMounted(() => {
  console.log(props.bookMarkItems);
});
</script>

<template>
  <div>
    <HeaderPage/>
    <FooterPage/>
  </div>
</template>

<style>
</style>