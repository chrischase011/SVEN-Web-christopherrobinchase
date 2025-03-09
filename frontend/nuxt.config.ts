// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  runtimeConfig: {
    public: {
      secretKey: process.env.SECRET_KEY,
      apiURL: process.env.API_URL || 'http://localhost:8000'
    }
  },
  modules: [
    '@nuxtjs/tailwindcss',
    '@nuxt/image',
    'nuxt-aos',
    '@pinia/nuxt',
    '@vee-validate/nuxt',
  ],
  components: [
    { path: '~/components', pathPrefix: false }
  ],
  css: [
    '~/assets/scss/main.scss'
  ],
  tailwindcss: {
    config: {
      theme: {
        extend: {
          colors: { 
            primary: '#535973',
            secondary: '#f7ebeb',
            tertiary: '#ecd0cd',
          }
        }
      }
    }
  }
})