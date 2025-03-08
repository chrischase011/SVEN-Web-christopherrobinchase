<script setup lang="ts"></script>

<template>
  <div 
    class="w-full h-auto"
    :style="{
      background: 'linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url(\'/images/banner2.jpg\') no-repeat center center / cover'
    }"
  >
    <div class="w-full h-full bg-gray-900 bg-opacity-50">
      <div class="grid grid-cols-1 md:grid-cols-2 h-full px-6 md:px-20">
        <div class="hidden md:block separator"></div>
        <div class="flex flex-col h-full space-y-10 md:space-y-[70px] py-10 pt-32 md:py-22 px-6 pb-32 xl:ps-[160px] xl:pe-[150px] justify-center items-center text-center md:text-left">
          <HeroNav data-aos="fade-right" />
          <HeroDescription />
        </div>
      </div>
    </div>
  </div>


</template>

<style scoped></style>
