import { reactive } from 'vue'

export const onboardingStore = reactive({
  user: {
    name: '',
    email: '',
    avatar: '',
    hasCompletedOnboarding: false
  },
  knowledge: 'intermediate',
  riskLevel: 'medium',
  goal: 'wealth',
  horizon: 'medium-term',

  // NEW: Save onboarding data to backend
  async saveOnboardingData() {
    try {
      // Prepare the data - use name from user object
      const userName = this.user.name || ''
      
      const response = await fetch(
        "http://localhost/React/AI-Invest-Backend/backend(php)/code/onboarding/save.php",
        {
          method: "POST",
          credentials: "include",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            name: userName,
            knowledge: this.knowledge,
            riskLevel: this.riskLevel,
            goal: this.goal,
            horizon: this.horizon
          }),
        }
      )

      const data = await response.json()
      
      if (data.success) {
        // Update user data with completed status
        this.user.hasCompletedOnboarding = true
        localStorage.setItem('user', JSON.stringify(this.user))
        
        return { success: true, data }
      } else {
        return { success: false, error: data.error }
      }
    } catch (error) {
      console.error('Error saving onboarding:', error)
      return { success: false, error: 'Network error' }
    }
  },

  // Helper to navigate
  next(router, stepNumber) {
    router.push(`/onboarding/step${stepNumber}`)
  },

  // Login user
  async login(userData, router) {
    try {
      this.user = { 
        ...userData,
        hasCompletedOnboarding: userData.has_onboarded || false
      }
      localStorage.setItem('user', JSON.stringify(this.user))
      
      // Check if user needs onboarding
      if (userData.has_onboarded) {
        router.push('/dashboard')
      } else {
        router.push('/onboarding/step1')
      }
    } catch (error) {
      console.error('Login error:', error)
    }
  },

  // Load user from localStorage
  loadUser() {
    const saved = localStorage.getItem('user')
    if (saved) {
      this.user = JSON.parse(saved)
    }
  },

  // Logout
  logout(router) {
    this.user = { 
      name: '', 
      email: '', 
      avatar: '', 
      hasCompletedOnboarding: false 
    }
    localStorage.removeItem('user')
    router.push('/')
  }
})

// Load user on app start
onboardingStore.loadUser()