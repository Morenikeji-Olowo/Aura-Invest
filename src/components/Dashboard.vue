<!-- Dashboard.vue (Updated) -->
<template>
  <div class="min-h-screen bg-[#f8f9fa] font-['Inter'] lg:flex">
    <!-- Reusable Sidebar Component -->
    <Sidebar
      :nav-items="navItems"
      :mobile-menu-open="mobileMenuOpen"
      :is-saving="isSaving"
      :active-nav-name="'Dashboard'"
      @toggle-mobile-menu="mobileMenuOpen = !mobileMenuOpen"
      @nav-click="handleNavClick"
      @settings-click="handleSettingsClick"
      @logout="logout"
    />

    <!-- Main content area -->
    <main class="min-h-screen bg-[#f8f9fa] transition-all duration-300 overflow-x-hidden flex-1 lg:ml-64">
      <div class="p-4 sm:p-6 lg:p-8 pt-16 lg:pt-8">
        <!-- Header -->
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
          <div class="w-full">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Welcome back, {{ Udetails.name }}</h1>
            <p class="text-gray-500 text-sm mt-1">Here is your investment progress summary.</p>

            <!-- Mobile CTA: Let AI Recommend (visible only on small screens) -->
            <div class="mt-3 sm:hidden">
              <router-link to="/recommend" class="w-full block bg-[#800000] text-white px-4 py-2 rounded-lg font-medium text-sm hover:bg-[#600000] transition-all text-center">
                Let AI Recommend
              </router-link>
            </div>
          </div>
          <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-end">
            <!-- Desktop CTA: Let AI Recommend (hidden on small screens) -->
            <router-link to="/recommend" class="hidden sm:inline-flex bg-[#800000] text-white px-3 py-2 rounded-lg font-medium text-sm hover:bg-[#600000] transition-all">
              Let AI Recommend
            </router-link>

            <div class="text-right hidden sm:block">
              <p class="font-medium text-sm text-gray-900">{{Udetails.name}}</p>
            </div>
            <img src="https://i.pravatar.cc/150?u=alex" 
                 alt="Profile"
                 class="w-10 h-10 rounded-full border-2 border-white shadow" />
          </div>
        </header>

        <!-- Top Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
          <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-2">Total Balance</p>
            <p class="text-2xl sm:text-3xl font-bold text-gray-900">$125,430.50</p>
            <p class="text-gray-400 text-xs mt-1">Updated today</p>
          </div>
          <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-2">Weekly Change</p>
            <p class="text-2xl sm:text-3xl font-bold text-green-600">+1.25%</p>
            <p class="text-green-500 text-sm mt-1">+$1,548.12</p>
          </div>
          <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-2">Monthly Change</p>
            <p class="text-2xl sm:text-3xl font-bold text-green-600">+5.80%</p>
            <p class="text-green-500 text-sm mt-1">+$6,890.44</p>
          </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
          <!-- Left Column (2/3 on large screens) -->
          <div class="xl:col-span-2 space-y-6">
            <!-- Portfolio Chart -->
            <div class="bg-white p-4 sm:p-6 rounded-xl border border-gray-200 shadow-sm">
              <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                <h3 class="text-lg font-semibold text-gray-900">Portfolio Performance</h3>
                <div class="flex gap-1 w-full sm:w-auto overflow-x-auto">
                  <button class="text-xs px-3 py-1.5 rounded-lg text-gray-500 hover:bg-gray-50 whitespace-nowrap">1W</button>
                  <button class="text-xs px-3 py-1.5 rounded-lg text-gray-500 hover:bg-gray-50 whitespace-nowrap">1M</button>
                  <button class="text-xs px-3 py-1.5 rounded-lg bg-[#800000]/10 text-[#800000] font-medium whitespace-nowrap">3M</button>
                  <button class="text-xs px-3 py-1.5 rounded-lg text-gray-500 hover:bg-gray-50 whitespace-nowrap">1Y</button>
                  <button class="text-xs px-3 py-1.5 rounded-lg text-gray-500 hover:bg-gray-50 whitespace-nowrap">All</button>
                </div>
              </div>
              <div class="h-48 w-full bg-gradient-to-t from-[#800000]/5 to-transparent rounded-lg flex items-end px-2 gap-1">
                <div v-for="n in 12" :key="n" 
                     class="flex-1 bg-[#800000] rounded-t-sm opacity-20" 
                     :style="{ height: Math.random() * 80 + 20 + '%' }"></div>
              </div>
            </div>

            <!-- Goals Section -->
            <div>
              <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                <h3 class="text-lg font-semibold text-gray-900">Your Goals</h3>
                <button class="text-sm font-medium text-[#800000] px-4 py-2 rounded-lg border border-[#800000]/20 hover:bg-[#800000]/5 whitespace-nowrap w-full sm:w-auto">
                  <i class="fas fa-plus mr-2"></i>Add New Goal
                </button>
              </div>
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="goal in goals" :key="goal.title" 
                     class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                  <div class="flex justify-between mb-3">
                    <span class="font-medium text-gray-900 text-sm">{{ goal.title }}</span>
                    <span class="text-[#800000] font-semibold text-sm">{{ goal.progress }}%</span>
                  </div>
                  <div class="w-full h-2 bg-gray-100 rounded-full mb-3 overflow-hidden">
                    <div class="h-full bg-[#800000] rounded-full" 
                         :style="{ width: goal.progress + '%' }"></div>
                  </div>
                  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                    <span class="text-gray-500 text-xs">Target: ${{ goal.target.toLocaleString() }}</span>
                    <button class="text-xs font-medium border border-gray-300 px-3 py-1.5 rounded-lg hover:bg-gray-50 w-full sm:w-auto">
                      Top Up
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Right Column (1/3 on large screens) -->
          <div class="space-y-6">
            <!-- Asset Allocation -->
            <div class="bg-white p-4 sm:p-6 rounded-xl border border-gray-200 shadow-sm">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">Asset Allocation</h3>
              <div class="w-32 h-32 mx-auto mb-4 relative">
                <div class="w-full h-full rounded-full border-[12px] border-[#800000] border-l-gray-200 border-b-gray-400 flex items-center justify-center">
                  <span class="font-bold text-gray-900">100%</span>
                </div>
              </div>
              <div class="space-y-2">
                <div class="flex justify-between items-center p-2 rounded-lg hover:bg-gray-50">
                  <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-[#800000]"></div>
                    <span class="text-gray-700 text-sm">Stocks</span>
                  </div>
                  <span class="font-semibold text-gray-900">60%</span>
                </div>
                <div class="flex justify-between items-center p-2 rounded-lg hover:bg-gray-50">
                  <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                    <span class="text-gray-700 text-sm">Bonds</span>
                  </div>
                  <span class="font-semibold text-gray-900">25%</span>
                </div>
                <div class="flex justify-between items-center p-2 rounded-lg hover:bg-gray-50">
                  <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-gray-300"></div>
                    <span class="text-gray-700 text-sm">Crypto</span>
                  </div>
                  <span class="font-semibold text-gray-900">15%</span>
                </div>
              </div>
            </div>

            <!-- AI Insights -->
            <div class="bg-[#800000]/5 p-4 sm:p-6 rounded-xl border border-[#800000]/10">
              <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-lightbulb text-[#800000]"></i>AI Insights
              </h3>
              <div class="space-y-3">
                <div v-for="insight in insights" :key="insight.title" 
                     class="bg-white p-3 rounded-lg shadow-sm">
                  <p class="font-medium text-gray-900 text-sm mb-1">{{ insight.title }}</p>
                  <p class="text-gray-500 text-xs">{{ insight.desc }}</p>
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
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import Sidebar from '@/components/Sidebar.vue'
import { getUserProfile } from '../utils/getUserDetails'

const router = useRouter()
const Udetails = ref(null)
const isSaving = ref(false)
const mobileMenuOpen = ref(false)

onMounted(async () => {
  Udetails.value = await getUserProfile()
})

// Navigation items
const navItems = ref([
  { name: 'Dashboard', icon: 'fas fa-home', route: '/dashboard' },
  { name: 'Portfolio', icon: 'fas fa-chart-line', route: '/portfolio' },
  { name: 'Transactions', icon: 'fas fa-exchange-alt', route: '/transactions' },
  { name: 'Goals', icon: 'fas fa-bullseye', route: '/goals' },
  { name: 'Analytics', icon: 'fas fa-chart-bar', route: '/analytics' }
])

// Goals data
const goals = [
  { title: 'Retirement Fund', progress: 75, target: 50000 },
  { title: 'Vacation Fund', progress: 50, target: 10000 },
  { title: 'Emergency Fund', progress: 90, target: 15000 }
]

// AI Insights data
const insights = [
  { title: 'Market Trends', desc: 'The stock market is expected to rise in the next quarter.' },
  { title: 'Risk Assessment', desc: 'Your portfolio has a moderate risk level.' },
  { title: 'Performance Forecast', desc: 'Projected 5% growth in the next year.' }
]

// Navigation click handler
const handleNavClick = (item) => {
  if (item.route) {
    router.push(item.route)
  }
}

// Settings click handler
const handleSettingsClick = () => {
  router.push('/settings')
}

const logout = async () => {  
  isSaving.value = true
  try {
    const response = await fetch(`${import.meta.env.VITE_API_BASE_URL}/code/auth/logout.php`, {
      method: 'POST',
      credentials: 'include',
    })

    if (response.ok) {
      console.log('Logout successful')
      localStorage.clear()
      window.location.reload()
    } else {
      console.error('Logout failed')
    }
  } catch (error) {
    console.error('Error during logout:', error)
  } finally {
    isSaving.value = false
  }
}
</script>
<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

@media (max-width: 640px) {
  .sm\:grid-cols-3 {
    grid-template-columns: 1fr;
  }
  
  .xl\:col-span-2 {
    grid-column: span 1;
  }
  
  .xl\:col-span-3 {
    grid-column: span 1;
  }
}
</style>