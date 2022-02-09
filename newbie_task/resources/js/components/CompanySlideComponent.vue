<template>
<div>
    <Slick
      ref="slick"
      :options="slickOptions"
      class="slick-outer"
      style="width: 100%; height: 40vh; background: currentColor;"
    >
      <!-- company 画像1 -->
     
      <div class="slick-cont-img">
        <img v-if="img1" :src="img1" class="slick-img" />
        <img v-else :src="'images/no_img.png'" class="slick-img" />
        
      </div>
      
      <!-- company 画像2 -->
      <div class="slick-cont-img">
        <img v-if="img2" :src="img2" class="slick-img" />
        <img v-else :src="'images/no_img.png'" class="slick-img" />
      </div>
      <!-- company 画像3 -->
      <div class="slick-cont-img">
        <img v-if="img3" :src="img3" class="slick-img" />
        <img v-else :src="'images/no_img.png'" class="slick-img" />
      </div>
    </Slick>
</div>
</template>
<script>
import Slick from 'vue-slick'
export default {
  props: ['img1', 'img2', 'img3'],
  data: function () {
    return {
      slickOptions: {
        arrows: true, //スライドの矢印ボタン
        dots: false, //ドットマーク
        autoplay: false, //自動スライド
        autoplaySpeed: 4000, //自動スライド間隔(ms)
        pauseOnFocus: false, //ドットマークを押すとスライドショーが止まるのを防ぐ
        prevArrow: '<button type="button" class="slick-prev"></button>', //ひとつ前の画像に戻る矢印ボタン
        nextArrow: '<button type="button" class="slick-next"</button>', //ひとつ先の画像に進む矢印ボタン
      },
    }
  },
  components: {
    Slick,
  },
}
</script>
