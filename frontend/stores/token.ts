import { defineStore } from "pinia"
import type { DataResponse } from "~/types/DataResponse";

export const useTokenStore = defineStore('token', {
    state: () => ({
        token: ''
    }),
    actions: {
        setToken(token: string) {
            this.token = token;
        },
        async generateToken() {
            try {
                const config = useRuntimeConfig()
                const apiURL = config.public.apiURL
                const secretKey = config.public.secretKey

                const { data, error } = await useFetch<DataResponse>(`${apiURL}/api/generate-token`, {
                    method: 'POST',
                    headers: {
                        'X-Frontend-Secret': secretKey
                    }
                });

                if (error.value) {
                    console.error("Token generation failed:", error.value);
                    return;
                }

                if (data.value?.token) {
                    this.setToken(data.value.token);
                }
            } catch (err) {
                console.error("An error occurred:", err);
            }
        }
    }
});