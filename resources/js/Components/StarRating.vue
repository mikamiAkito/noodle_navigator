<script setup>
const props = defineProps({
  rating: {
    type: Number,
    required: true
  }
});

const filledStar = '&#9733;'; // 実星アイコン
const emptyStar = '&#9734;'; // 空星アイコン
const stars = [1, 2, 3, 4, 5]; // 星の数
</script>

<template>
  <div class="star-rating">
    <span v-for="star in stars" :key="star" class="star" v-html="star <= Math.round(rating) ? filledStar : emptyStar"></span>
  </div>
</template>


<style scoped>
.star-rating .star {
  color: gold;
  margin-right: 4px;
}
</style>
