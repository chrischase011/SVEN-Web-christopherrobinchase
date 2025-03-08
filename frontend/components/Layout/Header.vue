<script setup lang="ts">
const isMenuOpen = ref(false);

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};
</script>

<template>
  <nav class="absolute top-0 left-0 flex items-center justify-between flex-wrap p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
      
      <NuxtLink to="/" class="flex items-center gap-4 text-xl font-light tracking-widest uppercase">
        <NuxtImg src="/images/logo.png" class="p-1 bg-white rounded-full w-16 h-16" />
        Pawtastic
      </NuxtLink>
    </div>

  </nav>
</template>

<style lang="scss" scoped>
ul {
  transition: all 0.3s ease-in-out;
}
</style>
