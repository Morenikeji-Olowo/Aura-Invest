import { createRouter, createWebHistory } from "vue-router";
import AuthPage from "../components/Auth.vue";
import OnboardingLayout from "../views/onboarding/OnboardingLayout.vue";
import Dashboard from "../components/Dashboard.vue";
import portfolio from "../components/portfolio.vue";
import protectedRoute from "../utils/protectedRoute.vue";
import Step1 from "../views/onboarding/Step1Welcome.vue";
import Step2 from "../views/onboarding/Step2Knowledge.vue";
import Step3 from "../views/onboarding/Step3Risk.vue";
import Step4 from "../views/onboarding/Step4Goal.vue";
import Step5 from "../views/onboarding/Step5Horizon.vue";
import Step6 from "../views/onboarding/Step6AI-Result.vue";
import Portfolio from "../components/portfolio.vue";
import test from "../components/test.vue";
import Signin from "../components/Signin.vue";

const routes = [
  { path: "/", component: AuthPage },
  {path: "/login", component: Signin},
  {
    path: "/dashboard",
    component: protectedRoute,
    children: [{ path: "", component: Dashboard }],
  },
  {
    path: "/portfolio",
    component: protectedRoute,
    children: [
      {
        path: "",
        component: Portfolio,
      },
    ],
  },

  {
    path: "/onboarding",
    component: protectedRoute,
    children: [
      {
        path: "",
        component: OnboardingLayout,
        children: [
          { path: "step1", component: Step1 },
          { path: "step2", component: Step2 },
          { path: "step3", component: Step3 },
          { path: "step4", component: Step4 },
          { path: "step5", component: Step5 },
          { path: "step6", component: Step6 },
        ],
      },
    ],
  },
  { path: "/test", component: test },
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
