<template>
  <div class="min-h-screen flex items-center justify-center">
    <div class="text-center">
      <h1 class="text-2xl mb-4">Login Test</h1>
      
      <!-- SIMPLE BUTTON TEST -->
      <button 
        @click="testButton"
        class="bg-blue-500 text-white px-6 py-3 rounded-lg"
      >
        Click Me - Does this work?
      </button>
      
      <p class="mt-4 text-gray-600">{{ testMessage }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const testMessage = ref('Click the button...')

const testButton = () => {
  console.log('🎉 BUTTON CLICKED!')
  testMessage.value = 'Button was clicked! Check console (F12)'
  alert('Button works!')
}
</script>