<template>
<div>
    <div id="map" style="height: 400px;"></div>
</div>
</template>

<script>
export default {
mounted() {
    this.initMap();
},
methods: {
    initMap() {
    // Google Maps JavaScript APIを使用してマップを初期化
    const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
    });

    // 例: Laravelエンドポイントからデータを取得し、マップ上にマーカーを追加
    fetch('/api/places')
        .then(response => response.json())
        .then(data => {
        data.forEach(place => {
            new google.maps.Marker({
            position: { lat: place.lat, lng: place.lng },
            map: map,
            });
        });
        });
    },
},
};
</script>
