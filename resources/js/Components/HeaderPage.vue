<script setup>
import { ref } from "vue";

const Hambarg = ref(false);

</script>

<template>
  <div>
    <div class="bg-orange-600 absolute z-10 w-full">
      aaaaaaaaaaa
    </div>
    <div class="openbtn fixed top-0.5 right-0 md:right-2 z-50 cursor-pointer w-10 md:w-12 h-12" 
    @click="Hambarg = !Hambarg" 
    :class="{'active':Hambarg}">
      <span class="inline-block absolute left-3 h-1 w-2/4 rounded-sm bg-orange-600 duration-500 top-2 md:top-4"></span>
      <span class="inline-block absolute left-3 h-1 w-2/4 rounded-sm bg-orange-600 duration-500 top-4 md:top-6"></span>
      <span class="inline-block absolute left-3 h-1 w-2/4 rounded-sm bg-orange-600 duration-500 top-6 md:top-8"></span>
    </div>
    <div id="g-nav" v-show="Hambarg" :class="{'panelactive':Hambarg}">
      <ul class="opacity-0">
        <li class="cursor-pointer text-white hover:text-slate-300 duration-500 pb-2 font-black text-lg"><a :href="a">プロフィール</a></li>
        <li class="cursor-pointer text-white hover:text-slate-300 duration-500 pb-2 font-black text-lg"><a :href="a">お気に入り</a></li>
        <li class="cursor-pointer text-white hover:text-slate-300 duration-500 pb-2 font-black text-lg"><a :href="a">投稿一覧</a></li>
      </ul>
    </div>
    <div class="circle-bg bg-orange-400 fixed size-20 sm:size-24 rounded-full z-20 -right-12 -top-12 duration-700"
    :class="{'circleactive':Hambarg}">
    </div>
    <div id="z-black" @click="Hambarg = !Hambarg" class="fixed w-full invisible duration-700" :class="{'bgaction':Hambarg}"></div>
  </div>
</template>

<style scoped>
#g-nav.panelactive{
  position:fixed;
  z-index: 30;
  right: 3rem;
  top: 3rem;
}

.circle-bg{
	transform: scale(1.5);
}

.circle-bg.circleactive{
	transform: scale(4.5);
}

#g-nav.panelactive #g-nav-list{
  display: block;
}

/*ナビゲーション*/
#g-nav.panelactive ul {
    opacity:1;
}

#g-nav.panelactive ul li{
animation-name:gnaviAnime;
animation-duration:1s;
animation-delay:.2s;
animation-fill-mode:forwards;
opacity:0;
}
@keyframes gnaviAnime{
0% {
opacity: 0;
}
100% {
opacity: 1;
}
}

/* メニュー背景 */
#z-black.bgaction{
  height: 100%;
  visibility: visible;
  background: rgba(0,0,0,0.4);
  z-index: 10;
}

/*ボタンCSS*/
.openbtn.active span:nth-of-type(1) {
    top: 10px;
    left: 18px;
    transform: translateY(6px) rotate(-45deg);
    width: 30%;
}

.openbtn.active span:nth-of-type(2) {
	opacity: 0;
}

.openbtn.active span:nth-of-type(3){
    top: 22px;
    left: 18px;
    transform: translateY(-6px) rotate(45deg);
    width: 30%;
}

@media (min-width: 768px) {
  .openbtn.active span:nth-of-type(1) {
    top: 18px;
    left: 18px;
    transform: translateY(6px) rotate(-45deg);
    width: 30%;
  }

  .openbtn.active span:nth-of-type(3){
    top: 30px;
    left: 18px;
    transform: translateY(-6px) rotate(45deg);
    width: 30%;
  }
}
</style>