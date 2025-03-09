import { defineStore } from "pinia"
import type { DataResponse } from "~/types/DataResponse";

export const useCSRFStore = defineStore('csrf', {
    state: () => ({
        csrf: ''
    }),
    actions: {
        setCSRF(csrf: string) {
            this.csrf = csrf;
        },
        async generateCSRF() {
            try {
                const config = useRuntimeConfig()
                const apiURL = config.public.apiURL;
                const secretKey = config.public.secretKey;

                const { data, error } = await useFetch<DataResponse>(`${apiURL}/sanctum/csrf-cookie`, {
                    method: 'GET',
                    headers: {
                        'X-Frontend-Secret': secretKey
                    },
                    credentials: 'include'
                });

                if (error.value) {
                    console.error("CSRF generation failed:", error.value);
                    return;
                }

                if (data.value?.csrf) {
                    this.setCSRF(data.value.csrf);
                }
            } catch (err) {
                console.error("An error occurred:", err);
            }
        }
    }
})