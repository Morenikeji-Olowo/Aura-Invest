<template>
  <div class="w-full max-w-2xl text-center">
    <h1 class="text-5xl font-extrabold mb-6 tracking-tighter leading-tight text-[#0a1b2e]">
      Welcome to Aura Invest
    </h1>
    <p class="text-gray-400 text-lg mb-12">
      Let's set up your personalized investment plan. It will only take a few minutes.
    </p>
    
    <button 
      @click="$router.push('/onboarding/step2')"
      class="bg-[#800000] text-white px-20 py-4 rounded-xl font-bold text-lg hover:bg-[#600000] 
      transition-all shadow-lg shadow-red-900/10 active:scale-95">
      Get started
    </button>
  </div>
</template>