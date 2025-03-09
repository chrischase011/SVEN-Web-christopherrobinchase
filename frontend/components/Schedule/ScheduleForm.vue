<script setup lang="ts">
  import { Field, Form, ErrorMessage } from 'vee-validate'
  import Swal from 'sweetalert2'
  import moment from 'moment'


  const config = useRuntimeConfig()
  const apiURL = config.public.apiURL
  const secretKey = config.public.secretKey

  const tokenStore = useTokenStore()
  const { token } = storeToRefs(tokenStore)

  const minDate = computed(() => {
    return moment().format('YYYY-MM-DD')
  })

  const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  const times = ["Morning", "Afternoon", "Evening"];

  const frequency = ref('Recurring')
  const selectedDays = ref<string[]>([]);
  const selectedTime = ref<string[]>([]);
  const notes = ref('');


  const toggleDay = (day: string) => {
    if (frequency.value === "One Time") {
      // One-time mode: Only allow one selection
      selectedDays.value = [day];
    } else {
      // Recurring mode: Allow multiple selections
      if (selectedDays.value.includes(day)) {
        selectedDays.value = selectedDays.value.filter(d => d !== day);
      } else {
        selectedDays.value.push(day);
      }
    }
  };

  const toggleTime = (time: string) => {
    if(selectedTime.value.includes(time)) {
      selectedTime.value = selectedTime.value.filter(t => t !== time);
    } else {
      selectedTime.value.push(time);
    }
  };

  watch(frequency, () => {
    if (frequency.value === "One Time") {
      selectedDays.value = [];
    }
  });

  const validateStartDate = (value: any) => {
    if (!value) {
      return 'This field is required'
    }

    return true
  }

  const validateDays = (value: any) => {
    if (selectedDays.value.length === 0) {
      return 'Please select at least one day'
    }

    return true
  }

  const validateTimes = (value: any) => {
    if (selectedTime.value.length === 0) {
      return 'Please select at least one time'
    }

    return true
  }

  const clearFields = () => {
    selectedDays.value = [];
    selectedTime.value = [];
    notes.value = '';
  }

  const csrfToken = useCookie('XSRF-TOKEN').value;

  const onSubmit = async (values: any) => {
    try {
    const { data, error } = await useFetch(`${apiURL}/api/book-schedule`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token.value}`,
        'X-Frontend-Secret': secretKey,
        'X-XSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(values),
      credentials: 'include'
    });

    if (error.value) {
      throw new Error(error.value.message);
    }

    // Wait until response is successful before showing the alert
    if (data.value?.success) {
      await Swal.fire({
        icon: 'success',
        title: 'Service Scheduled!',
        text: 'Your service has been scheduled successfully. We will notify you when the sitter is on the way.',
        timer: 5000
      });

      clearFields();
    } else {
      throw new Error("Something went wrong!");
    }
  } catch (err) {
    console.error("Booking failed:", err);
    Swal.fire({
      icon: 'error',
      title: 'Oops!',
      text: 'Failed to schedule the service. Please try again later.',
    });
  }
  };
</script>

<template>
  <div class="lg:basis-[60%] flex flex-col gap-10 bg-secondary px-8 lg:px-20 py-10">
    <span class="text-3xl lg:text-5xl text-primary font-bold leading-tight tracking-tight">
      We'll take your dog for a walk, Just tell us when!
    </span>

    <Form @submit="onSubmit" class="flex flex-col gap-7 text-primary">
      <!-- Frequency & Date -->
      <div class="flex flex-col lg:flex-row gap-3">
        <div class="flex flex-col flex-1">
          <label>Frequency</label>
          <div class="rounded-lg bg-white mt-3 p-2 h-[50px] flex">
            <Field 
              type="hidden"
              name="frequency"
              v-model="frequency"
            />
            <button
              type="button"
              class="px-4 w-full h-full rounded-l-lg transition duration-300"
              :class="frequency === 'Recurring' ? 'bg-tertiary' : 'bg-transparent'"
              @click="frequency = 'Recurring'"
            >
              Recurring
            </button>
            <button
              type="button"
              class="px-4 w-full h-full rounded-r-lg transition duration-300"
              :class="frequency === 'One Time' ? 'bg-tertiary' : 'bg-transparent'"
              @click="frequency = 'One Time'"
            >
              One Time
            </button>
          </div>
        </div>

        <div class="flex flex-col flex-1">
          <label>Start Date</label>
          <Field
            type="date"
            name="start_date"
            :min="minDate"
            class="rounded-lg bg-white mt-3 p-3 h-[50px] text-tertiary appearance-none w-full"
            :rules="validateStartDate"
          />
          <ErrorMessage name="start_date" class="text-red-500" />
        </div>
      </div>

      <!-- Days Selection -->
      <div class="flex flex-col">
        <label>Days: <span class="ps-1 font-light tracking-tight">Select all that apply</span></label>
        <div class="rounded-lg mt-3 py-2 h-auto flex gap-1 flex-wrap">
          <Field
            type="hidden"
            name="days"
            v-model="selectedDays"
            :rules="validateDays"
          />
          <button
            type="button"
            v-for="day in days"
            :key="day"
            class="px-4 py-2 flex-1 rounded font-semibold transition duration-300"
            :class="selectedDays.includes(day) ? 'bg-tertiary text-white' : 'bg-white text-primary'"
            @click="toggleDay(day)"
          >
            {{ day }}
          </button>
        </div>
        <ErrorMessage name="days" class="text-red-500" />
      </div>

      <!-- Times Selection -->
      <div class="flex flex-col">
        <label>Times: <span class="ps-1 font-light tracking-tight">Select all that apply</span></label>
        <div class="rounded-lg mt-3 py-2 h-auto flex gap-1 flex-wrap">
          <Field
            type="hidden"
            name="times"
            v-model="selectedTime"
            :rules="validateTimes"
          />
          <button
            type="button"
            v-for="time in times"
            :key="time"
            class="px-4 py-2 flex-1 rounded font-semibold transition duration-300"
            :class="selectedTime.includes(time) ? 'bg-tertiary text-white' : 'bg-white text-primary'"
            @click="toggleTime(time)"
          >
            {{ time }}
          </button>
        </div>
        <ErrorMessage name="times" class="text-red-500" />
      </div>

      <!-- Notes -->
      <div class="flex flex-col">
        <label>Notes to your sitter:</label>
        <Field
          as="textarea"
          name="notes"
          v-model="notes"
          class="w-full mt-3 placeholder-tertiary p-2 rounded resize-none"
          placeholder="Rocks performances, leash location, treats given, etc."
          rows="3"
        ></Field>
      </div>

      <!-- Submit Button -->
      <div class="flex items-center justify-center mt-6">
        <button type="submit" class="bg-primary font-light text-white rounded-full py-3 px-10 w-full lg:w-auto">
          Schedule Service
        </button>
      </div>
    </Form>
  </div>
</template>

<style scoped></style>
