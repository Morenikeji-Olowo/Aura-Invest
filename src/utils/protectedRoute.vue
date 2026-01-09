<!-- utils/protectedRoute.vue -->
<template>
  <div v-if="loading" class="flex text-red-500 items-center justify-center min-h-screen">
    <p>Checking session...</p>
  </div>
  
  <div v-else-if="!loggedIn" class="flex items-center justify-center min-h-screen text-gray-500">
    <div>
      <p class="mb-2">Not authenticated — redirecting to sign-in...</p>
      <button @click="goToLogin" class="underline text-sm">Go to Sign In</button>
    </div>
  </div>
  
  <!-- Use router-view instead of slot for nested routes -->
  <router-view v-else />
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { checkSession } from './checkSession.js'

const router = useRouter()
const route = useRoute()
const loading = ref(true)
const loggedIn = ref(false)

const goToLogin = () => {
  console.log('protectedRoute: manual redirect to /login')
  router.push('/login')
}

// Function to check authentication
const verifyAuth = async () => {
  console.log('protectedRoute: checking session...')
  const session = await checkSession()
  console.log('protectedRoute: session result', session)
  
  loggedIn.value = session.authenticated || session.loggedIn
  loading.value = false
  
  if (!loggedIn.value) {
    console.log('protectedRoute: not logged in — redirecting to /')
    router.push('/') 
  } else {
    console.log('protectedRoute: user is logged in')
  }
}

onMounted(async () => {
  await verifyAuth()
  
  window.addEventListener('storage', async (event) => {
    if (event.key === 'userData') {
      console.log('protectedRoute: localStorage changed, re-checking auth')
      loading.value = true
      await verifyAuth()
    }
  })
})

// Optional: Clean up event listener
import { onUnmounted } from 'vue'
onUnmounted(() => {
  window.removeEventListener('storage', verifyAuth)
})
</script>