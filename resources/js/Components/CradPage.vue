<script setup>
import { ramenStore } from '@/stores/ramenStore';
import StarRating from '@/Components/StarRating.vue';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import { nextTick, onMounted, ref, watch } from 'vue';
import axios from 'axios';
import { Link } from '@inertiajs/vue3';

const BookmarkFlg = ref({});

const props = defineProps({
  loginCheck: Boolean
});

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

//お気に入り登録確認
const bookmarkcheck = async () => {
  await axios.post("/bookMark-check")
  .then((response) => {
    let bookdatas = response.data.datas;
    bookdatas.forEach(value => {
      BookmarkFlg.value[value.place_id] = true;
    });
  })
  .catch((error) => {
    alert(error);
  })
}

//お気に入り登録
const saveAsBookmark = async shop => {
  console.log("データフォーム", shop);
  BookmarkFlg.value[shop.place_id] = !BookmarkFlg.value[shop.place_id];
  if(BookmarkFlg.value[shop.place_id]) {
    await axios.post("/bookMark", {
      params: shop,
    })
    .then((response) => {
      console.log("送信完了", response);
    })
    .catch((error) => {
      alert("送信エラー", error);
    })
  } else {
    await axios.post("/bookMark-delete", {
      params: shop,
    })
    .then((response) => {
      console.log("解除完了", response);
    })
    .catch((error) => {
      alert("送信エラー", error);
    })
  }
};

//ログイン時お気に入り投稿確認へ
onMounted(() => {
  //グローバルステイト初期化
  ramenStore.ramenShops = [];
  if(props.loginCheck) {
    bookmarkcheck();
  }
})
</script>

<template>
  <div>

    <div class="w-full mx-auto p-5 sm:p-10 md:p-16 dark:bg-gray-600">
      <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
        <div v-for="shop in ramenStore.ramenShops" :key="shop.place_id" :id="`shop-${shop.place_id}`">
          <div class="rounded overflow-hidden shadow-lg border border-blue-400 dark:border-slate-700">
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
              <div v-show="props.loginCheck">
                <div @click="saveAsBookmark(shop)">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" 
                  class="size-6 text-sm absolute top-0 right-0 px-4 h-16 w-16 z-10 text-indigo-600
                  flex flex-col items-center justify-center mt-3 mr-3 transition duration-500 
                  ease-in-out cursor-pointer"
                  :class="{ 
                    'hover:fill-red-400':!BookmarkFlg[shop.place_id],
                    'fill-white':!BookmarkFlg[shop.place_id],
                    'text-red-500':BookmarkFlg[shop.place_id], 
                    'fill-red-600':BookmarkFlg[shop.place_id], 
                  }">
                    <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                  </svg>
                </div>
              </div>
            </div>
            <!-- 店名・住所 -->
            <div class="px-6 py-4">
              <a href="#"
              class="font-semibold text-lg inline-block hover:text-indigo-600 dark:text-white transition duration-500 ease-in-out">
                {{ shop.name }}
              </a>
              <p class="text-gray-500 dark:text-white opacity-70 text-sm">
                {{ shop.formatted_address }}
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>