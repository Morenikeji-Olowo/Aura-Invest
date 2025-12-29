<template>
  <div class="w-full max-w-4xl animate-fade-in">
    <h1 class="text-5xl font-extrabold mb-12 tracking-tighter leading-[1.1] text-[#0a1b2e]">
      What's your name and <br /> investment knowledge level?
    </h1>

    <div class="mb-10 text-left">
      <label class="block text-sm font-bold mb-3 text-gray-700">Full Name</label>
      <input 
        v-model="onboardingStore.name"
        type="text" 
        placeholder="John Doe"
        class="w-full border border-gray-200 rounded-xl p-4 text-lg focus:outline-none focus:ring-2 focus:ring-[#800000]/10 focus:border-[#800000] transition-all placeholder:text-gray-300"
      />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
      <div 
        v-for="level in levels" 
        :key="level.id"
        @click="onboardingStore.knowledge = level.id"
        :class="[
          'cursor-pointer border-2 rounded-2xl p-8 transition-all duration-300 min-h-[160px] flex flex-col justify-center text-left',
          onboardingStore.knowledge === level.id 
            ? 'border-[#800000] bg-white ring-1 ring-[#800000]' 
            : 'border-gray-100 bg-white hover:border-gray-200'
        ]"
      >
        <h3 class="font-bold text-xl mb-1 text-[#0a1b2e]">{{ level.title }}</h3>
        <p class="text-gray-400 text-sm leading-snug">{{ level.desc }}</p>
      </div>
    </div>

    <div class="flex items-center justify-center gap-12 mt-10">
      <button 
        @click="$router.push('/onboarding/step1')"
        class="text-gray-400 font-bold hover:text-[#0a1b2e] transition-colors text-lg"
      >
        Back
      </button>
      <button 
        @click="$router.push('/onboarding/step3')"
        class="bg-[#800000] text-white px-16 py-4 rounded-xl font-bold text-lg hover:bg-[#600000] transition-all shadow-lg shadow-red-900/10 active:scale-95 min-w-[180px]"
      >
        Next
      </button>
    </div>
  </div>
</template>

<script setup>
import { onboardingStore } from '../../store/onboardingStore'


const levels = [
  { 
    id: 'beginner', 
    title: 'Beginner', 
    desc: "I'm new to investing." 
  },
  { 
    id: 'intermediate', 
    title: 'Intermediate', 
    desc: 'I have some experience.' 
  },
  { 
    id: 'advanced', 
    title: 'Advanced', 
    desc: "I'm an experienced investor." 
  }
]
</script>