<template>
  <div class="w-full p-2 max-w-4xl animate-fade-in text-center">
    <h1 class="text-5xl font-extrabold mb-4 tracking-tighter leading-tight text-[#0a1b2e]">
      What is your primary goal?
    </h1>
    <p class="text-gray-400 text-lg mb-14">
      We'll use this to optimize your AI portfolio for the right timeline.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-20">
      <div 
        v-for="goal in goals" 
        :key="goal.id"
        @click="onboardingStore.goal = goal.id"
        :class="[
          'cursor-pointer border-2 rounded-2xl p-6 transition-all duration-300 flex flex-col items-center text-center min-h-[200px] justify-center',
          onboardingStore.goal === goal.id 
            ? 'border-[#800000] bg-white ring-1 ring-[#800000]' 
            : 'border-gray-100 bg-white hover:border-gray-200 shadow-sm'
        ]"
      >
        <div class="text-3xl mb-4 bg-gray-50 w-14 h-14 flex items-center justify-center rounded-full">
          <i :class="[goal.icon, onboardingStore.goal === goal.id ? 'text-[#800000]' : 'text-gray-600']"></i>
        </div>
        
        <h3 class="font-bold text-lg mb-1 text-[#0a1b2e]">{{ goal.title }}</h3>
        <p class="text-gray-400 text-xs leading-tight px-2">{{ goal.desc }}</p>
      </div>
    </div>

    <div class="flex items-center justify-center gap-12 mt-10">
      <button 
        @click="$router.push('/onboarding/step3')"
        class="text-gray-400 font-bold hover:text-[#0a1b2e] transition-colors text-lg"
      >
        Back
      </button>
      <button 
        @click="$router.push('/onboarding/step5')"
        class="bg-[#800000] text-white px-16 py-4 rounded-xl font-bold text-lg hover:bg-[#600000] transition-all shadow-lg shadow-red-900/10 active:scale-95 min-w-[180px]"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script setup>
import { onboardingStore } from '../../store/onboardingstore'

const goals = [
  { 
    id: 'wealth', 
    title: 'Grow Wealth', 
    desc: 'Focus on long-term capital appreciation.', 
    icon: 'fas fa-chart-line' 
  },
  { 
    id: 'retirement', 
    title: 'Retirement', 
    desc: 'Building a comfortable future nest egg.', 
    icon: 'fas fa-umbrella-beach' 
  },
  { 
    id: 'education', 
    title: 'Education', 
    desc: 'Saving for college or specialized training.', 
    icon: 'fas fa-graduation-cap' 
  },
  { 
    id: 'savings', 
    title: 'Big Purchase', 
    desc: 'Saving for a home, car, or major event.', 
    icon: 'fas fa-home' 
  }
]
</script>