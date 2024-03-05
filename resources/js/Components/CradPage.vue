<script setup>
import { ramenStore } from '@/stores/ramenStore';
import StarRating from '@/Components/StarRating.vue';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import { nextTick, watch } from 'vue';

watch(() => ramenStore.ramenShops, (newVal, oldVal) => {
  if(newVal && newVal.length > 0){
    nextTick().then(() => {
      const swiper = new Swiper('.swiper', {
        direction: 'horizontal',
        loop: true,
        pagination: {
          el: '.swiper-pagination',
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        scrollbar: {
          el: '.swiper-scrollbar',
        },
      });
    });
  }
}, { immediate: true, deep: true });
</script>

<template>
  <div>
    <div class="lg:w-5/6 lg:flex lg:h-80"
    v-for="shop in ramenStore.ramenShops" :key="shop.place_id"
    >

      <div v-if="shop.photos && shop.photos.length > 0" class="swiper w-3/4">
        <div class="swiper-wrapper">
          <div class="swiper-slide object-contain" v-for="(photo, index) in shop.photos" :key="index">
            <img :src="photo.getUrl({maxWidth: 400})" alt="店舗の写真">
          </div>
        </div>
        <div class="swiper-scrollbar"></div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
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