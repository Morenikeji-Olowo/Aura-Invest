<template>
  <div class="w-full max-w-4xl pb-16">
    
    <div v-if="isCalculating" class="text-center py-16">
      <div class="relative w-20 h-20 mx-auto mb-6">
        <div class="absolute inset-0 border-4 border-[#800000]/20 rounded-full"></div>
        <div class="absolute inset-0 border-4 border-[#800000] rounded-full border-t-transparent animate-spin"></div>
        <i class="fas fa-microchip absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[#800000] text-2xl"></i>
      </div>
      <h1 class="text-3xl font-bold mb-3 text-gray-900">Analyzing your profile...</h1>
      <p class="text-gray-400">AI optimizing allocation for <b>{{ onboardingStore.goal }}</b>.</p>
    </div>

    <div v-else>
      <div class="text-center mb-10">
        <h1 class="text-4xl font-bold mb-3 text-gray-900">
          Your AI Recommendation
        </h1>
        <p class="text-gray-400">
          Based on <span class="text-[#800000] font-bold capitalize">{{ onboardingStore.riskLevel }} Risk</span> comfort.
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-gray-50 rounded-2xl p-8 border border-gray-100">
          <h3 class="text-lg font-bold mb-6 text-gray-900">Asset Allocation</h3>
          <div class="space-y-4">
            <div v-for="asset in portfolio" :key="asset.name">
              <div class="flex justify-between mb-1">
                <span class="font-semibold text-gray-700">{{ asset.name }}</span>
                <span class="font-bold text-[#800000]">{{ asset.weight }}%</span>
              </div>
              <div class="w-full h-2.5 bg-gray-200 rounded-full overflow-hidden">
                <div 
                  class="h-full bg-[#800000] transition-all duration-1000" 
                  :style="{ width: asset.weight + '%' }"
                ></div>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-[#0a1b2e] rounded-2xl p-8 text-white flex flex-col justify-between relative overflow-hidden">
          <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/5 rounded-full"></div>
          
          <div class="relative z-10">
            <h3 class="text-base font-medium text-gray-400 mb-1">Expected Return</h3>
            <div class="text-4xl font-bold text-white">14.2%<span class="text-sm font-normal text-gray-400">/yr</span></div>
            <p class="text-sm text-gray-400 mt-4">
              Optimized for <span class="capitalize text-white">{{ onboardingStore.horizon }}</span> horizon.
            </p>
          </div>

          <div class="relative z-10">
            <button
            type="button"
            @click="startInvesting"
            class="w-full bg-[#800000] py-3 rounded-xl font-bold hover:bg-[#a00000] shadow-xl active:scale-95">
            Start Investing
           </button>
            <p class="text-[10px] text-center text-gray-500 mt-3 uppercase tracking-widest font-bold">Secure AI Encryption Active</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { onboardingStore } from '../../store/onboardingstore'
import { useRouter } from 'vue-router'

const router = useRouter()

function startInvesting() {
  router.push('/dashboard')
}

const isCalculating = ref(true)

const portfolio = [
  { name: 'US Large Cap Stocks', weight: 40 },
  { name: 'Emerging Markets', weight: 25 },
  { name: 'AI & Robotics Tech', weight: 20 },
  { name: 'Government Bonds', weight: 15 }
]

onMounted(() => {
  setTimeout(() => {
    isCalculating.value = false
  }, 2500)
})

const finishOnboarding = () => {
  console.log("Onboarding complete. Redirecting to Dashboard...");
  router.push('/dashboard')
}
</script>