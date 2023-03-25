import { createRouter, createWebHistory } from "vue-router";
import FirstScene from "@/pages/FirstScene.vue";
import SecondScene from "@/pages/SecondScene.vue";
import ThirdScene from "@/pages/ThirdScene.vue";

const routes = [
  {
    path: "/",
    name: "firtscene",
    component: FirstScene,
  },
  { path: "/second", name: "secondscene", component: SecondScene },
  { path: "/third", name: "thirdscene", component: ThirdScene },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

// router.beforeEach((to, from, next) => {
//   next();
// });

export default router;
