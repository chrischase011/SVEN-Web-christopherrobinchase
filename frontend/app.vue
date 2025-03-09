<script lang="ts" setup>
useHead({
  title: 'Pawtastic',
  meta: [
    {
      name: 'description',
      content: 'Pawtastic - Your perfect pet\'s grooming partner'
    }
  ]
})


const tokenStore = useTokenStore()
const csrfStore = useCSRFStore()

useAsyncData('generateToken', async () => {
  await tokenStore.generateToken();
  await csrfStore.generateCSRF();
});


</script>

<template>
  <div>
    <NuxtLayout>
      <NuxtPage />
    </NuxtLayout>
  </div>
</template>
