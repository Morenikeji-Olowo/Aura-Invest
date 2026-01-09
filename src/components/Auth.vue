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
        
        <!-- Sign In button below the image -->
        <div class="mt-4 lg:mt-6 text-center">
          <p class="text-gray-600 text-xs lg:text-sm mb-2 lg:mb-3">Already have an account?</p>
          <button 
            @click="$router.push('/login')"
            class="w-full max-w-[200px] mx-auto bg-gradient-to-r from-[#5a1a1a] to-[#741919] text-white py-2 lg:py-2.5 rounded-lg font-medium text-xs lg:text-sm hover:shadow-md hover:shadow-[#5a1a1a]/20 transition-all duration-300"
          >
            SIGN IN
          </button>
        </div>
      </div>
    </div>

    <!-- Right Panel - Registration Form -->
    <div class="w-full md:w-1/2 lg:w-3/5 bg-white flex items-center justify-center p-4 md:p-6 lg:p-8">
      <div class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-sm">
        <!-- Mobile Sign In Button (Only on mobile) -->
        <div class="md:hidden mb-4 text-center">
          <p class="text-gray-600 text-xs mb-2">Already have an account?</p>
          <button 
            @click="$router.push('/login')"
            class="bg-gradient-to-r from-[#5a1a1a] to-[#741919] text-white px-4 py-2 rounded-lg font-medium text-xs hover:shadow-md hover:shadow-[#5a1a1a]/20 transition-all duration-300"
          >
            SIGN IN
          </button>
        </div>

        <!-- Success Message -->
        <div v-if="successMessage" class="mb-3 p-2.5 bg-green-50 border border-green-200 rounded-lg text-green-700 text-xs">
          <div class="flex items-center gap-1.5">
            <i class="fas fa-check-circle text-green-500 text-xs"></i>
            <span>{{ successMessage }}</span>
          </div>
        </div>

        <!-- General Error Message -->
        <div v-if="generalError" class="mb-3 p-2.5 bg-red-50 border border-red-200 rounded-lg text-red-700 text-xs">
          <div class="flex items-center gap-1.5">
            <i class="fas fa-exclamation-circle text-red-500 text-xs"></i>
            <span>{{ generalError }}</span>
          </div>
        </div>

        <h2 class="text-xl sm:text-2xl lg:text-2xl font-bold text-[#5a1a1a] mb-1">Create Account</h2>
        <p class="text-gray-500 text-xs sm:text-sm mb-4">Fill in your details to get started</p>

        <!-- Form -->
        <form @submit.prevent="handleSignup" class="space-y-3 sm:space-y-4">
          <!-- First Name -->
          <div class="relative">
            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
            <input 
              v-model="form.firstname" 
              placeholder="First Name" 
              class="input-field pl-8 text-sm"
              :class="{ 'border-red-500': fieldErrors.firstname }"
              :disabled="isLoading"
              required 
            />
            <p v-if="fieldErrors.firstname" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.firstname }}</p>
          </div>

          <!-- Last Name -->
          <div class="relative">
            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
            <input 
              v-model="form.lastname" 
              placeholder="Last Name" 
              class="input-field pl-8 text-sm"
              :class="{ 'border-red-500': fieldErrors.lastname }"
              :disabled="isLoading"
              required 
            />
            <p v-if="fieldErrors.lastname" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.lastname }}</p>
          </div>
          
          <!-- Email -->
          <div class="relative">
            <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
            <input 
              v-model="form.email" 
              type="email" 
              placeholder="Email Address" 
              class="input-field pl-8 text-sm"
              :class="{ 'border-red-500': fieldErrors.email }"
              :disabled="isLoading"
              required 
            />
            <p v-if="fieldErrors.email" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.email }}</p>
          </div>
          
          <!-- Password -->
          <div>
            <div class="relative">
              <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
              <input 
                v-model="form.password" 
                :type="showPassword ? 'text' : 'password'"
                placeholder="Password" 
                class="input-field pl-10 pr-10"
                :class="{ 'border-red-500': fieldErrors.password }"
                :disabled="isLoading"
                required 
                @keyup.enter="handleSignup"
              />
              <button
                type="button"
                @click="showPassword = !showPassword"
                :aria-pressed="showPassword"
                :aria-label="showPassword ? 'Hide password' : 'Show password'"
                class="bg-white absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 p-1 w-8 h-8 flex items-center justify-center"
              >
                <i :class="[showPassword ? 'fas fa-eye-slash' : 'fas fa-eye', 'text-sm']"></i>
              </button>
            </div>
            <p v-if="fieldErrors.password" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.password }}</p>
          </div>

          <!-- Confirm Password -->
          <div>
            <div class="relative">
              <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
              <input 
                v-model="form.confirmedPassword" 
                :type="showConfirmPassword ? 'text' : 'password'"
                placeholder="Confirm Password" 
                class="input-field pl-10 pr-10"
                :class="{ 'border-red-500': fieldErrors.confirmedPassword }"
                :disabled="isLoading"
                required 
              />
              <button
                type="button"
                @click="showConfirmPassword = !showConfirmPassword"
                :aria-pressed="showConfirmPassword"
                :aria-label="showConfirmPassword ? 'Hide confirm password' : 'Show confirm password'"
                class="bg-white absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 p-1 w-8 h-8 flex items-center justify-center"
              >
                <i :class="[showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye', 'text-sm']"></i>
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
              class="mr-2 w-3.5 h-3.5 text-[#5a1a1a] rounded focus:ring-[#5a1a1a] mt-0.5"
              :disabled="isLoading"
              required 
            />
            <label for="terms" class="text-gray-600 text-xs">
              I agree to the <a href="#" class="text-[#5a1a1a] hover:text-[#741919] underline">Terms</a>
            </label>
          </div>
          <p v-if="fieldErrors.agreeToTerms" class="text-red-500 text-xs mt-1 pl-1">{{ fieldErrors.agreeToTerms }}</p>

          <!-- Register Button -->
          <button 
            type="submit" 
            :disabled="isLoading"
            class="w-full bg-gradient-to-r from-[#5a1a1a] to-[#741919] text-white py-2.5 rounded-lg font-bold text-sm hover:shadow-md hover:shadow-[#5a1a1a]/20 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed mt-2"
          >
            <span v-if="isLoading">
              <i class="fas fa-spinner fa-spin mr-1.5"></i> Creating Account...
            </span>
            <span v-else>Create Account</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isLoading = ref(false)
const generalError = ref('')
const successMessage = ref('')
const showPassword = ref(false)
const showConfirmPassword = ref(false)

onMounted(() => {
  console.log('[Auth] mounted')
})

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
    const response = await fetch(`${import.meta.env.VITE_API_BASE_URL}/code/auth/register.php`, {
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

.input-field {
  width: 100%;
  padding: 0.5rem 0.75rem;
  border: 1px solid #e5e7eb;
  border-radius: 0.375rem;
  font-size: 0.875rem;
  transition: all 0.2s;
  background: white;
  color: black;
}

.input-field:focus {
  outline: none;
  border-color: #5a1a1a;
  box-shadow: 0 0 0 2px rgba(90, 26, 26, 0.1);
}

.input-field.border-red-500 {
  border-color: #ef4444;
}

.input-field.border-red-500:focus {
  border-color: #ef4444;
  box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.1);
}

.input-field:disabled {
  background-color: #f9fafb;
  cursor: not-allowed;
}

  @media (min-width: 640px) {
  .input-field {
    padding: 0.6rem 0.8rem;
    border-radius: 0.5rem;
    color: black;
  }
}

@media (min-width: 1024px) {
  .input-field {
    padding: 0.55rem 0.8rem;
  }
}
</style>