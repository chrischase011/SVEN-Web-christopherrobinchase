<script setup lang="ts">


</script>

<template>
 <div class="w-full h-auto bg-gray-100">
    <div class="flex flex-col lg:flex-row w-full h-full">
      <!-- Left Section (Image + Text) -->
      <div
        class="lg:basis-[40%] flex flex-col text-center text-white gap-10 bg-black p-8 lg:p-16"
        :style="{
          background: 'linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(/images/pet6.jpg) no-repeat',
          backgroundSize: 'cover',
          backgroundPosition: 'center'
        }"
      >
        <div class="flex justify-center items-center gap-4 text-lg lg:text-xl font-light uppercase tracking-widest">
          <NuxtImg src="/images/logo.png" class="p-1 bg-secondary rounded-full w-12 h-12 lg:w-16 lg:h-16" />
          Pawtastic
        </div>

        <div>
          <span class="text-3xl lg:text-4xl font-bold">All services include:</span>

          <ul class="list-disc list-inside text-center lg:text-left text-lg lg:text-[22px] font-light mt-5 lg:mt-7 px-8 lg:px-16 space-y-6 lg:space-y-14">
            <li>A photo update for you along</li>
            <li>Notifications of sitter arrival</li>
            <li>Treats for your pets, with your</li>
          </ul>

        </div>
      </div>

      <!-- Right Section (Form) -->
      <ScheduleForm />
    </div>
  </div>

</template>

<style lang="scss" scoped>
</style>
