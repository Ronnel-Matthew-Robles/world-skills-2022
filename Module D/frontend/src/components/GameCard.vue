<template>
  <router-link
    :to="{ name: 'game', params: { slug: game.slug } }"
    class="text-decoration-none text-reset"
  >
    <div class="card flex-row flex-wrap p-3">
      <div class="card-header border-0">
        <div v-if="game.thumbnail">
          <img
            :src="`http://localhost:8000${game.thumbnail}`"
            style="max-height: 200px"
            :alt="game.title"
          />
        </div>
        <div v-else>
          <div
            style="width: 200px; height: 200px; background-color: gray"
          ></div>
        </div>
      </div>
      <div class="card-block px-2 w-75">
        <div class="d-flex justify-content-between">
          <div class="d-flex align-items-center">
            <h5 class="card-title">{{ game.title }}</h5>
            <p class="card-text">&nbsp;by {{ game.author }}</p>
          </div>
          <div class="score"># scores submitted: {{ game.scoreCount }}</div>
        </div>
        <p class="card-text">{{ game.description }}</p>
      </div>
    </div>
  </router-link>
</template>

<script>
export default {
  name: "GameCard",
  props: {
    game: {
      type: Object,
      required: true,
    },
  },
};
</script>
