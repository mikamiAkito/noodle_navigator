<script setup>
import { onMounted, ref } from 'vue';

const isDarkMode = ref(false);

//スタイル変更処理
const toggleDarkMode = () => {
    //ライトモードへ変更
    if(isDarkMode.value){
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light';
        isDarkMode.value = !isDarkMode.value;
    }else{
    //ダークモードへ変更
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark';
        isDarkMode.value = !isDarkMode.value;
    }
}

//マウント時ダークモードボタンのスタイル反映
onMounted(() => {
    const saveTheme = localStorage.theme;
    if(saveTheme === 'dark'){
        document.documentElement.classList.add('dark');
        isDarkMode.value = true;
    }else{
        document.documentElement.classList.remove('dark');
        isDarkMode.value = false;
    }
});
</script>

<template>
<div class="">
    <div class="z-60">
        <label for="toggleB" class="flex items-center cursor-pointer">
            <div class="relative">
            <input type="checkbox" id="toggleB" class="sr-only" @click="toggleDarkMode">
            <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
            <div class="absolute left-1 top-1 w-6 h-6 rounded-full transition"
            :class="{
                'bg-white':!isDarkMode,
                'translate-x-full':isDarkMode,
                'bg-indigo-500':isDarkMode
            }"
            ></div>
            </div>
        </label>
    </div>
</div>
</template>

<style scoped>

</style>