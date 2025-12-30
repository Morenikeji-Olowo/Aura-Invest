<template>
<div class="flex h-screen w-screen overflow-hidden bg-[#f8f9fa]">
    <!-- Fixed sidebar -->
  <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0">
      <div class="p-8">
        <div class="flex items-center gap-2 text-[#800000] font-bold text-xl mb-10">
          <i class="fas fa-chart-pie"></i>
          <span>Aura Invest</span>
        </div>

        <nav class="space-y-2">
          <div v-for="item in navItems" :key="item.name" 
            :class="[
              'flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer transition-all font-semibold text-sm',
              item.active ? 'bg-[#800000]/10 text-[#800000]' : 'text-gray-400 hover:bg-gray-50 hover:text-gray-600'
            ]"
          >
            <i :class="item.icon" class="w-5"></i>
            {{ item.name }}
          </div>
        </nav>
      </div>

      <div class="mt-auto p-8 border-t border-gray-50 space-y-4">
        <div class="flex items-center gap-3 text-gray-400 font-semibold text-sm cursor-pointer hover:text-gray-600">
          <i class="fas fa-cog"></i> Settings
        </div>

        <button 
        @click="logout"
        :disabled="isSaving"
        class="flex items-center gap-3 text-gray-400 font-semibold text-sm cursor-pointer"
      >
        <i class="fas fa-sign-out-alt"></i> Logout
      </button>
      </div>
    </aside>

    <!-- Full-width main content with proper scrolling -->
  <main class="w-full flex-1 p-10 overflow-y-auto">
      <!-- Header -->
      <header class="flex justify-between items-center mb-10">
        <div>
          <h1 class="text-3xl font-bold tracking-tight">Welcome back, Alex!</h1>
          <p class="text-gray-400 text-sm mt-1">Here is your investment progress summary.</p>
        </div>
        <div class="flex items-center gap-3 text-right">
          <div>
            <p class="font-bold text-sm">Alex Doe</p>
            <p class="text-gray-400 text-xs">alex.doe@email.com</p>
          </div>
          <img src="https://i.pravatar.cc/150?u=alex" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" />
        </div>
      </header>

      <!-- Top Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 w-full">
        <div class="bg-white p-6 rounded-[24px] border border-gray-50 shadow-sm w-full">
          <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Total Balance</p>
          <p class="text-3xl font-extrabold">$125,430.50</p>
        </div>
        <div class="bg-white p-6 rounded-[24px] border border-gray-50 shadow-sm w-full">
          <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Weekly Change</p>
          <p class="text-3xl font-extrabold text-green-500">+1.25% <span class="text-sm font-normal text-green-400 ml-1">+$1,548.12</span></p>
        </div>
        <div class="bg-white p-6 rounded-[24px] border border-gray-50 shadow-sm w-full">
          <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Monthly Change</p>
          <p class="text-3xl font-extrabold text-green-500">+5.80% <span class="text-sm font-normal text-green-400 ml-1">+$6,890.44</span></p>
        </div>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 w-full">
        <!-- Left Column (8 cols on XL) -->
        <div class="xl:col-span-8 space-y-8 w-full">
          <!-- Portfolio Chart -->
          <div class="bg-white p-8 rounded-[30px] border border-gray-50 shadow-sm w-full">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-lg">Portfolio Performance</h3>
              <div class="flex gap-2">
                <button class="text-xs px-3 py-1.5 rounded-lg text-gray-400 hover:bg-gray-50">1W</button>
                <button class="text-xs px-3 py-1.5 rounded-lg text-gray-400 hover:bg-gray-50">1M</button>
                <button class="text-xs px-3 py-1.5 rounded-lg bg-[#800000]/10 text-[#800000] font-semibold">3M</button>
                <button class="text-xs px-3 py-1.5 rounded-lg text-gray-400 hover:bg-gray-50">1Y</button>
                <button class="text-xs px-3 py-1.5 rounded-lg text-gray-400 hover:bg-gray-50">All</button>
              </div>
            </div>
            <div class="h-48 w-full bg-gradient-to-t from-[#800000]/5 to-transparent rounded-xl flex items-end px-4 gap-2">
              <div v-for="n in 20" :key="n" class="flex-1 bg-[#800000] rounded-t-sm opacity-20" :style="{ height: Math.random() * 80 + '%' }"></div>
            </div>
          </div>

          <!-- Goals Section -->
          <div class="w-full">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-xl">Your Goals</h3>
              <button class="text-xs font-bold text-[#800000] px-4 py-2 rounded-lg border border-[#800000]/20 hover:bg-[#800000]/5">+ Add New Goal</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
              <div v-for="goal in goals" :key="goal.title" class="bg-white p-6 rounded-[24px] border border-gray-50 shadow-sm w-full">
                <div class="flex justify-between mb-4">
                  <span class="font-bold text-sm">{{ goal.title }}</span>
                  <span class="text-[#800000] font-bold">{{ goal.progress }}%</span>
                </div>
                <div class="w-full h-2 bg-gray-100 rounded-full mb-4">
                  <div class="h-full bg-[#800000] rounded-full" :style="{ width: goal.progress + '%' }"></div>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-gray-400 text-xs font-medium">Target: ${{ goal.target }}</span>
                  <button class="text-xs font-bold border border-gray-200 px-4 py-1.5 rounded-lg hover:bg-gray-50">Top Up</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column (4 cols on XL) -->
        <div class="xl:col-span-4 space-y-8 w-full">
          <!-- Asset Allocation -->
          <div class="bg-white p-8 rounded-[30px] border border-gray-50 shadow-sm text-center w-full">
            <h3 class="font-bold text-lg mb-6 text-left">Asset Allocation</h3>
            <div class="w-32 h-32 rounded-full border-[16px] border-[#800000] border-l-gray-200 border-b-gray-400 mx-auto mb-6 flex items-center justify-center">
              <span class="font-extrabold">100%</span>
            </div>
            <div class="text-left space-y-2 text-sm">
              <div class="flex justify-between"><span class="text-gray-400">• Stocks</span><span class="font-bold">60%</span></div>
              <div class="flex justify-between"><span class="text-gray-400">• Bonds</span><span class="font-bold">25%</span></div>
              <div class="flex justify-between"><span class="text-gray-400">• Crypto</span><span class="font-bold">15%</span></div>
            </div>
          </div>

          <!-- AI Insights -->
          <div class="bg-[#800000]/5 p-8 rounded-[30px] border border-[#800000]/10 w-full">
            <h3 class="font-bold text-lg mb-6 flex items-center gap-2">
              <i class="fas fa-lightbulb text-[#800000]"></i> AI Insights
            </h3>
            <div class="space-y-6">
              <div v-for="insight in insights" :key="insight.title" class="bg-white p-4 rounded-2xl shadow-sm">
                <p class="font-bold text-sm mb-1">{{ insight.title }}</p>
                <p class="text-gray-400 text-[11px] leading-relaxed">{{ insight.desc }}</p>
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
import { useRouter } from 'vue-router'

