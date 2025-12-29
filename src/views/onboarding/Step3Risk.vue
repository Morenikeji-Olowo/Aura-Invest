<template>
  <div class="w-full max-w-4xl animate-fade-in text-center">
    <h1 class="text-5xl font-extrabold mb-4 tracking-tighter leading-tight text-[#0a1b2e]">
      What's your risk comfort level?
    </h1>
    <p class="text-gray-400 text-lg mb-14">
      This helps us tailor investment suggestions to your comfort zone.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-20">
      <div 
        v-for="risk in riskLevels" 
        :key="risk.id"
        @click="onboardingStore.riskLevel = risk.id"
        :class="[
          'cursor-pointer border-2 rounded-2xl p-8 transition-all duration-300 flex flex-col items-start text-left min-h-[240px]',
          onboardingStore.riskLevel === risk.id 
            ? 'border-[#800000] bg-white ring-1 ring-[#800000]' 
            : 'border-gray-100 bg-white hover:border-gray-200'
        ]"
      >
        <div class="mb-6">
          <i :class="[
            risk.icon, 
            onboardingStore.riskLevel === risk.id ? 'text-[#800000]' : 'text-gray-800'
          ]" class="text-3xl"></i>
        </div>
        
        <h3 class="font-bold text-xl mb-2 text-[#0a1b2e]">{{ risk.title }}</h3>
        <p class="text-gray-400 text-[15px] leading-snug">{{ risk.desc }}</p>
      </div>
    </div>

    <div class="flex items-center justify-center gap-12 mt-10">
      <button 
        @click="$router.push('/onboarding/step2')"
        class="text-gray-400 font-bold hover:text-[#0a1b2e] transition-colors text-lg"
      >
        Back
      </button>
      <button 
        @click="$router.push('/onboarding/step4')"
        class="bg-[#800000] text-white px-16 py-4 rounded-xl font-bold text-lg hover:bg-[#600000] transition-all shadow-lg shadow-red-900/10 active:scale-95 min-w-[180px]">
        Next
      </button>
    </div>
  </div>
</template>

<script setup>
import { onboardingStore } from '../../store/onboardingstore'


const riskLevels = [
  { 
    id: 'low', 
    title: 'Low', 
    desc: 'I prefer safer, more stable returns.',
    icon: 'fas fa-shield-alt'
  },
  { 
    id: 'medium', 
    title: 'Medium', 
    desc: "I'm willing to take some risk for higher returns.",
    icon: 'fas fa-balance-scale'
  },
  { 
    id: 'high', 
    title: 'High', 
    desc: "I'm comfortable with high risk for the highest returns.",
    icon: 'fas fa-fire'
  }
]
</script>