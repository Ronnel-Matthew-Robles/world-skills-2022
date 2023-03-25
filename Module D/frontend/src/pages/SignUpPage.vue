<template>
  <div class="container">
    <h1 class="mb-3">Sign Up</h1>
    <div class="container border border-2 p-5">
      <form
        @submit.prevent="onSubmit"
        class="w-50 m-auto p-3 border border-2 d-flex flex-column"
      >
        <div class="mb-3">
          <label class="form-label"> Username: </label>
          <input
            class="form-control"
            type="text"
            v-model="form.username"
            placeholder="player1"
            required
          />
        </div>
        <div class="mb-3">
          <label class="form-label"> Password: </label>
          <input
            class="form-control"
            type="password"
            v-model="form.password"
            placeholder="***********"
            required
          />
        </div>
        <p v-if="$store.state.error">{{ $store.state.error }}</p>

        <button type="submit" class="btn btn-primary">Sign Up</button>
      </form>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "SignUpPage",
  data() {
    return {
      form: {
        username: "",
        password: "",
      },
      error: null,
    };
  },
  methods: {
    ...mapActions(["signUp"]),
    async onSubmit() {
      try {
        const isSignedUp = await this.signUp(this.form);
        if (isSignedUp) {
          this.$router.push("/");
        }
      } catch (e) {
        this.error = e.response.data.message;
      }
    },
  },
};
</script>
