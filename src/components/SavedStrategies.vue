<!-- views/SavedRecommendations.vue -->
<template>
  <div class="min-h-screen bg-[#f8f9fa] font-['Inter'] lg:flex">
    <!-- Sidebar Component -->
    <Sidebar
      :nav-items="navItems"
      :mobile-menu-open="mobileMenuOpen"
      :is-saving="isSaving"
      :active-nav-name="'Saved Strategies'"
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
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Saved Investment Strategies</h1>
            <p class="text-gray-500 text-sm mt-1">Your personalized AI-generated investment plans</p>
          </div>
          <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-end">
            <button 
              @click="refreshStrategies"
              :disabled="loading"
              class="flex items-center gap-2 text-sm font-medium px-3 py-2 rounded-lg border border-gray-300 hover:border-[#800000] hover:text-[#800000] transition-colors"
            >
              <i class="fas fa-redo" :class="{ 'fa-spin': loading }"></i>
              Refresh
            </button>
            
            <div class="text-right hidden sm:block">
              <p class="font-medium text-sm text-gray-900">{{ Udetails?.name || 'User' }}</p>
            </div>
            <img src="https://i.pravatar.cc/150?u=alex" 
                 alt="Profile"
                 class="w-10 h-10 rounded-full border-2 border-white shadow" />
          </div>
        </header>

        <!-- Loading State -->
        <div v-if="loading" class="space-y-6">
          <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <div class="flex items-center justify-center mb-6">
              <div class="relative">
                <div class="w-16 h-16 border-4 border-gray-200 border-t-[#800000] rounded-full animate-spin"></div>
                <i class="fas fa-brain text-[#800000] text-xl absolute inset-0 m-auto"></i>
              </div>
            </div>
            <div class="text-center space-y-4">
              <h3 class="text-xl font-bold text-gray-900">Loading your saved strategies...</h3>
              <p class="text-gray-500">Fetching your personalized investment plans</p>
            </div>
            
            <!-- Skeleton cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
              <div v-for="n in 3" :key="n" class="bg-gray-50 rounded-xl p-6 animate-pulse">
                <div class="h-4 bg-gray-200 rounded mb-4"></div>
                <div class="h-3 bg-gray-200 rounded mb-2"></div>
                <div class="h-3 bg-gray-200 rounded mb-6 w-3/4"></div>
                <div class="space-y-2">
                  <div class="h-2 bg-gray-200 rounded"></div>
                  <div class="h-2 bg-gray-200 rounded w-5/6"></div>
                  <div class="h-2 bg-gray-200 rounded w-2/3"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-else-if="savedStrategies.length === 0 && !loading" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 lg:p-12">
          <div class="text-center space-y-6">
            <div class="w-20 h-20 bg-gradient-to-br from-[#800000]/10 to-[#800000]/5 rounded-full flex items-center justify-center mx-auto">
              <i class="fas fa-bookmark text-[#800000] text-3xl"></i>
            </div>
            <div class="space-y-3">
              <h3 class="text-xl font-bold text-gray-900">No saved strategies yet</h3>
              <p class="text-gray-600 max-w-md mx-auto">You haven't saved any investment strategies yet. Get personalized recommendations from our AI assistant.</p>
            </div>
            <router-link to="/recommend" class="inline-flex items-center gap-2 bg-[#800000] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#600000] transition-all">
              <i class="fas fa-brain"></i>
              Get AI Recommendations
            </router-link>
          </div>
        </div>

        <!-- Saved Strategies Grid -->
        <div v-else class="space-y-6">
          <!-- Filters -->
          <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center justify-between bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <div class="flex items-center gap-3">
              <button 
                @click="activeFilter = 'all'"
                :class="[
                  'px-4 py-2 rounded-lg text-sm font-medium transition-colors',
                  activeFilter === 'all' ? 'bg-[#800000] text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                ]"
              >
                All ({{ savedStrategies.length }})
              </button>
                          </div>


          <!-- Strategies Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div 
              v-for="strategy in filteredStrategies" 
              :key="strategy.id"
              class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden"
            >
              <!-- Strategy Header -->
              <div :class="[
                'p-4 border-b',
                getRiskLevelClass(strategy.risk_level).border
              ]">
                <div class="flex items-center justify-between mb-2">
                  <div class="flex items-center gap-2">
                    <span :class="[
                      'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold',
                      getRiskLevelClass(strategy.risk_level).badge
                    ]">
                      <i :class="getRiskLevelClass(strategy.risk_level).icon" class="mr-1"></i>
                      {{ strategy.risk_level }}
                    </span>
                    <span v-if="strategy.is_recommended" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                      <i class="fas fa-star mr-1 text-xs"></i>
                      Recommended
                    </span>
                  </div>
                  <div class="flex items-center gap-2">
                    <button 
                      @click="deleteStrategy(strategy.id)"
                      class="text-gray-400 hover:text-red-500 p-1"
                      title="Delete strategy"
                    >
                      <i class="fas fa-trash text-sm"></i>
                    </button>
                  </div>
                </div>
                <h3 class="font-bold text-gray-900 text-lg">{{ strategy.strategy_name }}</h3>
                <p class="text-gray-600 text-xs mt-1">
                  Saved {{ formatDate(strategy.created_at) }}
                </p>
              </div>

              <!-- Strategy Content -->
              <div class="p-4">
                <p class="text-gray-700 text-sm mb-4">{{ strategy.description }}</p>
                
                <div class="mb-4">
                  <p class="text-sm font-medium text-gray-900 mb-2">Asset Allocation</p>
                  <div class="space-y-2">
                    <div v-for="(asset, index) in getAssetAllocationPreview(strategy.asset_allocation)" 
                         :key="index"
                         class="space-y-1">
                      <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-600 truncate">{{ asset.asset }}</span>
                        <span class="text-xs font-semibold text-gray-900">{{ asset.percentage }}%</span>
                      </div>
                      <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div :class="[
                          'h-1.5 rounded-full',
                          getRiskLevelClass(strategy.risk_level).barColor
                        ]" :style="{ width: asset.percentage + '%' }"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Form Data Summary -->
                <div v-if="strategy.form_data" class="mb-4 p-3 bg-gray-50 rounded-lg">
                  <p class="text-xs font-medium text-gray-900 mb-2">Based on your profile:</p>
                  <div class="grid grid-cols-2 gap-2">
                    <div class="text-xs">
                      <span class="text-gray-500">Amount:</span>
                      <span class="font-medium text-gray-900 ml-1">${{ strategy.form_data.amount?.toLocaleString() || 'N/A' }}</span>
                    </div>
                    <div class="text-xs">
                      <span class="text-gray-500">Goal:</span>
                      <span class="font-medium text-gray-900 ml-1">{{ formatGoal(strategy.form_data.goal) }}</span>
                    </div>
                    <div class="text-xs">
                      <span class="text-gray-500">Risk:</span>
                      <span class="font-medium text-gray-900 ml-1">{{ strategy.form_data.riskTolerance || 'N/A' }}/10</span>
                    </div>
                    <div class="text-xs">
                      <span class="text-gray-500">Experience:</span>
                      <span class="font-medium text-gray-900 ml-1 capitalize">{{ strategy.form_data.experience || 'N/A' }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Strategy Footer -->
              <div class="p-4 border-t border-gray-100 bg-gray-50">
                <div class="flex justify-between items-center">
                  <button 
                    @click="viewStrategyDetails(strategy)"
                    class="text-sm font-medium text-[#800000] hover:text-[#600000] flex items-center gap-1"
                  >
                    <i class="fas fa-eye"></i>
                    View Details
                  </button>
                  <button 
                    @click="applyStrategy(strategy)"
                    :class="[
                      'px-4 py-2 rounded-lg text-sm font-medium transition-colors',
                      getRiskLevelClass(strategy.risk_level).button
                    ]"
                  >
                    Apply Strategy
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Pagination -->
          <div v-if="filteredStrategies.length > 0" class="flex items-center justify-between bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
            <div class="text-sm text-gray-600">
              Showing {{ Math.min((currentPage - 1) * itemsPerPage + 1, filteredStrategies.length) }}-{{ Math.min(currentPage * itemsPerPage, filteredStrategies.length) }} of {{ filteredStrategies.length }} strategies
            </div>
            <div class="flex gap-2">
              <button 
                @click="prevPage"
                :disabled="currentPage === 1"
                class="px-3 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <i class="fas fa-chevron-left"></i>
              </button>
              <button 
                v-for="page in totalPages"
                :key="page"
                @click="currentPage = page"
                :class="[
                  'px-3 py-2 rounded-lg text-sm font-medium',
                  currentPage === page ? 'bg-[#800000] text-white' : 'border border-gray-300 text-gray-700 hover:bg-gray-50'
                ]"
              >
                {{ page }}
              </button>
              <button 
                @click="nextPage"
                :disabled="currentPage === totalPages"
                class="px-3 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Strategy Details Modal -->
        <div v-if="selectedStrategy" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
          <div class="bg-white rounded-2xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-white border-b border-gray-200 p-6 flex items-center justify-between">
              <div>
                <h2 class="text-xl font-bold text-gray-900">{{ selectedStrategy.strategy_name }}</h2>
                <p class="text-gray-600 text-sm">Saved {{ formatDate(selectedStrategy.created_at) }}</p>
              </div>
              <button @click="selectedStrategy = null" class="text-gray-400 hover:text-gray-600 p-2">
                <i class="fas fa-times text-xl"></i>
              </button>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
              <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-6">
                  <!-- Description -->
                  <div class="bg-white p-4 rounded-xl border border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-3">Strategy Description</h3>
                    <p class="text-gray-700">{{ selectedStrategy.description }}</p>
                  </div>

                  <!-- Asset Allocation Details -->
                  <div class="bg-white p-4 rounded-xl border border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-4">Detailed Asset Allocation</h3>
                    <div class="space-y-4">
                      <div v-for="(asset, index) in JSON.parse(selectedStrategy.asset_allocation)" 
                           :key="index"
                           class="space-y-2">
                        <div class="flex justify-between items-center">
                          <span class="font-medium text-gray-900">{{ asset.asset }}</span>
                          <span :class="[
                            'font-bold',
                            getRiskLevelClass(selectedStrategy.risk_level).textColor
                          ]">{{ asset.percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                          <div :class="[
                            'h-3 rounded-full',
                            getRiskLevelClass(selectedStrategy.risk_level).barColor
                          ]" :style="{ width: asset.percentage + '%' }"></div>
                        </div>
                        <p class="text-gray-600 text-xs">{{ getAssetDescription(asset.asset) }}</p>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                  <!-- Strategy Info -->
                  <div class="bg-white p-4 rounded-xl border border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-4">Strategy Information</h3>
                    <div class="space-y-3">
                      <div>
                        <p class="text-xs text-gray-500">Risk Level</p>
                        <p class="font-medium text-gray-900">{{ selectedStrategy.risk_level }}</p>
                      </div>
                      <div>
                        <p class="text-xs text-gray-500">Suitable For</p>
                        <p class="font-medium text-gray-900">{{ selectedStrategy.suitable_for }}</p>
                      </div>
                      <div>
                        <p class="text-xs text-gray-500">AI Recommended</p>
                        <p class="font-medium" :class="selectedStrategy.is_recommended ? 'text-green-600' : 'text-gray-900'">
                          {{ selectedStrategy.is_recommended ? 'Yes' : 'No' }}
                        </p>
                      </div>
                    </div>
                  </div>

                  <!-- Original Form Data -->
                  <div v-if="selectedStrategy.form_data" class="bg-white p-4 rounded-xl border border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-4">Original Profile</h3>
                    <div class="space-y-2">
                      <div class="flex justify-between">
                        <span class="text-xs text-gray-600">Investment Amount:</span>
                        <span class="text-xs font-medium text-gray-900">${{ JSON.parse(selectedStrategy.form_data).amount?.toLocaleString() }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-xs text-gray-600">Investment Goal:</span>
                        <span class="text-xs font-medium text-gray-900">{{ formatGoal(JSON.parse(selectedStrategy.form_data).goal) }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-xs text-gray-600">Risk Tolerance:</span>
                        <span class="text-xs font-medium text-gray-900">{{ JSON.parse(selectedStrategy.form_data).riskTolerance }}/10</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-xs text-gray-600">Time Horizon:</span>
                        <span class="text-xs font-medium text-gray-900">{{ formatTimeHorizon(JSON.parse(selectedStrategy.form_data).timeHorizon) }}</span>
                      </div>
                    </div>
                  </div>

                  <!-- Action Buttons -->
                  <div class="space-y-3">
                    <button 
                      @click="applyStrategy(selectedStrategy)"
                      :class="[
                        'w-full py-3 rounded-lg text-white font-medium transition-colors',
                        getRiskLevelClass(selectedStrategy.risk_level).button
                      ]"
                    >
                      <i class="fas fa-check-circle mr-2"></i>
                      Apply This Strategy
                    </button>
                    <button 
                      @click="deleteStrategy(selectedStrategy.id)"
                      class="w-full py-3 rounded-lg border border-red-300 text-red-600 font-medium hover:bg-red-50 transition-colors"
                    >
                      <i class="fas fa-trash mr-2"></i>
                      Delete Strategy
                    </button>
                    <button 
                      @click="selectedStrategy = null"
                      class="w-full py-3 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors"
                    >
                      Close
                    </button>
                  </div>
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
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import SideBar from './SideBar.vue'
import { getUserProfile } from '../utils/getUserDetails'

const router = useRouter()
const Udetails = ref(null)
const mobileMenuOpen = ref(false)
const isSaving = ref(false)

// Data
const savedStrategies = ref([])
const loading = ref(true)
const searchQuery = ref('')
const activeFilter = ref('all')
const currentPage = ref(1)
const itemsPerPage = 6
const selectedStrategy = ref(null)

// Navigation items
const navItems = ref([
  { name: 'Dashboard', icon: 'fas fa-home', route: '/dashboard' },
  { name: 'Saved Strategies', icon: 'fas fa-bookmark', route: '/saved' },
  { name: 'AI Recommendations', icon: 'fas fa-brain', route: '/recommend' },
  { name: 'Portfolio', icon: 'fas fa-chart-line', route: '/portfolio' },
  { name: 'Goals', icon: 'fas fa-bullseye', route: '/goals' },
  { name: 'Analytics', icon: 'fas fa-chart-bar', route: '/analytics' }
])

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
const recommendedCount = computed(() => {
  return savedStrategies.value.filter(s => s.is_recommended).length
})

const latestDate = computed(() => {
  if (savedStrategies.value.length === 0) return 'N/A'
  const latest = savedStrategies.value.reduce((latest, current) => {
    return new Date(current.created_at) > new Date(latest.created_at) ? current : latest
  })
  return formatDateShort(latest.created_at)
})

const filteredStrategies = computed(() => {
  let filtered = [...savedStrategies.value]

  // Apply search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(strategy => 
      strategy.strategy_name.toLowerCase().includes(query) ||
      strategy.description.toLowerCase().includes(query) ||
      strategy.risk_level.toLowerCase().includes(query)
    )
  }

  // Apply active filter
  if (activeFilter.value === 'recommended') {
    filtered = filtered.filter(strategy => strategy.is_recommended)
  }

  return filtered
})

