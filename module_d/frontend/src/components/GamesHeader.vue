<template>
  <div class="games-header d-flex align-items-center justify-content-between">
    <h3 class="m-5">{{ totalElements }} games available</h3>
    <div class="sortByFilters d-flex">
      <button
        @click="setSortBy('popular')"
        class="btn border border-2 border-radius-10 m-2"
      >
        Popularity
      </button>
      <button
        @click="setSortBy('uploaddate')"
        class="btn border border-2 border-radius-10 m-2"
      >
        Recently Uploaded
      </button>
      <button
        @click="setSortBy('title')"
        class="btn border border-2 border-radius-10 m-2"
      >
        Alphabetically
      </button>
    </div>
    <div class="orderByFilters d-flex">
      <button
        @click="setOrderBy('asc')"
        class="btn border border-2 border-radius-10"
      >
        ASC
      </button>
      <button
        @click="setOrderBy('desc')"
        class="btn border border-2 border-radius-10"
      >
        DSC
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "GamesHeader",
  props: {
    totalElements: {
      type: Number,
      required: true,
    },
  },
  methods: {
    setSortBy(sortBy) {
      this.$emit("setSortBy", sortBy);
    },
    setOrderBy(orderBy) {
      this.$emit("setOrderBy", orderBy);
    },
  },
};
</script>
