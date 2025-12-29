<template>
  <div class="min-h-screen bg-white flex justify-center px-4">
    <div class="w-full max-w-4xl pt-16">

      <!-- PROGRESS HEADER -->
      <div class="mb-12">
        <p class="text-sm text-gray-500 mb-2">
          Step {{ currentStep }} of 6
        </p>

        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
          <div
            class="h-full bg-red-900 transition-all duration-300"
            :style="{ width: progress + '%' }"
          ></div>
        </div>

        <p class="text-xs text-gray-400 mt-2">
          {{ stepLabel }}
        </p>
      </div>

      <!-- STEP CONTENT -->
      <RouterView />

    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()

const stepMap = {
  step1: 'Welcome',
  step2: 'Knowledge',
  step3: 'Risk ',
  step4: 'Goal',
  step5: 'Horizon',
  step6: 'AI Result'
}

const currentStep = computed(() =>
  Number(route.path.split('step')[1]) || 1
)

const progress = computed(() => (currentStep.value / 6) * 100)

const stepLabel = computed(() => stepMap[`step${currentStep.value}`])
</script>
