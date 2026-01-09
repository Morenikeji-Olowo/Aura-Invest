<template>
  <div id="app" class="min-h-screen">
    <RouterView v-slot="{ Component, route }">
      <Transition
        :name="route.meta.noTransition ? '' : 'page'"
        mode="out-in"
      >
        <main class="page-content">
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
