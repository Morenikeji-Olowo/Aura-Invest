<template>
  <RouterView v-slot="{ Component, route }">
    <transition name="page-slide" mode="out-in">
      <component :is="Component" :key="route.fullPath" />
    </transition>
  </RouterView>
</template>

<script setup>
import { RouterView } from 'vue-router'
</script>

<style>
/* Smooth fade and slight slide up animation */
.page-slide-enter-active,
.page-slide-leave-active {
  transition: all 0.4s ease;
}

.page-slide-enter-from {
  opacity: 0;
  transform: translateY(10px);
}

.page-slide-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

/* Global resets to ensure the Dashboard fills the screen */
body {
  margin: 0;
  padding: 0;
  overflow-x: hidden;
  background-color: #f8f9fa; /* Matches Dashboard background */
}
</style>