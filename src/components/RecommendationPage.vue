<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 font-['Inter']">
    <!-- Mobile header -->
    <div class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-sm border-b border-gray-200 px-4 py-3 shadow-sm">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-[#800000] font-bold text-lg">
          <i class="fas fa-brain"></i>
          <span>AI Investment Assistant</span>
        </div>
        <div class="flex items-center gap-3">
          <button @click="resetForm" class="text-gray-500 hover:text-[#800000] text-sm font-medium px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
            Reset
          </button>
        </div>
      </div>
    </div>

    <!-- Desktop header -->
    <div class="hidden lg:flex items-center justify-between px-8 py-6 border-b border-gray-200 bg-white">
      <div class="flex items-center gap-3">
        <div class="flex items-center gap-2 text-[#800000] font-bold text-xl">
          <i class="fas fa-brain"></i>
          <span>AI Investment Assistant</span>
        </div>
        <div class="text-gray-500 text-sm ml-6">
          Your personal guide to smarter investing
        </div>
      </div>
      <div class="flex items-center gap-4">
        <button @click="resetForm" class="text-gray-600 hover:text-[#800000] text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
          <i class="fas fa-redo mr-2"></i>Start Over
        </button>
        <button @click="$router.push('/dashboard')" class="text-sm font-medium px-4 py-2 rounded-lg border border-gray-300 hover:border-[#800000] hover:text-[#800000] transition-colors">
          <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
        </button>
      </div>
    </div>

    <!-- Main content -->
    <div class="pt-16 lg:pt-0">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-10">
        <!-- Step indicator for mobile -->
        <div class="lg:hidden mb-6">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-900">Step {{ currentStep }} of {{ totalSteps }}</h2>
            <span class="text-sm text-gray-500">{{ stepTitle }}</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-[#800000] h-2 rounded-full transition-all duration-300" 
                 :style="{ width: `${(currentStep / totalSteps) * 100}%` }"></div>
          </div>
        </div>

        <!-- Main grid -->
        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
          <!-- Left column - Form -->
          <div class="lg:col-span-5 xl:col-span-4" :class="{ 'lg:col-span-12': showResults }">
            <div class="sticky top-20">
              <!-- Step indicator for desktop -->
              <div class="hidden lg:block mb-8">
                <div class="flex items-center justify-between mb-3">
                  <h2 class="text-xl font-bold text-gray-900">Create Your Profile</h2>
                  <span class="text-sm text-gray-500">Step {{ currentStep }} of {{ totalSteps }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="bg-[#800000] h-2 rounded-full transition-all duration-300" 
                       :style="{ width: `${(currentStep / totalSteps) * 100}%` }"></div>
                </div>
              </div>

              <!-- Form container -->
              <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 lg:p-8 mb-6">
                <!-- Step content -->
                <transition name="slide-fade" mode="out-in">
                  <!-- Step 1: Personal Info -->
                  <div v-if="currentStep === 1" key="step1" class="space-y-6">
                    <div>
                      <h3 class="text-lg font-semibold text-gray-900 mb-6">Personal Information</h3>
                      
                      <div class="space-y-5">
                        <!-- Age -->
                        <div>
                          <label class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                          <div class="grid grid-cols-3 gap-3">
                            <button v-for="age in ageOptions" :key="age"
                                    @click="form.age = age"
                                    :class="[
                                      'py-3 px-4 rounded-lg border transition-all text-sm font-medium',
                                      form.age === age 
                                        ? 'border-[#800000] bg-[#800000]/5 text-[#800000]' 
                                        : 'border-gray-300 text-gray-700 hover:border-gray-400'
                                    ]">
                              {{ age }}
                            </button>
                          </div>
                        </div>

                        <!-- Country -->
                        <div>
                          <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                          <select v-model="form.country" 
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#800000] focus:border-[#800000] transition-all text-sm">
                            <option value="">Select your country</option>
                            <option v-for="country in countryOptions" :key="country" :value="country">{{ country }}</option>
                          </select>
                        </div>

                        <!-- Annual Income -->
                        <div>
                          <label class="block text-sm font-medium text-gray-700 mb-2">Annual Income</label>
                          <div class="grid grid-cols-2 gap-3">
                            <button v-for="income in incomeOptions" :key="income.value"
                                    @click="form.income = income.value"
                                    :class="[
                                      'py-3 px-4 rounded-lg border transition-all text-sm font-medium truncate',
                                      form.income === income.value 
                                        ? 'border-[#800000] bg-[#800000]/5 text-[#800000]' 
                                        : 'border-gray-300 text-gray-700 hover:border-gray-400'
                                    ]">
                              {{ income.label }}
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Step 2: Investment Details -->
                  <div v-else-if="currentStep === 2" key="step2" class="space-y-6">
                    <div>
                      <h3 class="text-lg font-semibold text-gray-900 mb-6">Investment Details</h3>
                      
                      <div class="space-y-5">
                        <!-- Investment Amount -->
                        <div>
                          <label class="block text-sm font-medium text-gray-700 mb-2">
                            Investment Amount
                            <span class="text-gray-500 font-normal ml-2">${{ form.amount.toLocaleString() }}</span>
                          </label>
                          <div class="relative pt-1">
                            <input type="range" 
                                   v-model="form.amount"
                                   min="1000" 
                                   max="100000" 
                                   step="1000"
                                   class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider">
                            <div class="flex justify-between text-xs text-gray-500 mt-2">
                              <span>$1K</span>
                              <span>$50K</span>
                              <span>$100K</span>
                            </div>
                          </div>
                        </div>

                        <!-- Investment Goal -->
                        <div>
                          <label class="block text-sm font-medium text-gray-700 mb-2">Primary Investment Goal</label>
                          <div class="grid grid-cols-2 gap-3">
                            <button v-for="goal in goalOptions" :key="goal.value"
                                    @click="form.goal = goal.value"
                                    :class="[
                                      'py-3 px-4 rounded-lg border transition-all text-sm font-medium flex flex-col items-center text-center',
                                      form.goal === goal.value 
                                        ? 'border-[#800000] bg-[#800000]/5 text-[#800000]' 
                                        : 'border-gray-300 text-gray-700 hover:border-gray-400'
                                    ]">
                              <i :class="goal.icon" class="text-lg mb-2"></i>
                              {{ goal.label }}
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Step 3: Risk & Experience -->
                  <div v-else-if="currentStep === 3" key="step3" class="space-y-6">
                    <div>
                      <h3 class="text-lg font-semibold text-gray-900 mb-6">Risk & Experience</h3>
                      
                      <div class="space-y-5">
                        <!-- Risk Tolerance -->
                        <div>
                          <label class="block text-sm font-medium text-gray-700 mb-4">
                            Risk Tolerance
                            <span class="text-gray-500 font-normal ml-2">{{ form.riskTolerance }}</span>
                          </label>
                          <div class="relative pt-1">
                            <input type="range" 
                                   v-model="form.riskTolerance"
                                   min="1" 
                                   max="10" 
                                   step="1"
                                   class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider">
                            <div class="flex justify-between text-xs text-gray-500 mt-2">
                              <span class="text-green-600">Conservative</span>
                              <span class="text-blue-600">Moderate</span>
                              <span class="text-orange-600">Aggressive</span>
                            </div>
                          </div>
                        </div>

                        <!-- Time Horizon -->
                        <div>
                          <label class="block text-sm font-medium text-gray-700 mb-2">Time Horizon</label>
                          <div class="grid grid-cols-3 gap-3">
                            <button v-for="horizon in timeHorizonOptions" :key="horizon.value"
                                    @click="form.timeHorizon = horizon.value"
                                    :class="[
                                      'py-3 px-4 rounded-lg border transition-all text-sm font-medium',
                                      form.timeHorizon === horizon.value 
                                        ? 'border-[#800000] bg-[#800000]/5 text-[#800000]' 
                                        : 'border-gray-300 text-gray-700 hover:border-gray-400'
                                    ]">
                              {{ horizon.label }}
                            </button>
                          </div>
                        </div>

                        <!-- Experience Level -->
                        <div>
                          <label class="block text-sm font-medium text-gray-700 mb-2">Investment Experience</label>
                          <div class="grid grid-cols-3 gap-3">
                            <button v-for="exp in experienceOptions" :key="exp.value"
                                    @click="form.experience = exp.value"
                                    :class="[
                                      'py-3 px-4 rounded-lg border transition-all text-sm font-medium',
                                      form.experience === exp.value 
                                        ? 'border-[#800000] bg-[#800000]/5 text-[#800000]' 
                                        : 'border-gray-300 text-gray-700 hover:border-gray-400'
                                    ]">
                              {{ exp.label }}
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </transition>

                <!-- Navigation buttons -->
                <div class="flex justify-between mt-8 pt-6 border-t border-gray-100">
                  <button v-if="currentStep > 1"
                          @click="prevStep"
                          class="px-6 py-3 rounded-lg border border-gray-300 text-gray-700 hover:border-gray-400 hover:bg-gray-50 transition-all text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                  </button>
                  <div v-else></div>

                  <button v-if="currentStep < totalSteps"
                          @click="nextStep"
                          :disabled="!isStepValid"
                          :class="[
                            'px-6 py-3 rounded-lg transition-all text-sm font-medium',
                            isStepValid 
                              ? 'bg-[#800000] text-white hover:bg-[#600000] shadow-sm hover:shadow'
                              : 'bg-gray-100 text-gray-400 cursor-not-allowed'
                          ]">
                    Continue <i class="fas fa-arrow-right ml-2"></i>
                  </button>

                  <button v-else
                          @click="getRecommendations"
                          :disabled="!isFormComplete"
                          :class="[
                            'px-6 py-3 rounded-lg transition-all text-sm font-medium flex items-center',
                            isFormComplete 
                              ? 'bg-gradient-to-r from-[#800000] to-[#a00000] text-white hover:shadow-lg hover:shadow-[#800000]/20'
                              : 'bg-gray-100 text-gray-400 cursor-not-allowed'
                          ]">
                    <i class="fas fa-brain mr-2"></i>Get My AI Investment Plan
                  </button>
                </div>
              </div>

              <!-- Disclaimer -->
              <div class="text-center text-gray-500 text-xs p-4">
                <p>This tool provides educational recommendations only. Not investment advice. Past performance doesn't guarantee future results.</p>
              </div>
            </div>
          </div>

          <!-- Right column - AI Results -->
          <div class="lg:col-span-7 xl:col-span-8 mt-8 lg:mt-0" :class="{ 'lg:col-span-12': !showResults }">
            <!-- Loading state -->
            <div v-if="loading" class="space-y-6">
              <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                <div class="flex items-center justify-center mb-6">
                  <div class="relative">
                    <div class="w-16 h-16 border-4 border-gray-200 border-t-[#800000] rounded-full animate-spin"></div>
                    <i class="fas fa-brain text-[#800000] text-xl absolute inset-0 m-auto"></i>
                  </div>
                </div>
                <div class="text-center space-y-4">
                  <h3 class="text-xl font-bold text-gray-900">Analyzing your profile...</h3>
                  <p class="text-gray-500">Our AI is creating personalized investment strategies based on your inputs.</p>
                  <div class="flex justify-center gap-2">
                    <div class="w-2 h-2 bg-gray-300 rounded-full animate-pulse" style="animation-delay: 0s"></div>
                    <div class="w-2 h-2 bg-gray-300 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                    <div class="w-2 h-2 bg-gray-300 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
                  </div>
                </div>
                
                <!-- Skeleton cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
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

            <!-- Results state -->
            <div v-else-if="showResults" class="space-y-6">
              <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-8 gap-4">
                  <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Your AI Investment Plan</h2>
                    <p class="text-gray-600">Personalized strategies based on your profile and goals</p>
                  </div>
                  <button @click="showResults = false" 
                          class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:border-[#800000] hover:text-[#800000] transition-colors text-sm font-medium">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                  </button>
                </div>

                <!-- Strategy cards -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                  <!-- Conservative Strategy -->
                  <transition appear @enter="enterAnimation" @leave="leaveAnimation" :css="false" :delay="0">
                    <div class="strategy-card border-2 border-green-100 bg-gradient-to-br from-green-50 to-white hover:shadow-lg transition-all duration-300">
                      <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            <i class="fas fa-shield-alt mr-2"></i>Conservative
                          </span>
                          <span class="text-2xl font-bold text-green-600">Low Risk</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Stability & Growth</h3>
                        <p class="text-gray-600 text-sm mb-6">Prioritizes capital preservation with steady, predictable returns. Ideal for risk-averse investors.</p>
                        
                        <!-- Asset allocation -->
                        <div class="mb-6">
                          <p class="text-sm font-medium text-gray-700 mb-3">Asset Allocation</p>
                          <div class="space-y-2">
                            <div class="flex items-center justify-between">
                              <span class="text-xs text-gray-600">Bonds & Fixed Income</span>
                              <span class="text-sm font-semibold text-green-700">60%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                              <div class="bg-green-500 h-2 rounded-full" style="width: 60%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                              <span class="text-xs text-gray-600">Blue-chip Stocks</span>
                              <span class="text-sm font-semibold text-green-700">30%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                              <div class="bg-green-400 h-2 rounded-full" style="width: 30%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                              <span class="text-xs text-gray-600">Cash & Equivalents</span>
                              <span class="text-sm font-semibold text-green-700">10%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                              <div class="bg-green-300 h-2 rounded-full" style="width: 10%"></div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="pt-4 border-t border-gray-100">
                          <p class="text-xs text-gray-500 mb-2"><strong>Who this is for:</strong> First-time investors, retirees, or those saving for short-term goals.</p>
                          <button class="w-full py-3 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors text-sm font-medium mt-2">
                            Select This Strategy <i class="fas fa-arrow-right ml-2"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </transition>

                  <!-- Balanced Strategy -->
                  <transition appear @enter="enterAnimation" @leave="leaveAnimation" :css="false" :delay="100">
                    <div class="strategy-card border-2 border-blue-100 bg-gradient-to-br from-blue-50 to-white hover:shadow-lg transition-all duration-300">
                      <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                            <i class="fas fa-balance-scale mr-2"></i>Balanced
                          </span>
                          <span class="text-2xl font-bold text-blue-600">Medium Risk</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Growth & Income</h3>
                        <p class="text-gray-600 text-sm mb-6">Balances growth potential with risk management. Diversified across asset classes.</p>
                        
                        <!-- Asset allocation -->
                        <div class="mb-6">
                          <p class="text-sm font-medium text-gray-700 mb-3">Asset Allocation</p>
                          <div class="space-y-2">
                            <div class="flex items-center justify-between">
                              <span class="text-xs text-gray-600">Global Stocks</span>
                              <span class="text-sm font-semibold text-blue-700">50%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                              <div class="bg-blue-500 h-2 rounded-full" style="width: 50%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                              <span class="text-xs text-gray-600">Bonds</span>
                              <span class="text-sm font-semibold text-blue-700">40%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                              <div class="bg-blue-400 h-2 rounded-full" style="width: 40%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                              <span class="text-xs text-gray-600">Alternative Assets</span>
                              <span class="text-sm font-semibold text-blue-700">10%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                              <div class="bg-blue-300 h-2 rounded-full" style="width: 10%"></div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="pt-4 border-t border-gray-100">
                          <p class="text-xs text-gray-500 mb-2"><strong>Who this is for:</strong> Investors with medium-term goals and moderate risk tolerance.</p>
                          <button class="w-full py-3 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors text-sm font-medium mt-2">
                            Select This Strategy <i class="fas fa-arrow-right ml-2"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </transition>

                  <!-- Aggressive Strategy -->
                  <transition appear @enter="enterAnimation" @leave="leaveAnimation" :css="false" :delay="200">
                    <div class="strategy-card border-2 border-orange-100 bg-gradient-to-br from-orange-50 to-white hover:shadow-lg transition-all duration-300">
                      <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 text-orange-800">
                            <i class="fas fa-chart-line mr-2"></i>Aggressive
                          </span>
                          <span class="text-2xl font-bold text-orange-600">High Risk</span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Maximum Growth</h3>
                        <p class="text-gray-600 text-sm mb-6">Focuses on long-term capital appreciation with higher volatility tolerance.</p>
                        
                        <!-- Asset allocation -->
                        <div class="mb-6">
                          <p class="text-sm font-medium text-gray-700 mb-3">Asset Allocation</p>
                          <div class="space-y-2">
                            <div class="flex items-center justify-between">
                              <span class="text-xs text-gray-600">Growth Stocks</span>
                              <span class="text-sm font-semibold text-orange-700">70%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                              <div class="bg-orange-500 h-2 rounded-full" style="width: 70%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                              <span class="text-xs text-gray-600">Tech & Innovation</span>
                              <span class="text-sm font-semibold text-orange-700">20%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                              <div class="bg-orange-400 h-2 rounded-full" style="width: 20%"></div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                              <span class="text-xs text-gray-600">Emerging Markets</span>
                              <span class="text-sm font-semibold text-orange-700">10%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                              <div class="bg-orange-300 h-2 rounded-full" style="width: 10%"></div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="pt-4 border-t border-gray-100">
                          <p class="text-xs text-gray-500 mb-2"><strong>Who this is for:</strong> Experienced investors with long-term horizons and high risk tolerance.</p>
                          <button class="w-full py-3 rounded-lg bg-orange-600 text-white hover:bg-orange-700 transition-colors text-sm font-medium mt-2">
                            Select This Strategy <i class="fas fa-arrow-right ml-2"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </transition>
                </div>
              </div>

              <!-- Additional insights -->
              <div class="bg-gradient-to-r from-[#800000]/5 to-[#800000]/10 rounded-2xl p-6 lg:p-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                  <i class="fas fa-lightbulb text-[#800000]"></i>AI Insights for Your Profile
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl">
                    <p class="text-sm font-medium text-gray-900 mb-2">💡 Based on your age and time horizon</p>
                    <p class="text-xs text-gray-600">You have sufficient time to recover from market fluctuations, allowing for more growth-oriented investments.</p>
                  </div>
                  <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl">
                    <p class="text-sm font-medium text-gray-900 mb-2">📊 Risk assessment</p>
                    <p class="text-xs text-gray-600">Your selected risk tolerance aligns well with your investment goals and experience level.</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Empty state (when no results yet) -->
            <div v-else class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 lg:p-12">
              <div class="text-center space-y-6">
                <div class="w-20 h-20 bg-gradient-to-br from-[#800000]/10 to-[#800000]/5 rounded-full flex items-center justify-center mx-auto">
                  <i class="fas fa-brain text-[#800000] text-3xl"></i>
                </div>
                <div class="space-y-3">
                  <h3 class="text-xl font-bold text-gray-900">Ready for personalized investment strategies?</h3>
                  <p class="text-gray-600 max-w-md mx-auto">Complete the form on the left to get AI-powered investment recommendations tailored to your unique profile.</p>
                </div>
                <div class="grid grid-cols-3 gap-4 max-w-md mx-auto">
                  <div class="text-center">
                    <div class="w-12 h-12 bg-[#800000]/10 rounded-full flex items-center justify-center mx-auto mb-2">
                      <i class="fas fa-user text-[#800000]"></i>
                    </div>
                    <p class="text-xs text-gray-600">Personal Profile</p>
                  </div>
                  <div class="text-center">
                    <div class="w-12 h-12 bg-[#800000]/10 rounded-full flex items-center justify-center mx-auto mb-2">
                      <i class="fas fa-chart-line text-[#800000]"></i>
                    </div>
                    <p class="text-xs text-gray-600">AI Analysis</p>
                  </div>
                  <div class="text-center">
                    <div class="w-12 h-12 bg-[#800000]/10 rounded-full flex items-center justify-center mx-auto mb-2">
                      <i class="fas fa-file-alt text-[#800000]"></i>
                    </div>
                    <p class="text-xs text-gray-600">Smart Plan</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { gsap } from 'gsap'

const currentStep = ref(1)
const totalSteps = 3
const loading = ref(false)
const showResults = ref(false)

// Form data
const form = ref({
  age: null,
  country: '',
  income: null,
  amount: 25000,
  goal: '',
  riskTolerance: 5,
  timeHorizon: '',
  experience: ''
})

// Form options
const ageOptions = ['18-24', '25-34', '35-44', '45-54', '55-64', '65+']
const countryOptions = ['United States', 'Canada', 'United Kingdom', 'Australia', 'Germany', 'France', 'Japan', 'Singapore', 'Other']
const incomeOptions = [
  { label: '< $50K', value: 'under-50k' },
  { label: '$50K - $100K', value: '50k-100k' },
  { label: '$100K - $200K', value: '100k-200k' },
  { label: '> $200K', value: 'over-200k' }
]
const goalOptions = [
  { label: 'Retirement', value: 'retirement', icon: 'fas fa-piggy-bank' },
  { label: 'Wealth Growth', value: 'growth', icon: 'fas fa-chart-line' },
  { label: 'Education', value: 'education', icon: 'fas fa-graduation-cap' },
  { label: 'Home Purchase', value: 'home', icon: 'fas fa-home' },
  { label: 'Emergency Fund', value: 'emergency', icon: 'fas fa-shield-alt' },
  { label: 'Other', value: 'other', icon: 'fas fa-ellipsis-h' }
]
const timeHorizonOptions = [
  { label: '< 3 years', value: 'short' },
  { label: '3-7 years', value: 'medium' },
  { label: '> 7 years', value: 'long' }
]
const experienceOptions = [
  { label: 'Beginner', value: 'beginner' },
  { label: 'Intermediate', value: 'intermediate' },
  { label: 'Advanced', value: 'advanced' }
]

// Computed properties
const stepTitle = computed(() => {
  switch(currentStep.value) {
    case 1: return 'Personal Information'
    case 2: return 'Investment Details'
    case 3: return 'Risk & Experience'
    default: return ''
  }
})

const isStepValid = computed(() => {
  switch(currentStep.value) {
    case 1: return form.value.age && form.value.country && form.value.income
    case 2: return form.value.amount && form.value.goal
    case 3: return form.value.timeHorizon && form.value.experience
    default: return false
  }
})

const isFormComplete = computed(() => {
  return Object.values(form.value).every(val => val !== null && val !== '')
})

// Methods
const nextStep = () => {
  if (currentStep.value < totalSteps) {
    currentStep.value++
  }
}

const prevStep = () => {
  if (currentStep.value > 1) {
    currentStep.value--
  }
}

const resetForm = () => {
  form.value = {
    age: null,
    country: '',
    income: null,
    amount: 25000,
    goal: '',
    riskTolerance: 5,
    timeHorizon: '',
    experience: ''
  }
  currentStep.value = 1
  showResults.value = false
}

const getRecommendations = async () => {
  loading.value = true
  
  // Simulate API call
  await new Promise(resolve => setTimeout(resolve, 2000))
  
  loading.value = false
  showResults.value = true
  
  // Scroll to results on mobile
  if (window.innerWidth < 1024) {
    const resultsSection = document.querySelector('.lg\\:col-span-7, .lg\\:col-span-12')
    if (resultsSection) {
      resultsSection.scrollIntoView({ behavior: 'smooth' })
    }
  }
}

// Animation methods
const enterAnimation = (el, done) => {
  gsap.from(el, {
    duration: 0.6,
    y: 30,
    opacity: 0,
    ease: 'power2.out',
    onComplete: done
  })
}

const leaveAnimation = (el, done) => {
  gsap.to(el, {
    duration: 0.3,
    y: -20,
    opacity: 0,
    ease: 'power2.in',
    onComplete: done
  })
}

// Initialize
onMounted(() => {
  // Style the range sliders
  const styleSliders = () => {
    const sliders = document.querySelectorAll('input[type="range"]')
    sliders.forEach(slider => {
      slider.style.background = `linear-gradient(to right, #800000 0%, #800000 ${(slider.value - slider.min) * 100 / (slider.max - slider.min)}%, #e5e7eb ${(slider.value - slider.min) * 100 / (slider.max - slider.min)}%, #e5e7eb 100%)`
      
      slider.addEventListener('input', (e) => {
        const value = (e.target.value - e.target.min) * 100 / (e.target.max - e.target.min)
        e.target.style.background = `linear-gradient(to right, #800000 0%, #800000 ${value}%, #e5e7eb ${value}%, #e5e7eb 100%)`
      })
    })
  }
  
  setTimeout(styleSliders, 100)
})
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

/* Custom slider styles */
.slider {
  -webkit-appearance: none;
  appearance: none;
  height: 6px;
}
</style>