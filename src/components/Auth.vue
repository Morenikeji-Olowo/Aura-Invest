<template>
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">

  <div class="min-h-screen w-screen bg-[#e9ebee] flex items-center justify-center p-4 font-['Montserrat']">
    <div class="relative bg-white w-full max-w-[850px] flex rounded-[30px] shadow-2xl overflow-hidden min-h-[500px]">

      
      <div class="w-[40%] bg-gradient-to-b from-[#8d2f2f] to-[#5a1a1a] p-10 flex flex-col items-center justify-center text-center text-white z-10">
        <h2 class="font-['Permanent+Marker'] text-2xl italic tracking-wider mb-6">
          {{ isSignup ? 'WELCOME BACK!' : 'HELLO FRIEND!' }}
        </h2>
        <p class="text-[13px] leading-relaxed mb-8 font-light px-4">
          {{ isSignup 
            ? 'Already have an account? Click below to sign in.' 
            : 'Don’t have an account? Click below to sign up.' }}
        </p>
        <button 
          @click="toggleMode"
          class="border-2 border-white bg-[#5a1a1a] rounded-full px-12 py-2 text-xs font-bold tracking-widest hover:bg-white hover:text-[#5a1a1a] transition-all"
        >
          {{ isSignup ? 'SIGN IN' : 'SIGN UP' }}
        </button>
      </div>

      
      <div class="w-[60%] p-12 flex flex-col items-center justify-center relative">
        <h1 class="text-[#5a1a1a] text-3xl font-bold mb-6">
          {{ isSignup ? 'Create Account' : 'Sign In' }}
        </h1>

        
        <div v-if="isSignup" class="flex gap-3 mb-4">
          <div class="w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center text-gray-500 hover:bg-red-900 cursor-pointer transition-colors">
            <i class="fab fa-facebook-f text-sm"></i>
          </div>
          <div class="w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center text-gray-500 hover:bg-red-900 cursor-pointer transition-colors">
            <i class="fab fa-twitter text-sm"></i>
          </div>
          <div class="w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center text-gray-500 hover:bg-red-900 cursor-pointer transition-colors">
            <i class="fab fa-linkedin-in text-sm"></i>
          </div>
        </div>

        <p class="text-[11px] text-gray-400 mb-6 italic" v-if="isSignup">or use your email account</p>

      
        <div class="w-full max-w-[320px] space-y-4">
     
          <div v-if="isSignup" class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
              <i class="fas fa-user text-sm"></i>
            </span>
            <input 
              v-model="form.username"
              type="text" 
              placeholder="Username" 
              class="w-full border border-gray-900 rounded-md py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-gray-500 bg-[#f4f8fb]"
            />
            <p v-if="errors.username" class="text-[10px] text-red-900 mt-1 absolute">{{ errors.username }}</p>
          </div>

         
          <div class="relative pt-1">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 mt-0.5">
              <i class="fas fa-envelope text-sm"></i>
            </span>
            <input 
              v-model="form.email"
              type="email" 
              placeholder="Email" 
              class="w-full border border-gray-900 rounded-md py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-gray-500 bg-[#f4f8fb]"
            />
            <p v-if="errors.email" class="text-[10px] text-red-900 mt-1 absolute">{{ errors.email }}</p>
          </div>

         
          <div class="relative pt-1">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 mt-0.5">
              <i class="fas fa-lock text-sm"></i>
            </span>
            <input 
              v-model="form.password"
              type="password" 
              placeholder="Password" 
              class="w-full border border-gray-900 rounded-md py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-gray-500 bg-[#f4f8fb]"
            />
            <p v-if="errors.password" class="text-[10px] text-red-900 mt-1 absolute">{{ errors.password }}</p>
          </div>
        </div>

     
        <button 
          @click="isSignup ? signup() : signin()"
          class="mt-12 bg-gradient-to-r from-[#882e2e] to-[#5a1a1a] text-white px-14 py-2.5 rounded-full text-xs font-bold tracking-widest shadow-xl hover:scale-105 transition-transform"
        >
          {{ isSignup ? 'SIGN UP' : 'SIGN IN' }}
        </button>
      </div>

    </div>
  </div>
</template>

<script setup>
import { reactive, ref, nextTick } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const isSignup = ref(true)  

const form = reactive({
  username: '',
  email: '',
  password: ''
})

const errors = reactive({
  username: '',
  email: '',
  password: ''
})

const toggleMode = () => {
  isSignup.value = !isSignup.value
  form.username = ''
  form.email = ''
  form.password = ''
  errors.username = ''
  errors.email = ''
  errors.password = ''
}

// Validation
const validate = () => {
  let valid = true
  if (isSignup.value && !form.username) errors.username = 'Username is required'
  else errors.username = ''

  errors.email = !/^\S+@\S+\.\S+$/.test(form.email) ? 'Invalid email address' : ''
  errors.password = form.password.length < 6 ? 'Password too short' : ''

  if ((isSignup.value && errors.username) || errors.email || errors.password) valid = false
  return valid
}

// Signup
const signup = () => {
  if (!validate()) return
  const users = JSON.parse(localStorage.getItem('users') || '[]')
  users.push({ 
    username: form.username, 
    email: form.email, 
    password: form.password, 
    completedOnboarding: false 
  })
  localStorage.setItem('users', JSON.stringify(users))
  alert('Sign Up successful! Please Sign In.')
  toggleMode()
}

// Signin
const signin = () => {
  const users = JSON.parse(localStorage.getItem('users') || '[]')
  const user = users.find(u => u.email === form.email && u.password === form.password)
  
  if (user) {
    
    localStorage.setItem('loggedInUser', JSON.stringify(user))

    alert('Login successful!')

   
    router.push('/onboarding/step1')
  } else {
    alert('Invalid email or password')
  }
}

</script>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

body {
  margin: 0;
  -webkit-font-smoothing: antialiased;
}
</style>