const totalPages = computed(() => {
  return Math.ceil(filteredStrategies.value.length / itemsPerPage)
})

const paginatedStrategies = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredStrategies.value.slice(start, end)
})

// Helper functions
const getRiskLevelClass = (riskLevel) => {
  const level = riskLevel.toLowerCase()
  if (level.includes('low') || level.includes('conservative')) {
    return {
      badge: 'bg-green-100 text-green-800',
      border: 'border-green-200',
      barColor: 'bg-green-500',
      button: 'bg-green-600 hover:bg-green-700 text-white',
      textColor: 'text-green-600',
      icon: 'fas fa-shield-alt'
    }
  } else if (level.includes('medium') || level.includes('balanced')) {
    return {
      badge: 'bg-blue-100 text-blue-800',
      border: 'border-blue-200',
      barColor: 'bg-blue-500',
      button: 'bg-blue-600 hover:bg-blue-700 text-white',
      textColor: 'text-blue-600',
      icon: 'fas fa-balance-scale'
    }
  } else if (level.includes('high') || level.includes('aggressive')) {
    return {
      badge: 'bg-orange-100 text-orange-800',
      border: 'border-orange-200',
      barColor: 'bg-orange-500',
      button: 'bg-orange-600 hover:bg-orange-700 text-white',
      textColor: 'text-orange-600',
      icon: 'fas fa-chart-line'
    }
  }
  return {
    badge: 'bg-gray-100 text-gray-800',
    border: 'border-gray-200',
    barColor: 'bg-gray-500',
    button: 'bg-gray-600 hover:bg-gray-700 text-white',
    textColor: 'text-gray-600',
    icon: 'fas fa-chart-pie'
  }
}

