
import { reactive } from 'vue'

export const onboardingStore = reactive({
  user: {
    name: '',
    email: '',
    avatar: ''
  },
  knowledge: 'intermediate',
  riskLevel: 'medium',
  goal: 'wealth',
  horizon: 'medium-term',

  // Helper to navigate
  next(router, stepNumber) {
    router.push(`/onboarding/step${stepNumber}`)
  },

  // Login user
  login(userData, router) {
    this.user = { ...userData }
    localStorage.setItem('user', JSON.stringify(this.user))
    router.push('/onboarding/step1')
  },

  // Load user from localStorage
  loadUser() {
    const saved = localStorage.getItem('user')
    if (saved) this.user = JSON.parse(saved)
  },

  // Logout
  logout(router) {
    this.user = { name: '', email: '', avatar: '' }
    localStorage.removeItem('user')
    router.push('/')
  }
})

// Load user on app start
onboardingStore.loadUser()
