<template>
  <div class="w-full max-w-4xl animate-fade-in text-center">
    <h1 class="text-5xl font-extrabold mb-4 tracking-tighter leading-tight text-[#0a1b2e]">
      How long do you plan to invest?
    </h1>
    <p class="text-gray-400 text-lg mb-14">
      Your timeline helps our AI manage risk as you get closer to your goal.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-20">
      <div 
        v-for="time in horizons" 
        :key="time.id"
        @click="onboardingStore.horizon = time.id"
        :class="[
          'cursor-pointer border-2 rounded-2xl p-8 transition-all duration-300 flex flex-col items-center text-center min-h-[240px] justify-center',
          onboardingStore.horizon === time.id 
            ? 'border-[#800000] bg-white ring-1 ring-[#800000]' 
            : 'border-gray-100 bg-white hover:border-gray-200 shadow-sm'
        ]"
      >
        <div class="mb-6">
          <i :class="[
            time.icon, 
            onboardingStore.horizon === time.id ? 'text-[#800000]' : 'text-gray-400'
          ]" class="text-4xl"></i>
        </div>
        
        <h3 class="font-bold text-xl mb-2 text-[#0a1b2e]">{{ time.title }}</h3>
        <p class="text-gray-400 text-sm leading-snug px-4">{{ time.desc }}</p>
      </div>
    </div>

    <div class="flex items-center justify-center gap-12 mt-10">
      <button 
        @click="$router.push('/onboarding/step4')"
        class="text-gray-400 font-bold hover:text-[#0a1b2e] transition-colors text-lg"
      >
        Back
      </button>
      <button 
        @click="$router.push('/onboarding/step6')"
        class="bg-[#800000] text-white px-16 py-4 rounded-xl font-bold text-lg hover:bg-[#600000] transition-all shadow-lg shadow-red-900/10 active:scale-95 min-w-[180px]"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script setup>
import { onboardingStore } from '../../store/onboardingstore'

const horizons = [
  { 
    id: 'short-term', 
    title: 'Short Term', 
    desc: 'Less than 3 years. Focus on liquidity and capital preservation.', 
    icon: 'fas fa-hourglass-start' 
  },
  { 
    id: 'medium-term', 
    title: 'Medium Term', 
    desc: '3 to 7 years. A balanced approach to growth and stability.', 
    icon: 'fas fa-hourglass-half' 
  },
  { 
    id: 'long-term', 
    title: 'Long Term', 
    desc: '7+ years. Maximize compounding and long-term growth.', 
    icon: 'fas fa-infinity' 
  }
]
</script>