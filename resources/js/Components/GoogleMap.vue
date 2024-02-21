<script setup>
let map;
let infoWindow;

//現在地取得処理
const getCurrentlocation = () => {
  if (navigator.geolocation) {
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
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

async function initMap() {
  //初期処理
  const position = { lat: -25.344, lng: 131.031 };
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerView } = await google.maps.importLibrary("marker");
  // const { SearchBox } = await google.maps.importLibrary("places");
  //マップ読み込み
  map = new Map(document.getElementById("map"), {
    zoom: 15,
    center: position,
    mapId: "DEMO_MAP_ID",
    mapTypeControl: false,
    streetViewControl: false,
    fullscreenControl: false,
  });
  infoWindow = new google.maps.InfoWindow();
  //ボタン追加
  const locationButton = document.getElementById("current-btn");
  const searchButton = document.getElementById("search-btn");
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(locationButton);
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(searchButton);
  //ロード時現在地へ
  getCurrentlocation();
  //クリック時現在地へ
  locationButton.addEventListener("click", () => {
    getCurrentlocation();
  });

  //マーカー設置
  const marker = new AdvancedMarkerView({
    map: map,
    position: position,
    title: "Uluru",
  });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}

window.initMap = initMap;

initMap();
</script>

<template>
  <div>
    <div id="map" class=""></div>
    <div class="">
      <button id="search-btn" class="bg-white transition duration-700 hover:bg-blue-400 shadow-md w-10 h-10 rounded-sm m-2.5">
        <svg viewBox="0 0 51 53" xmlns="http://www.w3.org/2000/svg" class="fill-blue-500 w-full h-2/3">
          <path d="M49.3595 13.3609H46.9523V6.8985C46.9523 5.18457 46.1952 3.54083 44.8476 2.32889C43.5 1.11695 41.6723 0.436096 39.7665 0.436096L11.0233 0.436096C9.11753 0.436096 7.2898 1.11695 5.9422 2.32889C4.5946 3.54083 3.83753 5.18457 3.83753 6.8985V13.3609H1.39436C1.08943 13.3609 0.796992 13.4698 0.581376 13.6638C0.36576 13.8577 0.244629 14.1207 0.244629 14.3949V22.0205C0.244629 22.5925 0.758413 23.0545 1.39436 23.0545H3.83753V42.4417C3.83753 44.2189 3.83753 45.6729 7.43042 45.6729V50.5197C7.43042 50.9482 7.61969 51.3592 7.95659 51.6621C8.29349 51.9651 8.75043 52.1353 9.22687 52.1353H16.4127C16.8891 52.1353 17.3461 51.9651 17.683 51.6621C18.0198 51.3592 18.2091 50.9482 18.2091 50.5197V45.6729H32.5807V50.5197C32.5807 50.9482 32.77 51.3592 33.1069 51.6621C33.4438 51.9651 33.9007 52.1353 34.3772 52.1353H41.563C42.0394 52.1353 42.4963 51.9651 42.8332 51.6621C43.1701 51.3592 43.3594 50.9482 43.3594 50.5197V45.6729C46.9523 45.6729 46.9523 44.2189 46.9523 42.4417V23.0545H49.3595C49.674 23.0545 49.9756 22.9422 50.1979 22.7422C50.4203 22.5422 50.5452 22.271 50.5452 21.9882C50.5452 21.7054 50.4203 21.4342 50.1979 21.2342C49.9756 21.0343 49.674 20.9219 49.3595 20.9219C49.0451 20.9219 48.7435 21.0343 48.5212 21.2342C48.2988 21.4342 48.1739 21.7054 48.1739 21.9882C48.1739 22.271 48.2988 22.5422 48.5212 22.7422C48.7435 22.9422 49.0451 23.0545 49.3595 23.0545C49.674 23.0545 49.9756 22.9422 50.1979 22.7422C50.4203 22.5422 50.5452 22.271 50.5452 21.9882V14.4272C50.5452 14.1444 50.4203 13.8732 50.1979 13.6732C49.9756 13.4732 49.674 13.3609 49.3595 13.3609ZM18.2091 3.6673H32.5807V6.8985H18.2091V3.6673ZM11.0233 39.2105C10.0704 39.2105 9.15656 38.8701 8.48276 38.2641C7.80896 37.6582 7.43042 36.8363 7.43042 35.9793C7.43042 35.1224 7.80896 34.3005 8.48276 33.6945C9.15656 33.0886 10.0704 32.7481 11.0233 32.7481C11.9762 32.7481 12.8901 33.0886 13.5639 33.6945C14.2377 34.3005 14.6162 35.1224 14.6162 35.9793C14.6162 36.8363 14.2377 37.6582 13.5639 38.2641C12.8901 38.8701 11.9762 39.2105 11.0233 39.2105ZM7.43042 26.2857V10.1297H43.3594V26.2857H7.43042ZM39.7665 39.2105C38.8136 39.2105 37.8997 38.8701 37.2259 38.2641C36.5521 37.6582 36.1736 36.8363 36.1736 35.9793C36.1736 35.1224 36.5521 34.3005 37.2259 33.6945C37.8997 33.0886 38.8136 32.7481 39.7665 32.7481C40.7194 32.7481 41.6333 33.0886 42.3071 33.6945C42.9809 34.3005 43.3594 35.1224 43.3594 35.9793C43.3594 36.8363 42.9809 37.6582 42.3071 38.2641C41.6333 38.8701 40.7194 39.2105 39.7665 39.2105Z"/>
        </svg>
      </button>
    </div>
    <button id="current-btn" class="bg-white transition duration-700 hover:bg-red-400 shadow-md w-10 h-10 rounded-sm m-2.5">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="fill-red-500 w-full h-2/3">
        <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
      </svg>
    </button>
  </div>
</template>

<style scoped>
#map {
  height: 600px; /* マップの高さを指定 */
  width: 100%; /* マップの幅を指定 */
}
</style>