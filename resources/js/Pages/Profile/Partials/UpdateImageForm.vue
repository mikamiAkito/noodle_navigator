<script setup>
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';

defineProps({
  profilePhotoUrl: String,
  coverPhotoUrl: String,
});

onMounted(() => {
    const profileimage = document.getElementById("profileimage");
    const profilebutton = document.getElementById("profilebutton");

    profilebutton.addEventListener('click', () => {
        if(profileimage){
            profileimage.click();
        }
    });
});

const profileUpdate = () => {
//プロフィール画像編集処理
  console.log('かわったよーーーー');
  form.patch(route('profile.image'));
};

const form = useForm({
  profileimage: String,
  coverImage: String,
});
</script>

<template>
<div>
  <form @change.prevent="profileUpdate">
    <!-- Cover Image -->
    <img :src="coverPhotoUrl" alt="User Cover"
    class="w-full xl:h-[20rem] lg:h-[18rem] md:h-[16rem] sm:h-[14rem] xs:h-[11rem]" />
    <!-- Profile Image -->
    <div class="sm:w-[80%] xs:w-[90%] mx-auto flex relative">
      <img :src="profilePhotoUrl" alt="User Profile"
        class="rounded-md lg:w-[12rem] lg:h-[12rem] md:w-[10rem] md:h-[10rem] sm:w-[8rem] sm:h-[8rem] xs:w-[7rem] xs:h-[7rem] outline outline-2 outline-offset-2 outline-blue-500 relative lg:bottom-[5rem] sm:bottom-[4rem] xs:bottom-[3rem]" />
      <button class="absolute top-6 w-28 sm:w-32 md:top-14 md:w-40 lg:top-[4.5rem] lg:w-48 cursor-pointer"
        id="profilebutton" type="button">ファイルを選択</button>
      <input id="profileimage" type="file" class="hidden">
      <!-- FullName -->
      <h1 class="w-full text-left my-4 sm:mx-4 xs:pl-4 text-gray-800 dark:text-white lg:text-4xl md:text-3xl sm:text-3xl xs:text-xl font-serif">
          {{ $page.props.auth.user.name }}
      </h1>
    </div>
  </form>
</div>
</template>