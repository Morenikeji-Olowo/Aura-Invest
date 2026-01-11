<!-- components/Sidebar.vue -->
<template>
  <div>
    <!-- Mobile header (only on mobile) -->
    <div v-if="showMobileHeader" class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-100 px-4 py-3 shadow-sm">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-[#800000] font-bold text-lg">
          <i :class="logoIcon"></i>
          <span class="truncate">{{ appName }}</span>
        </div>
        <button @click="$emit('toggle-mobile-menu')" class="p-2 hover:bg-gray-50 rounded-lg">
          <i :class="mobileMenuOpen ? 'fas fa-times' : 'fas fa-bars'" class="text-gray-600 text-lg"></i>
        </button>
      </div>
    </div>

    <!-- Mobile menu overlay -->
    <div v-if="mobileMenuOpen && showMobileHeader" 
         @click="$emit('toggle-mobile-menu')"
         class="lg:hidden fixed inset-0 z-40 bg-black bg-opacity-50 transition-all duration-300">
    </div>

    <!-- Sidebar (hidden on mobile, shown on desktop) -->
    <aside :class="[
      'bg-white border-r border-gray-100 flex flex-col shrink-0 transition-transform duration-300 ease-in-out h-screen fixed lg:static z-40 overflow-y-auto',
      'w-64',
      mobileMenuOpen || !showMobileHeader ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
    ]">
      <div class="p-4 lg:p-6">
        <div class="flex items-center justify-between lg:justify-start gap-2 text-[#800000] font-bold text-xl mb-8">
          <div class="flex items-center gap-2">
            <i :class="logoIcon"></i>
            <span>{{ appName }}</span>
          </div>
          <button v-if="showMobileHeader" @click="$emit('toggle-mobile-menu')" class="lg:hidden p-2 hover:bg-gray-50 rounded-lg">
            <i class="fas fa-times text-gray-600"></i>
          </button>
        </div>

        <nav class="space-y-1">
          <div v-for="item in navItems" :key="item.name" 
            @click="$emit('nav-click', item); showMobileHeader && $emit('toggle-mobile-menu')"
            :class="[
              'flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer transition-all font-medium text-sm',
              isActive(item) ? 'bg-[#800000]/10 text-[#800000]' : 'text-gray-600 hover:bg-gray-50'
            ]"
          >
            <i :class="[item.icon, 'w-5 text-center text-sm']"></i>
            <span class="truncate">{{ item.name }}</span>
          </div>
        </nav>
      </div>

      <div class="mt-4 lg:mt-auto p-4 lg:p-6 border-t border-gray-50 space-y-1">
        <div @click="$emit('settings-click')" class="flex items-center gap-3 text-gray-600 font-medium text-sm cursor-pointer hover:bg-gray-50 px-4 py-3 rounded-lg transition-all">
          <i class="fas fa-cog w-5 text-center text-sm"></i>
          <span class="truncate">Settings</span>
        </div>

        <button 
          @click="$emit('logout')"
          :disabled="isSaving"
          class="flex items-center gap-3 text-gray-600 font-medium text-sm cursor-pointer hover:bg-gray-50 disabled:opacity-50 w-full px-4 py-3 rounded-lg transition-all text-left"
        >
          <i class="fas fa-sign-out-alt w-5 text-center text-sm"></i>
          <span class="truncate">Logout</span>
        </button>
      </div>
    </aside>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  // Required props
  navItems: {
    type: Array,
    required: true,
    default: () => []
  },
  
  // Optional props with defaults
  appName: {
    type: String,
    default: 'Aura-Invest'
  },
  
  logoIcon: {
    type: String,
    default: 'fas fa-chart-pie'
  },
  
  mobileMenuOpen: {
    type: Boolean,
    default: false
  },
  
  showMobileHeader: {
    type: Boolean,
    default: true
  },
  
  isSaving: {
    type: Boolean,
    default: false
  },
  
  activeNavName: {
    type: String,
    default: ''
  }
})

const emit = defineEmits([
  'toggle-mobile-menu',
  'nav-click',
  'settings-click',
  'logout'
])

// Helper function to check if a nav item is active
const isActive = (item) => {
  if (props.activeNavName) {
    return item.name === props.activeNavName
  }
  return item.active || false
}
</script>