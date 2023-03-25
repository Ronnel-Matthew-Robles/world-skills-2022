<template>
  <div id="main-background" class="">
    <div id="background">
      <div class="question-area">
        <div class="question m-5">
          <h1 class="">{{ question }}</h1>
        </div>
        <div class="choices d-flex flex-wrap">
          <div
            class="border border-2 m-3 p-5 col-4"
            v-for="(item, index) in choices"
            :key="index"
            @click="checkAnswer(item)"
          >
            <h3>{{ item }}</h3>
          </div>
        </div>
        <div v-if="mistake">
          <p class="text-danger">{{ mistake }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "QuizPopUp",
  data() {
    return {
      mistake: null,
    };
  },
  props: {
    question: String,
    choices: Array,
    correctAnswer: String,
  },
  methods: {
    checkAnswer(choice) {
      if (choice != this.correctAnswer) {
        this.mistake = `${choice} is a wrong answer`;
      } else {
        this.$emit("toggleQuiz");
      }
    },
  },
};
</script>

<style scoped>
#main-background {
  top: 0;
  left: 0;
  width: 1280px;
  height: 720px;
  position: absolute;
  background-color: yellow;
  z-index: 100;
}
#background {
  background-color: white;
  width: 1000px;
  height: 520px;
  z-index: 101;
  margin: auto;
}
</style>