const getAssetAllocationPreview = (allocation) => {
  const assets = JSON.parse(allocation || '[]')
  return assets.slice(0, 3) // Show first 3 assets
}

const getAssetDescription = (asset) => {
  const descriptions = {
    'Bonds & Fixed Income': 'Low-risk, stable returns',
    'Blue-chip Stocks': 'Established, dividend-paying companies',
    'Global Stocks': 'Diversified international exposure',
    'Growth Stocks': 'High-growth potential companies',
    'Tech & Innovation': 'Technology and innovative sectors',
    'Emerging Markets': 'High-growth developing markets'
  }
  return descriptions[asset] || 'Investment asset'
}

const formatDate = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric' 
  })
}

const formatDateShort = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleDateString('en-US', { 
    month: 'short', 
    day: 'numeric',
    year: 'numeric'
  })
}

const formatGoal = (goal) => {
  const goals = {
    'retirement': 'Retirement',
    'growth': 'Wealth Growth',
    'education': 'Education',
    'home': 'Home Purchase',
    'emergency': 'Emergency Fund',
    'other': 'Other'
  }
  return goals[goal] || goal || 'N/A'
}

const formatTimeHorizon = (horizon) => {
  const horizons = {
    'short': 'Short-term (< 3 years)',
    'medium': 'Medium-term (3-7 years)',
    'long': 'Long-term (> 7 years)'
  }
  return horizons[horizon] || horizon || 'N/A'
}

