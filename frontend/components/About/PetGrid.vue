<script setup lang="ts"></script>

<template>
  <div data-aos="fade-right" class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4 max-w-lg md:max-w-2xl lg:max-w-4xl mx-auto">
    <div data-aos="fade-down-left" data-aos-delay="600" class="relative w-full h-40 sm:h-60 rounded-lg overflow-hidden">
      <NuxtImg src="/images/pet1.jpeg" alt="Pet 1" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-black opacity-10 filter hue-rotate-275"></div>
    </div>
    <div data-aos="fade-down-right" data-aos-delay="700" class="relative w-full h-40 sm:h-60 rounded-lg overflow-hidden">
      <NuxtImg src="/images/pet2.jpeg" alt="Pet 2" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-black opacity-10 filter hue-rotate-275"></div>
    </div>
    <div data-aos="fade-up-left" data-aos-delay="800" class="relative w-full h-40 sm:h-60 rounded-lg overflow-hidden">
      <NuxtImg src="/images/pet3.jpg" alt="Pet 3" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-black opacity-10 filter hue-rotate-275"></div>
    </div>
    <div data-aos="fade-up-right" data-aos-delay="900" class="relative w-full h-40 sm:h-60 rounded-lg overflow-hidden">
      <NuxtImg src="/images/pet4.jpg" alt="Pet 4" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-black opacity-10 filter hue-rotate-275"></div>
    </div>
  </div>

</template>

<style scoped></style>
