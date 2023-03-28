<template>
  <div>
    <div v-if="name">
      <h1>Hello {{ name }}</h1>
    </div>
    <div v-else>
      <p>Loading...</p>
    </div>

    <button @click="getUser()" class="btn btn-primary">Get</button>
  </div>
</template>

<script>
export default {
  name: "ProfileCard",
  data() {
    return {
      name: null,
    };
  },
  methods: {
    async getUser() {
      const res = await fetch("https://randomuser.me/api");
      const data = await res.json();
      this.name = data.results[0].name.first;
    },
  },
};
</script>
