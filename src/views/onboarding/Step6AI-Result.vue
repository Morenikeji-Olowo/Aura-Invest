<template>
  <div class="w-full max-w-5xl animate-fade-in pb-20">
    
    <div v-if="isCalculating" class="text-center py-20 animate-pulse">
      <div class="relative w-24 h-24 mx-auto mb-8">
        <div class="absolute inset-0 border-4 border-[#800000]/20 rounded-full"></div>
        <div class="absolute inset-0 border-4 border-[#800000] rounded-full border-t-transparent animate-spin"></div>
        <i class="fas fa-microchip absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[#800000] text-3xl"></i>
      </div>
      <h1 class="text-4xl font-extrabold mb-4 tracking-tighter text-[#0a1b2e]">Analyzing your profile...</h1>
      <p class="text-gray-400">Our AI is optimizing your asset allocation for <b>{{ onboardingStore.goal }}</b>.</p>
    </div>

    <div v-else class="animate-fade-in">
      <div class="text-center mb-12">
        <h1 class="text-5xl font-extrabold mb-4 tracking-tighter leading-tight text-[#0a1b2e]">
          Your AI Recommendation
        </h1>
        <p class="text-gray-400 text-lg">
          Based on your <span class="text-[#800000] font-bold capitalize">{{ onboardingStore.riskLevel }} Risk</span> comfort, 
          we've built this portfolio for you.
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-gray-50 rounded-[30px] p-10 border border-gray-100">
          <h3 class="text-xl font-bold mb-8 text-[#0a1b2e]">Asset Allocation</h3>
          <div class="space-y-6">
            <div v-for="asset in portfolio" :key="asset.name">
              <div class="flex justify-between mb-2">
                <span class="font-semibold text-gray-700">{{ asset.name }}</span>
                <span class="font-bold text-[#800000]">{{ asset.weight }}%</span>
              </div>
              <div class="w-full h-3 bg-gray-200 rounded-full overflow-hidden">
                <div 
                  class="h-full bg-[#800000] transition-all duration-1000 ease-out" 
                  :style="{ width: asset.weight + '%' }"
                ></div>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-[#0a1b2e] rounded-[30px] p-10 text-white flex flex-col justify-between shadow-2xl relative overflow-hidden">
          <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/5 rounded-full"></div>
          
          <div class="relative z-10">
            <h3 class="text-lg font-medium text-gray-400 mb-2">Expected Return</h3>
            <div class="text-5xl font-extrabold text-white">14.2%<span class="text-sm font-normal text-gray-400">/yr</span></div>
            <p class="text-sm text-gray-400 mt-6 leading-relaxed">
              This allocation is optimized for a <span class="capitalize text-white">{{ onboardingStore.horizon }}</span> horizon.
            </p>
          </div>

          <div class="relative z-10">
            <button
            type="button"
            @click="startInvesting"
            class=" w-full bg-[#800000] py-4 rounded-xl font-bold text-lg hover:bg-[#a00000] transition-all shadow-xl active:scale-95">
            Start Investing
           </button>
            <p class="text-[10px] text-center text-gray-500 mt-4 uppercase tracking-widest font-bold">Secure AI Encryption Active</p>
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

// Mock portfolio data
const portfolio = [
  { name: 'US Large Cap Stocks', weight: 40 },
  { name: 'Emerging Markets', weight: 25 },
  { name: 'AI & Robotics Tech', weight: 20 },
  { name: 'Government Bonds', weight: 15 }
]

onMounted(() => {
  // Simulating the "AI Analysis" wait time for UX
  setTimeout(() => {
    isCalculating.value = false
  }, 2500)
})

const finishOnboarding = () => {
  // You can add a small delay for a "processing" feel
  console.log("Onboarding complete. Redirecting to Dashboard...");
  router.push('/dashboard')
}
</script>