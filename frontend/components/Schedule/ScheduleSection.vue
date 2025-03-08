<script setup lang="ts">

import moment from 'moment'

const minDate = computed(() => {
  return moment().format('YYYY-MM-DD')
})

const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
const times = ["Morning", "Afternoon", "Evening"];

const frequency = ref('Recurring')
const selectedDays = ref<string[]>([]);
const selectedTime = ref<string[]>([]);


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
      <div class="lg:basis-[60%] flex flex-col gap-10 bg-secondary px-8 lg:px-20 py-10">
        <span class="text-3xl lg:text-5xl text-primary font-bold leading-tight tracking-tight">
          We'll take your dog for a walk, Just tell us when!
        </span>

        <form class="flex flex-col gap-7 text-primary">
          <!-- Frequency & Date -->
          <div class="flex flex-col lg:flex-row gap-3">
            <div class="flex flex-col flex-1">
              <label>Frequency</label>
              <div class="rounded-lg bg-white mt-3 p-2 h-[50px] flex">
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
              <input
                type="date"
                :min="minDate"
                class="rounded-lg bg-white mt-3 p-3 h-[50px] text-tertiary appearance-none w-full"
              />
            </div>
          </div>

          <!-- Days Selection -->
          <div class="flex flex-col">
            <label>Days: <span class="ps-1 font-light tracking-tight">Select all that apply</span></label>
            <div class="rounded-lg mt-3 py-2 h-auto flex gap-1 flex-wrap">
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
          </div>

          <!-- Times Selection -->
          <div class="flex flex-col">
            <label>Times: <span class="ps-1 font-light tracking-tight">Select all that apply</span></label>
            <div class="rounded-lg mt-3 py-2 h-auto flex gap-1 flex-wrap">
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
          </div>

          <!-- Notes -->
          <div class="flex flex-col">
            <label>Notes to your sitter</label>
            <textarea
              class="w-full mt-3 placeholder-tertiary p-2 rounded resize-none"
              placeholder="Rocks performances, leash location, treats given, etc."
              rows="3"
            ></textarea>
          </div>

          <!-- Submit Button -->
          <div class="flex items-center justify-center mt-6">
            <button type="submit" class="bg-primary font-light text-white rounded-full py-3 px-10 w-full lg:w-auto">
              Schedule Service
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</template>

<style lang="scss" scoped>
</style>
