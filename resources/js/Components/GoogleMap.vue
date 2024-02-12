<script setup>
import { onMounted } from 'vue';
let infoWindow;

// Google Maps API の読み込みを非同期で行う
const loadGoogleMapsAPI = () => {
  return new Promise((resolve, reject) => {
    const script = document.createElement('script');
    script.src = import.meta.env.VITE_GOOGLE_MAPS_API_KEY;
    script.onload = resolve;
    script.onerror = reject;
    document.head.appendChild(script);
  });
};

onMounted(async () => {
  try {
    // Google Maps API をロード
    await loadGoogleMapsAPI();

    // マップの初期設定
    const map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: -33.8688, lng: 151.2195 },
      zoom: 15,
      mapTypeId: "roadmap",
      mapTypeControl: false,
      streetViewControl: false,
    });

    //現在地取得準備
    infoWindow = new google.maps.InfoWindow();

    // マーカーを管理する配列
    let markers = [];

    //現在地取得
    const getCurrentlocation = () => {
      markers.forEach(marker => marker.setMap(null));
      markers = [];

      if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent("Location found.");
            infoWindow.open(map);
            map.setCenter(pos);
          },
          () => {
          handleLocationError(true, infoWindow, map.getCenter());
          }
        );
      }else{
        handleLocationError(false, infoWindow, map.getCenter());
      }
    }

    // 検索ボックスをマップに追加
    const input = document.getElementById("pac-input");
    const searchBox = new google.maps.places.SearchBox(input);
    //現在地ボタンをマップへ追加
    const kennsaku = document.getElementById("s-btn");
    map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(input);
    map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(kennsaku);

    //ロード時現在地へ移動
    getCurrentlocation();

    //ボタンクリック時現在地へ移動
    kennsaku.addEventListener("click", () => {
      getCurrentlocation();
    });

    // マップの範囲が変更されたときに検索ボックスの範囲を更新
    map.addListener("bounds_changed", () => {
      searchBox.setBounds(map.getBounds());
    });

    // 検索ボックスの検索結果が変更されたときにマーカーを更新
    searchBox.addListener("places_changed", () => {
      const places = searchBox.getPlaces();

      if (places.length === 0) {
        return;
      }

      // 古いマーカーをクリア
      markers.forEach(marker => marker.setMap(null));
      markers = [];

      // 新しい検索結果に基づいてマーカーを追加
      const bounds = new google.maps.LatLngBounds();
      places.forEach(place => {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }

        markers.push(new google.maps.Marker({
          map,
          title: place.name,
          position: place.geometry.location,
        }));

        if (place.geometry.viewport) {
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });

      // マップを検索結果の範囲にフィット
      map.fitBounds(bounds);
    });

  } catch (error) {
    console.error('Failed to load Google Maps API:', error);
  }
});
</script>

<template>
  <div class="border-solid border-2 border-blue-700 flex justify-center">
    <div id="map" class=""></div>
    <input id="pac-input" type="text" placeholder="Enter a location">
    <div id="s-btn" class="border-solid border-2 border-red-600">
      <button>検索</button>
    </div>
  </div>
</template>

<style scoped>
#map {
  height: 600px; /* マップの高さを指定 */
  width: 90%; /* マップの幅を指定 */
}
</style>