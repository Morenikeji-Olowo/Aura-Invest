<template>
  <div class="min-h-screen w-full bg-white font-sans flex flex-col lg:flex-row">
    <!-- Left Panel - SVG Image (Hidden on mobile, appears on medium+) -->
    <div class="hidden md:flex md:w-1/2 lg:w-2/5 items-center justify-center p-4 lg:p-6">
      <div class="w-full max-w-xs lg:max-w-sm">
        <img 
          src="../assets/undraw_personal-finance_xpqg.svg" 
          alt="Personal Finance Illustration"
          class="w-full h-auto max-h-[320px] lg:max-h-[380px] object-contain"
        />
        
        <!-- Sign Up button below the image -->
        <div class="mt-4 lg:mt-6 text-center">
          <p class="text-gray-600 text-xs lg:text-sm mb-2 lg:mb-3">Don't have an account?</p>
          <button 
            @click="$router.push('/register')"
            class="w-full max-w-[200px] mx-auto bg-gradient-to-r from-[#5a1a1a] to-[#741919] text-white py-2 lg:py-2.5 rounded-lg font-medium text-xs lg:text-sm hover:shadow-md hover:shadow-[#5a1a1a]/20 transition-all duration-300"
          >
            SIGN UP
          </button>
        </div>
      </div>
    </div>

    <!-- Right Panel - Login Form -->
    <div class="w-full md:w-1/2 lg:w-3/5 bg-white flex items-center justify-center p-4 md:p-6 lg:p-8">
      <div class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-sm">
        <!-- Mobile Sign Up Button (Only on mobile) -->
        <div class="md:hidden mb-4 text-center">
          <p class="text-gray-600 text-xs mb-2">Don't have an account?</p>
          <button 
            @click="$router.push('/register')"
            class="bg-gradient-to-r from-[#5a1a1a] to-[#741919] text-white px-4 py-2 rounded-lg font-medium text-xs hover:shadow-md hover:shadow-[#5a1a1a]/20 transition-all duration-300"
          >
            SIGN UP
          </button>
        </div>

        <!-- Messages -->
        <div v-if="successMessage" class="mb-3 p-2.5 bg-green-50 border border-green-200 rounded-lg text-green-700 text-xs">
          <div class="flex items-center gap-1.5">
            <i class="fas fa-check-circle text-green-500 text-xs"></i>
            <span>{{ successMessage }}</span>
          </div>
        </div>

        <div v-if="errorMessage" class="mb-3 p-2.5 bg-red-50 border border-red-200 rounded-lg text-red-700 text-xs">
          <div class="flex items-center gap-1.5">
            <i class="fas fa-exclamation-circle text-red-500 text-xs"></i>
            <span>{{ errorMessage }}</span>
          </div>
        </div>

        <h2 class="text-xl sm:text-2xl lg:text-2xl font-bold text-[#5a1a1a] mb-1">Welcome Back</h2>
        <p class="text-gray-500 text-xs sm:text-sm mb-4">Sign in to your account to continue</p>

        <!-- Form -->
        <form @submit.prevent="handleSignIn" class="space-y-3 sm:space-y-4">
          <!-- Email -->
          <div class="space-y-1.5">
            <label class="block text-sm font-medium text-gray-700">Email Address</label>
            <div class="relative">
              <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
              <input 
                v-model="form.email"
                type="email" 
                name="email"
                placeholder="Justin@ghostlamp.io" 
                class="input-field pl-8 text-sm"
                :disabled="isLoading"
                required
              />
            </div>
          </div>

          <!-- Password -->
          <div class="space-y-1.5">
            <div class="flex justify-between items-center">
              <label class="block text-sm font-medium text-gray-700">Password</label>
              <button type="button" class="bg-white text-xs text-[#5a1a1a] hover:text-[#741919] font-medium">
                Forgot Password?
              </button>
            </div>
            <div class="relative">
              <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
              <input 
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'" 
                placeholder="**********" 
                class="input-field pl-8 pr-10 text-sm"
                :disabled="isLoading"
                required
                @keyup.enter="handleSignIn"
              />
              <button
                type="button"
                @click="showPassword = !showPassword"
                :aria-pressed="showPassword"
                :aria-label="showPassword ? 'Hide password' : 'Show password'"
                class=" bg-white absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 p-1 w-8 h-8 flex items-center justify-center z-10 focus:outline-none focus:ring-2 focus:ring-[#5a1a1a]"
              >
                <i :class="[showPassword ? 'fas fa-eye-slash' : 'fas fa-eye', 'text-xs']"></i>
              </button>
            </div>
          </div>

          <!-- Remember Me -->
          <div class="flex items-center">
            <input 
              type="checkbox" 
              id="remember"
              class="mr-2 w-3.5 h-3.5 text-[#5a1a1a] rounded focus:ring-[#5a1a1a]"
            />
            <label for="remember" class="text-gray-600 text-xs">
              Remember me
            </label>
          </div>

          <!-- Sign In Button -->
          <button 
            type="submit" 
            :disabled="isLoading"
            class="w-full bg-gradient-to-r from-[#5a1a1a] to-[#741919] text-white py-2.5 rounded-lg font-bold text-sm hover:shadow-md hover:shadow-[#5a1a1a]/20 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed mt-2"
          >
            <span v-if="isLoading">
              <i class="fas fa-spinner fa-spin mr-1.5"></i> Signing In...
            </span>
            <span v-else>Sign In</span>
          </button>
        </form>

        <!-- Sign Up Link -->
        <div class="mt-6 text-center">
          <p class="text-gray-600 text-xs">
            Don't have an account?
            <button type="button" @click="$router.push('/register')" class="text-[#5a1a1a] hover:text-[#741919] bg-white font-medium ml-1">
              Create Account
            </button>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isLoading = ref(false)
const errorMessage = ref('')
const successMessage = ref('')
const showPassword = ref(false)

onMounted(() => {
  console.log('[Signin] mounted')
})

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
  
  const response = await fetch(`${import.meta.env.VITE_API_BASE_URL}/code/auth/login.php`, {
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

.input-field {
  width: 100%;
  padding: 0.5rem 0.75rem;
  border: 1px solid #e5e7eb;
  border-radius: 0.375rem;
  font-size: 0.875rem;
  transition: all 0.2s;
  background: white;
}

.input-field:focus {
  outline: none;
  border-color: #5a1a1a;
  box-shadow: 0 0 0 2px rgba(90, 26, 26, 0.1);
}

.input-field:disabled {
  background-color: #f9fafb;
  cursor: not-allowed;
}

/* Responsive breakpoints */
@media (min-width: 640px) {
  .input-field {
    padding: 0.6rem 0.8rem;
    border-radius: 0.5rem;
  }
}

@media (min-width: 1024px) {
  .input-field {
    padding: 0.55rem 0.8rem;
  }
}
</style>