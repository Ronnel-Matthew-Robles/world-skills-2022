<template>
  <div class="container">
    <GamesHeader
      :totalElements="totalElements"
      @setSortBy="setSortBy"
      @setOrderBy="setOrderBy"
    />
    <GameList :games="games" />
  </div>
</template>

<script>
import axios from "axios";
import GamesHeader from "@/components/GamesHeader.vue";
import GameList from "@/components/GameList.vue";

export default {
  name: "GamesPage",
  components: {
    GamesHeader,
    GameList,
  },
  data() {
    return {
      games: [],
      currentPage: 0,
      pageSize: 30,
      totalElements: 0,
      loading: false,
      sortBy: "title", // initial value for sortBy
      orderBy: "asc", // initial value for orderBy
    };
  },

  async created() {
    await this.loadGames();
  },

  methods: {
    async loadGames() {
      this.loading = true;
      try {
        const response = await axios.get("http://localhost:8000/api/v1/games", {
          params: {
            page: this.currentPage,
            size: this.pageSize,
            sortBy: this.sortBy || undefined,
            sortDir: this.orderBy || undefined,
          },
        });
        this.games = response.data.content;
        this.totalElements = response.data.totalElements;
      } catch (error) {
        console.error(error);
      } finally {
        this.loading = false;
      }
    },
    async setSortBy(q) {
      this.sortBy = q;
      this.loadGames();
    },
    async setOrderBy(q) {
      this.orderBy = q;
      this.loadGames();
    },
  },
};
</script>
