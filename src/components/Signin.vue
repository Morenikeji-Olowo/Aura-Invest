<template>
  <div class="min-h-screen w-full bg-white flex font-sans">
    <!-- Left Panel - SVG Image -->
    <div class="w-2/5 flex items-center justify-center p-8 lg:p-12">
      <div class="w-full max-w-lg">
        <img 
          src="../assets/undraw_personal-finance_xpqg.svg" 
          alt="Personal Finance Illustration"
          class="w-full h-auto max-h-[500px] object-contain"
        />
        
        <!-- Sign Up button below the image -->
        <div class="mt-8 text-center">
          <p class="text-gray-600 text-lg mb-4">Don't have an account?</p>
          <button 
            @click="$router.push('/register')"
            class="w-full max-w-xs mx-auto bg-gradient-to-r from-[#5a1a1a] to-[#741919] text-white py-3 rounded-xl font-semibold text-lg hover:shadow-lg hover:shadow-[#5a1a1a]/30 transition-all duration-300"
          >
            SIGN UP
          </button>
        </div>
      </div>
    </div>

    <!-- Right Panel - Login Form -->
    <div class="w-3/5 bg-white flex items-center justify-center p-8 lg:p-12">
      <div class="max-w-md w-full">
        <!-- Messages -->
        <div v-if="successMessage" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
          <div class="flex items-center gap-3">
            <i class="fas fa-check-circle text-green-500"></i>
            <span>{{ successMessage }}</span>
          </div>
        </div>

        <div v-if="errorMessage" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
          <div class="flex items-center gap-3">
            <i class="fas fa-exclamation-circle text-red-500"></i>
            <span>{{ errorMessage }}</span>
          </div>
        </div>

        <h2 class="text-3xl lg:text-4xl font-bold text-[#5a1a1a] mb-2">Welcome Back</h2>
        <p class="text-gray-500 mb-8">Sign in to your account to continue</p>

        <!-- Form -->
        <form @submit.prevent="handleSignIn" class="space-y-6">
          <!-- Email -->
          <div class="space-y-2">
            <label class="block text-lg font-medium text-gray-700">Email Address</label>
            <div class="relative">
              <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
              <input 
                v-model="form.email"
                type="email" 
                placeholder="Justin@ghostlamp.io" 
                class="w-full pl-10 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5a1a1a] focus:border-[#5a1a1a] transition-all bg-white"
                :disabled="isLoading"
                required
              />
            </div>
          </div>

          <!-- Password -->
          <div class="space-y-2">
            <div class="flex justify-between items-center">
              <label class="block text-lg font-medium text-gray-700">Password</label>
              <button type="button" class="text-sm text-[#5a1a1a] hover:text-[#741919] font-medium">
                Forgot Password?
              </button>
            </div>
            <div class="relative">
              <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
              <input 
                v-model="form.password"
                type="password" 
                placeholder="**********" 
                class="w-full pl-10 pr-10 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#5a1a1a] focus:border-[#5a1a1a] transition-all bg-white"
                :disabled="isLoading"
                required
                @keyup.enter="handleSignIn"
              />
              <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

          <!-- Remember Me -->
          <div class="flex items-center">
            <input 
              type="checkbox" 
              id="remember"
              class="mr-2 w-4 h-4 text-[#5a1a1a] rounded focus:ring-[#5a1a1a]"
            />
            <label for="remember" class="text-gray-600 text-sm">
              Remember me
            </label>
          </div>

          <!-- Sign In Button -->
          <button 
            type="submit" 
            :disabled="isLoading"
            class="w-full bg-gradient-to-r from-[#5a1a1a] to-[#741919] text-white py-3.5 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-[#5a1a1a]/30 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="isLoading">
              <i class="fas fa-spinner fa-spin mr-2"></i> Signing In...
            </span>
            <span v-else>Sign In</span>
          </button>
        </form>

        <!-- Sign Up Link -->
        <div class="mt-8 text-center">
          <p class="text-gray-600">
            Don't have an account?
            <button type="button" @click="$router.push('/')" class="text-[#5a1a1a] hover:text-[#741919] font-semibold ml-2">
              Create Account
            </button>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isLoading = ref(false)
const errorMessage = ref('')
const successMessage = ref('')

// Form data
const form = reactive({
  email: '',
  password: ''
})

const handleSignIn = async () => {
  // Reset messages
  errorMessage.value = ''
  successMessage.value = ''

  
  isLoading.value = true
  
  try {
  console.log('Sending login request...', { email: form.email })
  
  const response = await fetch('http://localhost/React/AI-Invest-Backend/backend(php)/code/auth/login.php', {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      email: form.email,
      password: form.password
    })
  })
      
  const data = await response.json()
  console.log('Response data:', data)
  
  // Check if response was successful
  if (response.ok) {
    if (data.success) {
      successMessage.value = data.message || 'Login successful!'
      console.log('Login successful:', data)
      
      if (data.user) {
        localStorage.setItem('userData', JSON.stringify(data.user))
      }
      
      setTimeout(() => {
        if (data.user && data.user.hasCompletedOnboarding) {
          router.push('/dashboard')
        } else {
          router.push('/onboarding/step1')
        }
      }, 1000)
      
    } else {
      errorMessage.value = data.message || 'Login failed. Please try again.'
    }
  } else {
    errorMessage.value = data.message || `Login failed (HTTP ${response.status})`
  }
  
} catch (error) {
  console.error('Login error:', error)
  if (error.name === 'TypeError' && error.message.includes('fetch')) {
    errorMessage.value = 'Network error. Please check your connection and try again.'
  } else {
    errorMessage.value = 'An unexpected error occurred. Please try again.'
  }
} finally {
  isLoading.value = false
}
}
</script>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

body, html {
  margin: 0;
  padding: 0;
  width: 100%;
  background-color: white;
  height: 100vh;
  overflow: hidden;
}

/* Custom focus styles for #5a1a1a color */
input:focus {
  outline: none;
  border-color: #5a1a1a;
  box-shadow: 0 0 0 3px rgba(90, 26, 26, 0.2);
}
</style>