<template>
  <div class="container">
    <div v-for="game in games" :key="game.slug" class="m-2">
      <GameCard :game="game" />
    </div>
  </div>
</template>

<script>
import GameCard from "./GameCard.vue";

export default {
  name: "GameList",
  props: {
    games: {
      type: Array,
      required: true,
    },
  },
  components: {
    GameCard,
  },
};
</script>
