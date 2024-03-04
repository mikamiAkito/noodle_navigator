<script setup>
import { ramenStore } from '@/stores/ramenStore';
import StarRating from '@/Components/StarRating.vue';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import { onMounted } from 'vue';

onMounted(() => {
  const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });
})
</script>

<template>
  <div>

    <div class="swiper w-full h-80">
      <div class="swiper-wrapper">
        <div class="swiper-slide">Slide 1</div>
        <div class="swiper-slide">Slide 2</div>
        <div class="swiper-slide">Slide 3</div>
        ...
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-scrollbar"></div>
    </div>

    <div class="max-w-sm w-full lg:max-w-full lg:flex place-content-center"
    v-for="shop in ramenStore.ramenShops" :key="shop.place_id"
    >
      <div v-if="shop.photos && shop.photos.length > 0" class="swiper-slide h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" title="店舗の写真">
        <img v-for="(photo, index) in shop.photos" :key="index" :src="photo.getUrl({maxWidth: 100})" alt="店舗の写真">
      </div>
      <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
        <div class="mb-8">
          <div>{{ shop.vicinity }}</div>
          <div>{{ shop.formatted_phone_number }}</div>
          <StarRating :rating="shop.rating" />
          <div class="text-gray-900 font-bold text-xl mb-2">{{ shop.name }}</div>
          <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>
        </div>
        <div class="flex items-center">
          <img class="w-10 h-10 rounded-full mr-4" src="../img/u1.png" alt="Avatar of Jonathan Reinink">
          <div class="text-sm">
            <p class="text-gray-900 leading-none">Jonathan Reinink</p>
            <p class="text-gray-600">Aug 18</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>