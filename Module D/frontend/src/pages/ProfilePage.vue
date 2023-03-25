<template>
  <div class="container">
    <h1>{{ user }}</h1>
    <div class="authored-games">
      <div v-if="games">
        <h3>Authored Games</h3>
        <GameList :games="games" />
      </div>
    </div>
    <div class="highscores w-50">
      <h3>High Scores</h3>
      <div v-if="highscores">
        <div
          class="d-flex justify-content-between"
          v-for="highscore in highscores"
          :key="highscore.id"
        >
          <div class="game">
            {{ highscore.game.title }}
          </div>
          <div class="score">
            {{ highscore.score }}
          </div>
        </div>
      </div>
      <div v-else>
        <p>No highscores.</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import GameList from "@/components/GameList.vue";
export default {
  name: "ProfilePage",
  data() {
    return {
      user: null,
      games: null,
      highscores: null,
    };
  },
  components: {
    GameList,
  },
  async created() {
    this.user = this.$route.params.username;
    await this.getUserDetails();
  },
  methods: {
    async getUserDetails() {
      try {
        const response = await axios.get(
          `http://localhost:8000/api/v1/users/${this.user}`
        );
        this.games = response.data.authoredGames;
        this.highscores = response.data.highscores;
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
