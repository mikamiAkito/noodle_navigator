<template>
  <div>
    <div ref="map" style="height: 400px;">
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      map: null,
    };
  },
  mounted() {
    // Google Maps API を読み込む
    const script = document.createElement('script');
    script.defer = true;
    script.async = true;
    window.initMap = this.initMap;
    document.head.appendChild(script);
  },
  methods: {
    initMap() {
      // 地図の初期化
      this.map = new window.google.maps.Map(this.$refs.map, {
        center: { lat: 35.6895, lng: 139.6917 }, // 初期表示の中心座標
        zoom: 15, // ズームレベル
      });

      // 現在地を取得してマーカーを設置する例
      navigator.geolocation.getCurrentPosition((position) => {
        const { latitude, longitude } = position.coords;
        const myLocation = new window.google.maps.LatLng(latitude, longitude);

        new window.google.maps.Marker({
          position: myLocation,
          map: this.map,
          title: 'My Location',
        });

        // 地図を現在地に移動
        this.map.setCenter(myLocation);
      });
    },
  },
};
</script>

<style scoped>
/* 必要に応じてスタイルを追加 */
</style>