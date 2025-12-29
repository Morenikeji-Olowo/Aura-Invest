<template>
  <div class="text-center">
    <h1 class="text-3xl font-bold mb-3">Invest Smarter</h1>
    <p class="text-gray-500 mb-8">Personalized investment plan in minutes.</p>
    
    <button 
      @click="$router.push('/onboarding/step2')"
      class="bg-[#800000] text-white px-20 py-4 rounded-xl font-bold text-lg hover:bg-[#600000] 
      transition-all shadow-lg shadow-red-900/10 active:scale-95">
      Get started
    </button>
  </div>
</template>