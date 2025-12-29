<template>
  <div class="flex min-h-screen bg-[#f8f9fa] font-sans text-[#0a1b2e]">
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col fixed h-full">
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
        <div @click="$router.push('/')" class="flex items-center gap-3 text-gray-400 font-semibold text-sm cursor-pointer hover:text-red-600">
          <i class="fas fa-sign-out-alt"></i> Log out
        </div>
      </div>
    </aside>

    <main class="ml-64 flex-1 p-10">
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

      <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-[24px] border border-gray-50 shadow-sm">
          <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Total Balance</p>
          <p class="text-3xl font-extrabold">$125,430.50</p>
        </div>
        <div class="bg-white p-6 rounded-[24px] border border-gray-50 shadow-sm">
          <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Weekly Change</p>
          <p class="text-3xl font-extrabold text-green-500">+1.25% <span class="text-sm font-normal text-green-400 ml-1">+$1,548.12</span></p>
        </div>
        <div class="bg-white p-6 rounded-[24px] border border-gray-50 shadow-sm">
          <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Monthly Change</p>
          <p class="text-3xl font-extrabold text-green-500">+5.80% <span class="text-sm font-normal text-green-400 ml-1">+$6,890.44</span></p>
        </div>
      </div>

      <div class="grid grid-cols-12 gap-8">
        <div class="col-span-8 space-y-8">
          <div class="bg-white p-8 rounded-[30px] border border-gray-50 shadow-sm">
            <h3 class="font-bold text-lg mb-6">Portfolio Performance</h3>
            <div class="h-48 w-full bg-gradient-to-t from-[#800000]/5 to-transparent rounded-xl flex items-end px-4 gap-2">
              <div v-for="n in 20" :key="n" class="flex-1 bg-[#800000] rounded-t-sm opacity-20" :style="{ height: Math.random() * 80 + '%' }"></div>
            </div>
          </div>

          <div>
            <h3 class="font-bold text-xl mb-6">Your Goals</h3>
            <div class="grid grid-cols-2 gap-6">
              <div v-for="goal in goals" :key="goal.title" class="bg-white p-6 rounded-[24px] border border-gray-50 shadow-sm">
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

        <div class="col-span-4 space-y-8">
          <div class="bg-white p-8 rounded-[30px] border border-gray-50 shadow-sm text-center">
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

          <div class="bg-[#800000]/5 p-8 rounded-[30px] border border-[#800000]/10">
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
const navItems = [
  { name: 'Dashboard', icon: 'fas fa-th-large', active: true },
  { name: 'Portfolio', icon: 'fas fa-briefcase', active: false },
  { name: 'Goals', icon: 'fas fa-bullseye', active: false },
  { name: 'Transactions', icon: 'fas fa-exchange-alt', active: false },
  { name: 'Reports', icon: 'fas fa-file-alt', active: false },
]

const goals = [
  { title: 'House Down Payment', target: '50,000', progress: 75 },
  { title: 'New Car Fund', target: '25,000', progress: 100 },
  { title: 'Retirement Fund', target: '1,000,000', progress: 12 },
]

const insights = [
  { title: 'Market Opportunity', desc: 'The tech sector shows strong growth potential. Consider rebalancing.' },
  { title: 'Goal Progress', desc: 'You are 95% on track for your "House Down Payment" goal.' }
]
</script>