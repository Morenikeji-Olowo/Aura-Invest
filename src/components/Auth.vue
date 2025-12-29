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
        
        <!-- Sign In button below the image -->
        <div class="mt-8 text-center">
          <p class="text-gray-600 text-lg mb-4">Already have an account?</p>
          <button 
            @click="$router.push('/login')"
            class="w-full max-w-xs mx-auto bg-gradient-to-r from-[#5a1a1a] to-[#741919] text-white py-3 rounded-xl font-semibold text-lg hover:shadow-lg hover:shadow-[#5a1a1a]/30 transition-all duration-300"
          >
            SIGN IN
          </button>
        </div>
      </div>
    </div>

    <!-- Right Panel - Registration Form -->
    <div class="w-3/5 bg-white flex items-center justify-center p-4 lg:p-3">
      <div class="max-w-md w-full">
        <!-- Success Message -->
        <div v-if="successMessage" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
          <div class="flex items-center gap-3">
            <i class="fas fa-check-circle text-green-500"></i>
            <span>{{ successMessage }}</span>
          </div>
        </div>

        <!-- General Error Message -->
        <div v-if="generalError" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
          <div class="flex items-center gap-3">
            <i class="fas fa-exclamation-circle text-red-500"></i>
            <span>{{ generalError }}</span>
          </div>
        </div>

        <h2 class="text-3xl lg:text-4xl font-bold text-[#5a1a1a] mb-2">Create Account</h2>
        <p class="text-gray-500 mb-8">Fill in your details to get started</p>

        <!-- Form -->
        <form @submit.prevent="handleSignup" class="space-y-6">
          <!-- First Name -->
          <div class="relative">
            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input 
              v-model="form.firstname" 
              placeholder="First Name" 
              class="input-field pl-10"
              :class="{ 'border-red-500': fieldErrors.firstname }"
              :disabled="isLoading"
              required 
            />
            <p v-if="fieldErrors.firstname" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.firstname }}</p>
          </div>

          <!-- Last Name -->
          <div class="relative">
            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input 
              v-model="form.lastname" 
              placeholder="Last Name" 
              class="input-field pl-10"
              :class="{ 'border-red-500': fieldErrors.lastname }"
              :disabled="isLoading"
              required 
            />
            <p v-if="fieldErrors.lastname" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.lastname }}</p>
          </div>
          
          <!-- Email -->
          <div class="relative">
            <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <input 
              v-model="form.email" 
              type="email" 
              placeholder="Email Address" 
              class="input-field pl-10"
              :class="{ 'border-red-500': fieldErrors.email }"
              :disabled="isLoading"
              required 
            />
            <p v-if="fieldErrors.email" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.email }}</p>
          </div>
          
          <!-- Password -->
          <div>
            <div class="relative">
              <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
              <input 
                v-model="form.password" 
                type="password" 
                placeholder="Password" 
                class="input-field pl-10 pr-10"
                :class="{ 'border-red-500': fieldErrors.password }"
                :disabled="isLoading"
                required 
                @keyup.enter="handleSignup"
              />
              <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <i class="fas fa-eye text-sm"></i>
              </button>
            </div>
            <p v-if="fieldErrors.password" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.password }}</p>
          </div>

          <!-- Confirm Password -->
          <div>
            <div class="relative">
              <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
              <input 
                v-model="form.confirmedPassword" 
                type="password" 
                placeholder="Confirm Password" 
                class="input-field pl-10 pr-10"
                :class="{ 'border-red-500': fieldErrors.confirmedPassword }"
                :disabled="isLoading"
                required 
              />
              <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <i class="fas fa-eye text-sm"></i>
              </button>
            </div>
            <p v-if="fieldErrors.confirmedPassword" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.confirmedPassword }}</p>
          </div>
          
          <!-- Terms Agreement -->
          <div class="flex items-start">
            <input 
              type="checkbox" 
              v-model="form.agreeToTerms" 
              id="terms" 
              class="mr-2 w-4 h-4 text-[#5a1a1a] rounded focus:ring-[#5a1a1a]"
              :disabled="isLoading"
              required 
            />
            <label for="terms" class="text-gray-600 text-sm">
              I agree to the <a href="#" class="text-[#5a1a1a] hover:text-[#741919]">Terms and Conditions</a>
            </label>
          </div>
          <p v-if="fieldErrors.agreeToTerms" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.agreeToTerms }}</p>

          <!-- Register Button -->
          <button 
            type="submit" 
            :disabled="isLoading"
            class="w-full bg-gradient-to-r from-[#5a1a1a] to-[#741919] text-white py-3 rounded-xl font-bold hover:shadow-lg hover:shadow-[#5a1a1a]/30 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="isLoading">
              <i class="fas fa-spinner fa-spin mr-2"></i> Creating Account...
            </span>
            <span v-else>Create Account</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isLoading = ref(false)
const generalError = ref('')
const successMessage = ref('')

// Form data
const form = reactive({
  firstname: '',
  lastname: '',
  email: '',
  password: '',
  confirmedPassword: '',
  agreeToTerms: false,
})

// Field-specific errors
const fieldErrors = reactive({
  firstname: '',
  lastname: '',
  email: '',
  password: '',
  confirmedPassword: '',
  agreeToTerms: ''
})

// Clear all errors
const clearErrors = () => {
  generalError.value = ''
  Object.keys(fieldErrors).forEach(key => {
    fieldErrors[key] = ''
  })
}

const handleSignup = async () => {
  // Clear previous errors
  clearErrors()
  successMessage.value = ''

  isLoading.value = true
  
  try {
    const response = await fetch('http://localhost/React/AI-Invest-Backend/backend(php)/code/auth/register.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        firstname: form.firstname,
        lastname: form.lastname,
        email: form.email,
        password: form.password,
        confimedPassword: form.confirmedPassword,
        agreeToTerms: form.agreeToTerms
      })
    })
    
    const data = await response.json()
    console.log('Backend response:', data)
    
    if (response.ok && data.success) {
      successMessage.value = data.message || 'Registration successful!'
      
      // Clear form
      form.firstname = ''
      form.lastname = ''
      form.email = ''
      form.password = ''
      form.confirmedPassword = ''
      form.agreeToTerms = false
      
      setTimeout(() => {
        router.push('/login')
      }, 2000)
      
    } else {
      // Check if backend returned field-specific errors
      if (data.errors) {
        // Set field-specific errors
        Object.keys(data.errors).forEach(key => {
          if (fieldErrors.hasOwnProperty(key)) {
            fieldErrors[key] = data.errors[key]
          }
        })
        
        // If there's a general error, show it too
        if (data.message && !data.errors.general) {
          generalError.value = data.message
        }
        
        // If backend returned a general error in errors object
        if (data.errors.general) {
          generalError.value = data.errors.general
        }
      } else {
        // Fallback to general error message
        generalError.value = data.message || 'Registration failed. Please try again.'
      }
    }
    
  } catch (error) {
    console.error('Signup error:', error)
    generalError.value = 'Network error. Please check your connection and try again.'
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

.input-field {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 2px solid #e5e7eb;
  border-radius: 0.75rem;
  font-size: 1rem;
  transition: all 0.2s;
  background: white;
}

.input-field:focus {
  outline: none;
  border-color: #5a1a1a;
  box-shadow: 0 0 0 3px rgba(90, 26, 26, 0.2);
}

.input-field.border-red-500 {
  border-color: #ef4444;
}

.input-field.border-red-500:focus {
  border-color: #ef4444;
  box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
}

.input-field:disabled {
  background-color: #f9fafb;
  cursor: not-allowed;
}
</style>