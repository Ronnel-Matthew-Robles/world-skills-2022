<template>
  <div>
    <header>
      <nav class="d-flex justify-content-between">
        <div class="logo m-3 p-2 border border-2">
          <router-link to="/" class="text-reset text-decoration-none"
            ><h1>WorldSkills: Games</h1></router-link
          >
        </div>

        <ul class="d-flex align-items-center">
          <div class="m-3" v-if="isLoggedIn">
            <router-link
              :to="{ name: 'profile', params: { username: $store.state.user } }"
              >{{ $store.state.user }}</router-link
            >
          </div>
          <div class="m-3" v-if="!isLoggedIn">
            <router-link to="/signup" class="text-decoration-none text-reset"
              >Sign Up</router-link
            >
          </div>
          <div class="m-3" v-if="!isLoggedIn">
            <router-link to="/signin" class="text-decoration-none text-reset"
              >Sign In</router-link
            >
          </div>
          <div class="m-3" v-if="isLoggedIn">
            <button class="btn" @click="onSignOut">Sign Out</button>
          </div>
        </ul>
      </nav>
    </header>
    <hr />
    <main>
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap";
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
  name: "App",
  computed: mapGetters(["isLoggedIn"]),
  methods: {
    ...mapActions(["signOut"]),
    async onSignOut() {
      await this.signOut();
      this.$router.push("/signout");
    },
  },
};
</script>