const router = useRouter()
const isSaving = ref(false)

// Navigation items
const navItems = [
  { name: 'Dashboard', icon: 'fas fa-home', active: true },
  { name: 'Portfolio', icon: 'fas fa-chart-line', active: false },
  { name: 'Transactions', icon: 'fas fa-exchange-alt', active: false },
  { name: 'Goals', icon: 'fas fa-bullseye', active: false },
  { name: 'Settings', icon: 'fas fa-cog', active: false }
]

// Goals data
const goals = [
  { title: 'Retirement Fund', progress: 75, target: 50000 },
  { title: 'Vacation Fund', progress: 50, target: 10000 },
  { title: 'Emergency Fund', progress: 90, target: 15000 }
]

// AI Insights data
const insights = [
  { title: 'Market Trends', desc: 'The stock market is expected to rise in the next quarter.' },
  { title: 'Risk Assessment', desc: 'Your current portfolio is well-balanced with a moderate risk level.' },
  { title: 'Performance Forecast', desc: 'Based on current trends, your portfolio is projected to grow by 5% in the next year.' }
]

const logout = async () => {  
  
  try {
    const response = await fetch('http://localhost/React/AI-Invest-Backend/backend(php)/code/auth/logout.php', {
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
  }
}
</script>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

body {
  margin: 0;
  -webkit-font-smoothing: antialiased;
}
</style>