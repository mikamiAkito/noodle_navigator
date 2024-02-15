<script setup>
import GoogleMap from '@/Components/GoogleMap.vue';
import HeaderPage from '@/Components/HeaderPage.vue';
import CradPage from '@/Components/CradPage.vue';

</script>

<template>
  <div>
    <HeaderPage></HeaderPage>
    <GoogleMap></GoogleMap>
    <CradPage></CradPage>
    
    <!-- <button @click="openModal" class="bg-blue-700">開く</button>
    <Modal :show="modalshow" @close="closeModal">
      <p>This is the modal content.</p>
      <button @click="closeModal" class="bg-red-700">閉じる</button>
    </Modal> -->
  </div>
</template>