// Methods
const handleNavClick = (item) => {
  if (item.route) {
    router.push(item.route)
  }
}

const handleSettingsClick = () => {
  router.push('/settings')
}

const fetchSavedStrategies = async () => {
  loading.value = true
  try {
    const userData = JSON.parse(localStorage.getItem('userData') || '{}')
    
    const response = await fetch(`${import.meta.env.VITE_API_BASE_URL}/code/strategies/get.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ user_id: userData.id })
    })
    
    const data = await response.json()
    
    if (data.success) {
      savedStrategies.value = data.strategies || []
    } else {
      console.error('Failed to fetch strategies:', data.message)
    }
  } catch (error) {
    console.error('Error fetching strategies:', error)
  } finally {
    loading.value = false
  }
}

const refreshStrategies = async () => {
  await fetchSavedStrategies()
}

const viewStrategyDetails = (strategy) => {
  selectedStrategy.value = strategy
}

const applyStrategy = async (strategy) => {
  // Show confirmation
  if (confirm(`Apply "${strategy.strategy_name}" strategy to your portfolio?`)) {
    try {
      const response = await fetch(`${import.meta.env.VITE_API_BASE_URL}/code/strategies/apply.php`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          strategy_id: strategy.id,
          user_id: Udetails.value?.id
        })
      })
      
      const data = await response.json()
      
      if (data.success) {
        alert('Strategy applied successfully!')
        // Optional: Navigate to portfolio or refresh
      } else {
        alert(data.message || 'Failed to apply strategy')
      }
    } catch (error) {
      console.error('Error applying strategy:', error)
      alert('Failed to apply strategy. Please try again.')
    }
  }
}

const deleteStrategy = async (strategyId) => {
  if (!confirm('Are you sure you want to delete this strategy? This action cannot be undone.')) {
    return
  }
  
  try {
    const response = await fetch(`${import.meta.env.VITE_API_BASE_URL}/code/strategies/delete.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        strategy_id: strategyId,
        user_id: Udetails.value?.id
      })
    })
    
    const data = await response.json()
    
    if (data.success) {
      // Remove from local array
      savedStrategies.value = savedStrategies.value.filter(s => s.id !== strategyId)
      
      // Close modal if open
      if (selectedStrategy.value?.id === strategyId) {
        selectedStrategy.value = null
      }
      
      alert('Strategy deleted successfully!')
    } else {
      alert(data.message || 'Failed to delete strategy')
    }
  } catch (error) {
    console.error('Error deleting strategy:', error)
    alert('Failed to delete strategy. Please try again.')
  }
}

const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--
  }
}

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++
  }
}

// Lifecycle hooks
onMounted(async () => {
  Udetails.value = await getUserProfile()
  await fetchSavedStrategies()
})
</script>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

/* Custom scrollbar for modal */
.modal-content {
  scrollbar-width: thin;
  scrollbar-color: #800000 #f1f1f1;
}

.modal-content::-webkit-scrollbar {
  width: 8px;
}

.modal-content::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 4px;
}

.modal-content::-webkit-scrollbar-thumb {
  background: #800000;
  border-radius: 4px;
}
</style>