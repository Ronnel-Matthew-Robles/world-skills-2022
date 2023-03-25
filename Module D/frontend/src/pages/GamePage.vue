<template>
  <div class="container">
    <h1>{{ game.title }}</h1>
    <iframe :src="iframeUrl" frameborder="0"></iframe>
    <div class="d-flex w-100">
      <div class="leaderboard w-100 pe-3">
        <h3>Top 10 Leaderboard</h3>
        <ol>
          <li
            class="d-flex justify-content-between"
            v-for="score in scores"
            :key="score.id"
          >
            <div>
              {{ score.username }}
            </div>
            <div>
              {{ score.score }}
            </div>
          </li>
        </ol>
      </div>
      <div class="description w-100 ps-3">
        <h3>Description</h3>
        <p>{{ game.description }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "GamePage",
  data() {
    return {
      game: null,
      iframeUrl: null,
      scores: [],
    };
  },
  async created() {
    const response = await axios.get(
      `http://localhost:8000/api/v1/games/${this.$route.params.slug}`
    );
    this.game = response.data;
    this.iframeUrl = `http://localhost:8000${response.data.gamePath}`;

    const scoreResponse = await axios.get(
      `http://localhost:8000/api/v1/games/${this.$route.params.slug}/scores`
    );
    this.scores = scoreResponse.data.scores;
  },
};
</script>
