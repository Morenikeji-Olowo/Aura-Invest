<template>
  <div class="w-full max-w-3xl">
    <h1 class="text-4xl font-bold mb-8 text-gray-900">
      What's your name and investment knowledge level?
    </h1>

    <div class="mb-8">
      <label class="block text-sm font-bold mb-2 text-gray-700">Full Name</label>
      <input 
        v-model="onboardingStore.name"
        type="text" 
        placeholder="John Doe"
        class="w-full border border-gray-200 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-red-600/10 focus:border-red-600"
      />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
      <div 
        v-for="level in levels" 
        :key="level.id"
        @click="onboardingStore.knowledge = level.id"
        :class="[
          'cursor-pointer border-2 rounded-xl p-6 transition-all min-h-[140px] flex flex-col justify-center',
          onboardingStore.knowledge === level.id 
            ? 'border-red-600 bg-white' 
            : 'border-gray-100 bg-white hover:border-gray-200'
        ]"
      >
        <h3 class="font-bold text-lg mb-1 text-gray-900">{{ level.title }}</h3>
        <p class="text-gray-500 text-sm">{{ level.desc }}</p>
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
  { id: 'beginner', title: 'Beginner', desc: "I'm new to investing." },
  { id: 'intermediate', title: 'Intermediate', desc: 'I have some experience.' },
  { id: 'advanced', title: 'Advanced', desc: "I'm an experienced investor." }
]
</script>