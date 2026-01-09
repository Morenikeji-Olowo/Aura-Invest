<template>
  <div class="flex min-h-screen w-full overflow-hidden bg-[#f8f9fa] font-['Inter']">
    <!-- Mobile header (only on small screens) -->
    <div class="md:hidden fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100 px-4 py-3 shadow-sm">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-[#800000] font-bold text-lg">
          <i class="fas fa-chart-pie"></i>
          <span>Aura Invest</span>
        </div>
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 hover:bg-gray-50 rounded-lg transition-colors">
          <i :class="mobileMenuOpen ? 'fas fa-times' : 'fas fa-bars'" class="text-gray-600 text-xl"></i>
        </button>
      </div>
    </div>

    <!-- Mobile menu overlay -->
    <div v-if="mobileMenuOpen" 
         class="md:hidden fixed inset-0 z-40 bg-black bg-opacity-50 transition-opacity"
         @click="mobileMenuOpen = false">
    </div>

    <!-- Sidebar (fixed on desktop, slide-in on mobile) -->
    <aside :class="[
      'bg-white border-r border-gray-100 flex flex-col shrink-0 transition-transform duration-300 ease-in-out overflow-y-auto',
      'md:w-64 md:static md:translate-x-0 md:h-screen',
      mobileMenuOpen ? 'fixed top-0 left-0 z-50 w-72 h-screen translate-x-0 shadow-2xl' : 'fixed -translate-x-full'
    ]">
      <div class="p-6 md:p-8">
        <div class="flex items-center justify-between md:justify-start gap-2 text-[#800000] font-bold text-xl mb-8 md:mb-10">
          <div class="flex items-center gap-2">
            <i class="fas fa-chart-pie"></i>
            <span>Aura Invest</span>
          </div>
          <button @click="mobileMenuOpen = false" class="md:hidden p-2 hover:bg-gray-50 rounded-lg transition-colors">
            <i class="fas fa-times text-gray-600 text-xl"></i>
          </button>
        </div>

        <nav class="space-y-2">
          <div v-for="item in navItems" :key="item.name" 
            @click="mobileMenuOpen = false"
            :class="[
              'flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer transition-all font-semibold text-sm',
              item.active ? 'bg-[#800000]/10 text-[#800000]' : 'text-gray-400 hover:bg-gray-50 hover:text-gray-600'
            ]"
          >
            <i :class="item.icon" class="w-5 text-center"></i>
            {{ item.name }}
          </div>
        </nav>
      </div>

      <div class="mt-auto p-6 md:p-8 border-t border-gray-50 space-y-4">
        <div class="flex items-center gap-3 text-gray-400 font-semibold text-sm cursor-pointer hover:text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-50 transition-all">
          <i class="fas fa-cog w-5 text-center"></i> Settings
        </div>

        <button 
          @click="logout"
          :disabled="isSaving"
          class="flex items-center gap-3 text-gray-400 font-semibold text-sm cursor-pointer hover:text-gray-600 disabled:opacity-50 w-full px-4 py-2 rounded-lg hover:bg-gray-50 transition-all"
        >
          <i class="fas fa-sign-out-alt w-5 text-center"></i> Logout
        </button>
      </div>
    </aside>

    <!-- Main content area -->
    <main class="w-full flex-1 p-4 sm:p-6 md:p-8 lg:p-10 overflow-y-auto h-screen mt-[60px] md:mt-0">
      <!-- Header -->
      <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-10 gap-4">
        <div>
          <h1 class="text-2xl sm:text-2xl md:text-3xl font-bold tracking-tight">Welcome back, Alex!</h1>
          <p class="text-gray-400 text-sm mt-1">Here is your investment progress summary.</p>
        </div>
        <div class="flex items-center gap-3 self-end sm:self-auto">
          <div class="text-right hidden sm:block">
            <p class="font-bold text-sm">Alex Doe</p>
            <p class="text-gray-400 text-xs">alex.doe@email.com</p>
          </div>
          <img src="https://i.pravatar.cc/150?u=alex" 
               alt="Profile"
               class="w-10 h-10 md:w-12 md:h-12 rounded-full border-2 border-white shadow-sm" />
        </div>
      </header>

      <!-- Top Stats Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8 w-full">
        <div class="bg-white p-5 md:p-6 rounded-[20px] md:rounded-[24px] border border-gray-50 shadow-sm hover:shadow-md transition-shadow">
          <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Total Balance</p>
          <p class="text-2xl md:text-3xl font-extrabold">$125,430.50</p>
          <p class="text-xs text-gray-400 mt-1">Updated today</p>
        </div>
        <div class="bg-white p-5 md:p-6 rounded-[20px] md:rounded-[24px] border border-gray-50 shadow-sm hover:shadow-md transition-shadow">
          <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Weekly Change</p>
          <p class="text-2xl md:text-3xl font-extrabold text-green-500">
            +1.25%
          </p>
          <p class="text-sm font-normal text-green-400 mt-1">+$1,548.12</p>
        </div>
        <div class="bg-white p-5 md:p-6 rounded-[20px] md:rounded-[24px] border border-gray-50 shadow-sm hover:shadow-md transition-shadow sm:col-span-2 lg:col-span-1">
          <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Monthly Change</p>
          <p class="text-2xl md:text-3xl font-extrabold text-green-500">
            +5.80%
          </p>
          <p class="text-sm font-normal text-green-400 mt-1">+$6,890.44</p>
        </div>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 md:gap-8 w-full pb-6">
        <!-- Left Column (8 cols on XL) -->
        <div class="xl:col-span-8 space-y-6 md:space-y-8 w-full">
          <!-- Portfolio Chart -->
          <div class="bg-white p-5 md:p-6 lg:p-8 rounded-[20px] md:rounded-[30px] border border-gray-50 shadow-sm hover:shadow-md transition-shadow w-full">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 md:mb-6 gap-3">
              <h3 class="font-bold text-lg md:text-xl">Portfolio Performance</h3>
              <div class="flex gap-1.5 md:gap-2 w-full sm:w-auto overflow-x-auto pb-1 scrollbar-hide">
                <button class="text-xs px-3 py-1.5 rounded-lg text-gray-400 hover:bg-gray-50 whitespace-nowrap transition-colors">1W</button>
                <button class="text-xs px-3 py-1.5 rounded-lg text-gray-400 hover:bg-gray-50 whitespace-nowrap transition-colors">1M</button>
                <button class="text-xs px-3 py-1.5 rounded-lg bg-[#800000]/10 text-[#800000] font-semibold whitespace-nowrap">3M</button>
                <button class="text-xs px-3 py-1.5 rounded-lg text-gray-400 hover:bg-gray-50 whitespace-nowrap transition-colors">1Y</button>
                <button class="text-xs px-3 py-1.5 rounded-lg text-gray-400 hover:bg-gray-50 whitespace-nowrap transition-colors">All</button>
              </div>
            </div>
            <div class="h-48 md:h-56 lg:h-64 w-full bg-gradient-to-t from-[#800000]/5 to-transparent rounded-xl flex items-end px-3 md:px-4 gap-1 md:gap-2">
              <div v-for="n in 12" :key="n" class="flex-1 bg-[#800000] rounded-t-sm opacity-20 hover:opacity-40 transition-opacity cursor-pointer" 
                   :style="{ height: Math.random() * 80 + 20 + '%' }"></div>
            </div>
            <div class="mt-4 flex justify-center gap-6 text-xs text-gray-400">
              <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-[#800000] rounded-full"></div>
                <span>Growth</span>
              </div>
            </div>
          </div>

          <!-- Goals Section -->
          <div class="w-full">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 md:mb-6 gap-3">
              <h3 class="font-bold text-lg md:text-xl">Your Goals</h3>
              <button class="text-xs font-bold text-[#800000] px-4 py-2 rounded-lg border border-[#800000]/20 hover:bg-[#800000]/5 whitespace-nowrap transition-all w-full sm:w-auto">
                <i class="fas fa-plus mr-2"></i>Add New Goal
              </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 w-full">
              <div v-for="goal in goals" :key="goal.title" class="bg-white p-5 md:p-6 rounded-[20px] md:rounded-[24px] border border-gray-50 shadow-sm hover:shadow-md transition-shadow w-full">
                <div class="flex justify-between mb-4">
                  <span class="font-bold text-sm md:text-base">{{ goal.title }}</span>
                  <span class="text-[#800000] font-bold text-sm md:text-base">{{ goal.progress }}%</span>
                </div>
                <div class="w-full h-2 bg-gray-100 rounded-full mb-4 overflow-hidden">
                  <div class="h-full bg-[#800000] rounded-full transition-all duration-500" 
                       :style="{ width: goal.progress + '%' }"></div>
                </div>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                  <span class="text-gray-400 text-xs font-medium">Target: ${{ goal.target.toLocaleString() }}</span>
                  <button class="text-xs font-bold border border-gray-200 px-4 py-1.5 rounded-lg hover:bg-gray-50 hover:border-[#800000] hover:text-[#800000] whitespace-nowrap transition-all w-full sm:w-auto">
                    Top Up
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column (4 cols on XL) -->
        <div class="xl:col-span-4 space-y-6 md:space-y-8 w-full">
          <!-- Asset Allocation -->
          <div class="bg-white p-5 md:p-6 lg:p-8 rounded-[20px] md:rounded-[30px] border border-gray-50 shadow-sm hover:shadow-md transition-shadow w-full">
            <h3 class="font-bold text-lg md:text-xl mb-6">Asset Allocation</h3>
            <div class="w-32 h-32 md:w-40 md:h-40 rounded-full border-[14px] md:border-[18px] border-[#800000] border-l-gray-200 border-b-gray-400 mx-auto mb-6 flex items-center justify-center shadow-inner">
              <span class="font-extrabold text-base md:text-lg">100%</span>
            </div>
            <div class="space-y-3 text-sm md:text-base">
              <div class="flex justify-between items-center p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-2">
                  <div class="w-3 h-3 rounded-full bg-[#800000]"></div>
                  <span class="text-gray-600">Stocks</span>
                </div>
                <span class="font-bold">60%</span>
              </div>
              <div class="flex justify-between items-center p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-2">
                  <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                  <span class="text-gray-600">Bonds</span>
                </div>
                <span class="font-bold">25%</span>
              </div>
              <div class="flex justify-between items-center p-2 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-2">
                  <div class="w-3 h-3 rounded-full bg-gray-200"></div>
                  <span class="text-gray-600">Crypto</span>
                </div>
                <span class="font-bold">15%</span>
              </div>
            </div>
          </div>

          <!-- AI Insights -->
          <div class="bg-[#800000]/5 p-5 md:p-6 lg:p-8 rounded-[20px] md:rounded-[30px] border border-[#800000]/10 w-full">
            <h3 class="font-bold text-lg md:text-xl mb-4 md:mb-6 flex items-center gap-2">
              <i class="fas fa-lightbulb text-[#800000]"></i> AI Insights
            </h3>
            <div class="space-y-4 md:space-y-5">
              <div v-for="insight in insights" :key="insight.title" class="bg-white p-4 md:p-5 rounded-xl md:rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start gap-3">
                  <div class="w-8 h-8 bg-[#800000]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-chart-line text-[#800000] text-sm"></i>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="font-bold text-sm mb-1.5">{{ insight.title }}</p>
                    <p class="text-gray-400 text-xs leading-relaxed">{{ insight.desc }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const isSaving = ref(false)
const mobileMenuOpen = ref(false)

// Navigation items
const navItems = [
  { name: 'Dashboard', icon: 'fas fa-home', active: true },
  { name: 'Portfolio', icon: 'fas fa-chart-line', active: false },
  { name: 'Transactions', icon: 'fas fa-exchange-alt', active: false },
  { name: 'Goals', icon: 'fas fa-bullseye', active: false },
  { name: 'Analytics', icon: 'fas fa-chart-bar', active: false }
]

// Goals data
const goals = [
  { title: 'Retirement Fund', progress: 75, target: 50000 },
  { title: 'Vacation Fund', progress: 50, target: 10000 },
  { title: 'Emergency Fund', progress: 90, target: 15000 }
]

// AI Insights data
const insights = [
  { title: 'Market Trends', desc: 'The stock market is expected to rise in the next quarter based on current economic indicators.' },
  { title: 'Risk Assessment', desc: 'Your current portfolio is well-balanced with a moderate risk level suitable for long-term growth.' },
  { title: 'Performance Forecast', desc: 'Based on current trends, your portfolio is projected to grow by 5% in the next year.' }
]

const logout = async () => {  
  isSaving.value = true
  try {
    const response = await fetch(`${import.meta.env.VITE_API_BASE_URL}/code/auth/logout.php`, {
      method: 'POST',
      credentials: 'include',
    });

    if (response.ok) {
      console.log('Logout successful');
      localStorage.clear();
      window.location.reload();
    } else {
      console.error('Logout failed');
    }
  } catch (error) {
    console.error('Error during logout:', error);
  } finally {
    isSaving.value = false
  }
}
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

/* Hide scrollbar for Chrome, Safari and Opera */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.scrollbar-hide {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}

/* Custom scrollbar for main content */
main::-webkit-scrollbar {
  width: 6px;
}

main::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

main::-webkit-scrollbar-thumb {
  background: #800000;
  border-radius: 10px;
}

main::-webkit-scrollbar-thumb:hover {
  background: #600000;
}
</style>
