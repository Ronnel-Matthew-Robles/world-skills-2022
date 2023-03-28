import { createRouter, createWebHistory } from "vue-router";
import store from "@/store";
import SignInPage from "@/pages/SignInPage.vue";
import SignUpPage from "@/pages/SignUpPage.vue";
import SignOutPage from "@/pages/SignOutPage.vue";
import GamesPage from "@/pages/GamesPage.vue";
import GamePage from "@/pages/GamePage.vue";
import ProfilePage from "@/pages/ProfilePage.vue";

const routes = [
  {
    path: "/",
    name: "games",
    component: GamesPage,
    meta: {
      title: "Games",
    },
  },
  {
    path: "/signin",
    name: "signin",
    component: SignInPage,
    meta: {
      title: "Sign In",
    },
  },
  {
    path: "/signup",
    name: "signup",
    component: SignUpPage,
    meta: {
      title: "Sign Up",
    },
  },
  {
    path: "/signout",
    name: "signout",
    component: SignOutPage,
    meta: {
      title: "Sign Out",
    },
  },
  {
    path: "/games/:slug",
    name: "game",
    component: GamePage,
    meta: {
      title: "Game",
      requiresAuth: true,
    },
  },
  {
    path: "/profile/:username",
    name: "profile",
    component: ProfilePage,
    meta: {
      title: "Profile",
    },
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  // Get the page title from the route meta data that we have defined
  const title = to.meta.title;

  //Take the title from the parameters
  const titleFromParams = to.params.slug || to.params.username;
  // If the route has a title, set it as the page title of the document/page
  if (title) {
    document.title = title;
  }
  // If we have a title from the params, extend the title with the title
  // from our params
  if (titleFromParams) {
    document.title = `${titleFromParams} - ${document.title}`;
  }

  if (to.meta.requiresAuth && !store.getters["isLoggedIn"]) {
    next({ name: "signin" });
  } else {
    next();
  }
});

export default router;
