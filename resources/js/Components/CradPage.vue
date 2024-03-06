<script setup>
import { ramenStore } from '@/stores/ramenStore';
import StarRating from '@/Components/StarRating.vue';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import { nextTick, watch } from 'vue';

//ラーメン屋検索処理後にSwiper実施
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

    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
      <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
        <div v-for="shop in ramenStore.ramenShops" :key="shop.place_id">
          <div class="rounded overflow-hidden shadow-lg">
            <a href="#"></a>
            <div class="relative">
              <!-- スライドショー -->
              <div v-if="shop.photos && shop.photos.length > 0" class="swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide" v-for="(photo, index) in shop.photos" :key="index">
                    <img class="object-cover w-full h-60" :src="photo.getUrl({maxWidth: 400})" alt="店舗の写真">
                  </div>
                </div>
                <div class="swiper-scrollbar"></div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
              <!-- お気に入り登録 -->
              <a href="!#">
                <div
                  class="text-sm absolute top-0 right-0 bg-indigo-600 px-4 text-white rounded-full h-16 w-16 z-10
                  flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                  <span class="font-bold">27</span>
                  <small>March</small>
                </div>
              </a>
            </div>
            <!-- 店名・住所 -->
            <div class="px-6 py-4">
              <a href="#"
              class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">
                BestView in Newyork City
              </a>
              <p class="text-gray-500 text-sm">
                The city that never sleeps
              </p>
            </div>
            <!-- 五つ星評価 -->
            <div class="relative left-6">
              <StarRating :rating="shop.rating" />
            </div>
            <!-- 営業日時 -->
            <div class="px-6 py-4 flex flex-row justify-between">
              <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                style="enable-background:new 0 0 512 512;" xml:space="preserve">
                  <g>
                    <g>
                      <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
                      c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
                      c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z"></path>
                    </g>
                  </g>
                </svg>
                <span class="ml-1">6 mins ago</span>
              </span>
              <!-- 口コミ -->
              <a href="#!">
                <div class="bg-indigo-600 px-4 py-2 text-white text-sm
                hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                    Photos
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>