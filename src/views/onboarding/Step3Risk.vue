<template>
  <div class="w-full max-w-3xl text-center">
    <h1 class="text-4xl font-bold mb-3 text-gray-900">
      What's your risk comfort level?
    </h1>
    <p class="text-gray-400 mb-10">
      Helps tailor investment suggestions to your comfort zone.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-16">
      <div 
        v-for="risk in riskLevels" 
        :key="risk.id"
        @click="onboardingStore.riskLevel = risk.id"
        :class="[
          'cursor-pointer border-2 rounded-xl p-6 flex flex-col items-start text-left min-h-[200px]',
          onboardingStore.riskLevel === risk.id 
            ? 'border-[#800000] bg-white ring-1 ring-[#800000]' 
            : 'border-gray-100 bg-white hover:border-gray-200'
        ]"
      >
        <div class="mb-4">
          <i :class="[
            risk.icon, 
            onboardingStore.riskLevel === risk.id ? 'text-[#800000]' : 'text-gray-800'
          ]" class="text-2xl"></i>
        </div>
        
        <h3 class="font-bold text-lg mb-2 text-gray-900">{{ risk.title }}</h3>
        <p class="text-gray-400 text-sm">{{ risk.desc }}</p>
      </div>
    </div>

    <div class="flex items-center justify-center gap-8">
      <button 
        @click="$router.push('/onboarding/step2')"
        class="text-gray-400 font-bold hover:text-gray-900 text-lg"
      >
        Back
      </button>
      <button 
        @click="$router.push('/onboarding/step4')"
        class="bg-[#800000] text-white px-16 py-4 rounded-xl font-bold text-lg hover:bg-[#600000] shadow-lg shadow-red-900/10 active:scale-95 min-w-[180px]">
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
    desc: "I'm comfortable with high risk for highest returns.",
    icon: 'fas fa-fire'
  }
]
</script>