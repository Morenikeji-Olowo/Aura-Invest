<template>
  <div id="app" class="min-h-screen">
    <!-- Navigation stays fixed -->
    <NavBar />

    <!-- Main content with smooth transition -->
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

    <!-- Footer stays fixed -->
    <Footer />

    <!-- Chat Widget stays fixed -->
    <ChatWidget />
  </div>
</template>

<script setup>
import NavBar from "./components/NavBar.vue";
import Footer from "./components/Footer.vue";
import ChatWidget from "./components/ChatWidget.vue";
</script>

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
