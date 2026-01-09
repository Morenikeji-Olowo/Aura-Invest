<template>
  <div id="app" class="min-h-screen">
    <RouterView v-slot="{ Component, route }">
      <Transition
        name="page"
        mode="out-in"
      >
        <!-- Add :key so Vue knows it’s a different page -->
        <main class="page-content" :key="route.fullPath">
          <component :is="Component" />
        </main>
      </Transition>
    </RouterView>
  </div>
</template>

<script setup></script>

<style>
/* Smooth fade-only transition */
.page-enter-from,
.page-leave-to {
  opacity: 0;
}
.page-enter-active,
.page-leave-active {
  transition: opacity 0.3s ease;
}
</style>
