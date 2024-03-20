<script setup>
import DarkMode from '@/Button/DarkMode.vue';
import { onMounted, ref } from "vue";
import { watch } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  inLogin: Boolean,
  inRegister: Boolean,
});

const Hambarg = ref(false);

onMounted(() => {
  //ページ遷移時スクロール無効化解除
  document.body.style.overflow = '';
});

//ハンバーガーメニュー起動時スクロール無効化
watch(Hambarg, (newValue) => {
  if (newValue) {
    document.body.style.overflow = 'hidden';
  } else {
    document.body.style.overflow = '';
  }
});
</script>

<template>
  <div>
    <div class="bg-orange-600 absolute h-13 md:h-18 z-10 w-full grid grid-cols-3">
      <div class="grid justify-start items-center">
        <DarkMode/>
      </div>
      <div class="grid justify-center items-center">
        <Link class="" :href="route('noodlenav')">
          <img class="size-10" src="../img/ramen.png" alt="">
        </Link>
      </div>
    </div>
    <div v-if="inLogin">
      <div class="openbtn fixed top-0.5 right-0 md:right-2 z-50 cursor-pointer w-10 md:w-12 h-12" 
      @click="Hambarg = !Hambarg" 
      :class="{'btnActive':Hambarg}">
        <span class="inline-block absolute left-3 h-1 w-2/4 rounded-sm bg-orange-600 duration-500 top-2 md:top-4"></span>
        <span class="inline-block absolute left-3 h-1 w-2/4 rounded-sm bg-orange-600 duration-500 top-4 md:top-6"></span>
        <span class="inline-block absolute left-3 h-1 w-2/4 rounded-sm bg-orange-600 duration-500 top-6 md:top-8"></span>
      </div>
      <div id="g-nav" v-show="Hambarg" class="fixed z-30 right-12 top-12"><!--v-bindが効いていないので修正必要-->
        <ul class="opacity-0 fixed top-6 md:top-12 right-4 md:right-7" :class="{'opacity-100':Hambarg}">
          <div v-if="$page.props.auth.user">
            <li class="cursor-pointer text-white hover:text-slate-300 duration-500 pb-2 font-black text-lg animate-gnaviAnime animate-duration-1000 animate-delay-200 animate-fill-forwards opacity-0">
              <Link class="block w-24 text-base md:text-xl" :href="route('profile.edit')">プロフィール</Link>
            </li>
            <li class="cursor-pointer text-white hover:text-slate-300 duration-500 pb-2 font-black text-lg animate-gnaviAnime animate-duration-1000 animate-delay-200 animate-fill-forwards opacity-0">
              <Link class="block w-24 text-base md:text-xl" :href="a">お気に入り</Link>
            </li>
          </div>
          <li v-else class="cursor-pointer text-white hover:text-slate-300 duration-500 pb-2 font-black text-lg animate-gnaviAnime animate-duration-1000 animate-delay-200 animate-fill-forwards opacity-0">
            <Link class="block w-24 text-base md:text-xl" :href="route('login')">ログイン</Link>
          </li>
        </ul>
      </div>
      <div class="circle-bg scale-150 bg-orange-400 fixed size-20 md:size-24 rounded-full z-25 -right-12 -top-12 duration-700"
      :class="{'scale-450':Hambarg}"></div>
      <div id="z-black" @click="Hambarg = !Hambarg" class="fixed w-full invisible duration-700" 
      :class="{'bgaction':Hambarg}"></div>
    </div>
  </div>
</template>

<style>
/* メニュー背景 */
#z-black.bgaction{
  height: 100%;
  visibility: visible;
  background: rgba(0,0,0,0.4);
  z-index: 20;
}

/*ボタンCSS*/
.openbtn.btnActive span:nth-of-type(1) {
    top: 10px;
    left: 18px;
    transform: translateY(6px) rotate(-45deg);
    width: 30%;
}

.openbtn.btnActive span:nth-of-type(2) {
	opacity: 0;
}

.openbtn.btnActive span:nth-of-type(3){
    top: 22px;
    left: 18px;
    transform: translateY(-6px) rotate(45deg);
    width: 30%;
}

@media (min-width: 768px) {
  .openbtn.btnActive span:nth-of-type(1) {
    top: 18px;
    left: 18px;
    transform: translateY(6px) rotate(-45deg);
    width: 30%;
  }

  .openbtn.btnActive span:nth-of-type(3){
    top: 30px;
    left: 18px;
    transform: translateY(-6px) rotate(45deg);
    width: 30%;
  }
}
</style>