<template>
  <div
    class="game-container"
    tabindex="0"
    @keydown="moveAvatar"
    @click="moveAvatar"
  >
    <img id="background" src="@/assets/scene-3/background-scene-3.png" alt="" />
    <!-- <img id="game-title" src="@/assets/scene-3/game-title.png" alt="" /> -->
    <video
      controls
      id="scene-3-video"
      src="@/assets/scene-3-video.webm"
      autoplay
    ></video>
    <img id="main-area" src="@/assets/scene-3/main-area.png" alt="" />
    <img id="tree" src="@/assets/scene-3/tree.png" alt="" />
    <!-- <img
      id="street-sign-scene-3"
      src="@/assets/scene-3/street-sign-scene-3.png"
      alt=""
    /> -->
    <img
      id="avatar"
      :style="{ left: avatar.x + 'px', top: avatar.y + 'px' }"
      src="@/assets/scene-3/avatar.png"
      alt=""
    />
    <img id="grass" src="@/assets/scene-3/grass.png" alt="" />
    <img id="main-area" src="@/assets/scene-3/main-area.png" alt="" />
    <img
      id="fullscreen-button"
      src="@/assets/scene-3/fullscreen-button.png"
      alt=""
    />
    <!-- <img
      id="street-sign-next"
      src="@/assets/scene-3/street-sign-next.png"
      alt=""
    /> -->
    <img id="grass2" src="@/assets/scene-3/grass.png" alt="" />
    <div v-if="!$store.state.thirdScene">
      <div v-if="showBarrier">
        <img
          id="quiz-barrier"
          :style="{ left: barrier.x + 'px', top: barrier.y + 'px' }"
          src="@/assets/scene-3/quiz-barrier.png"
          alt=""
        />
      </div>
      <p v-if="showQuiz">
        <QuizPopUp
          :question="question.question"
          :choices="question.choices"
          :correctAnswer="question.correctAnswer"
          @toggleQuiz="toggleQuiz"
        />
      </p>
    </div>
    <div v-else>
      {{ $store.state.score }}
    </div>
  </div>
</template>

<script>
import QuizPopUp from "@/components/QuizPopup.vue";

export default {
  name: "ThirdScene",
  components: {
    QuizPopUp,
  },
  created() {
    if (this.thirdSceneCompleted) {
      this.showBarrier = false;
    }
  },
  mounted() {
    this.$el.focus();
  },
  data() {
    return {
      avatar: {
        x: 200,
        y: 500,
      },
      barrier: { x: 1200, y: 600 },
      showBarrier: true,
      showQuiz: false,
      moveToNextScene: false,
      showScore: false,
      question: {
        question: "Who is accessibility for?",
        choices: ["Disabled People", "Old People", "Blind People", "Every One"],
        correctAnswer: "Every One",
      },
      score: 0,
    };
  },
  watch: {
    moveToNextScene() {
      this.$router.push("/second");
    },
  },
  methods: {
    moveAvatar(event) {
      if (event.type == "click") {
        const screenX = event.screenX;
        const screenY = event.screenY;
        if (
          screenX >= 0 &&
          screenX <= 1280 &&
          screenY <= 720 &&
          screenY >= 520
        ) {
          this.avatar.x = screenX;
          this.avatar.y = screenY;
        }
      } else {
        const speed = 30;
        switch (event.key) {
          case "ArrowLeft":
            this.avatar.x -= speed;
            if (this.avatar.x < 0) this.$router.push("/second");
            break;
          case "ArrowRight":
            this.avatar.x += speed;
            if (this.avatar.x >= 1280) {
              this.avatar.x = 1280;
            }
            break;
          case "ArrowUp":
            this.avatar.y -= speed;
            if (this.avatar.y < 520) this.avatar.y = 520;
            break;
          case "ArrowDown":
            this.avatar.y -= speed;
            if (this.avatar.y > 0) this.avatar.y = 720;
            break;
        }
      }

      if (this.showQuiz == false && this.detectCollision()) {
        this.showQuiz = true;
      }
    },
    detectCollision() {
      if (this.showBarrier) {
        return this.avatar.x >= this.barrier.x ? true : false;
      }
    },
    toggleQuiz() {
      this.showQuiz = !this.showQuiz;
      this.showBarrier = !this.showBarrier;
      this.$store.commit("setScore");
      this.$store.commit("setThirdScene");
    },
    prevScene() {
      // this.moveToNextScene = !this.moveToNextScene;
    },
  },
};
</script>

<style scoped>
#background {
  width: 1280px;
  height: 720px;
}

#game-title {
  width: 352px;
  height: 68px;
  position: absolute;
  top: 77px;
  left: 205px;
  z-index: 7;
  transform: translate(-50%, -50%) rotate(-7deg);
}

#tree {
  left: 215px;
  top: 424px;
  width: 301px;
  height: 367px;
  z-index: 2;
  position: absolute;
  transform: translate(-50%, -80%);
}

#street-sign-scene-3 {
  left: 92px;
  top: 424px;
  width: 125px;
  height: 127px;
  z-index: 5;
  position: absolute;
  transform: translate(-50%, -50%);
}

#avatar {
  width: 48px;
  height: 94px;
  z-index: 99;
  position: absolute;
  transform: translate(-50%, -50%);
}

#grass {
  left: 303px;
  top: 424px;
  width: 125px;
  height: 86px;
  z-index: 3;
  position: absolute;
  transform: translate(-50%, -50%);
}

#scene-3-video {
  left: 649px;
  top: 252px;
  width: 733px;
  height: 424px;
  z-index: 2;
  position: absolute;
  transform: translate(-50%, -50%);
}

#main-area {
  left: 649px;
  top: 252px;
  width: 733px;
  height: 424px;
  z-index: 1;
  position: absolute;
  transform: translate(-50%, -50%);
}

#fullscreen-button {
  left: 1154px;
  top: 56px;
  width: 205px;
  height: 69px;
  z-index: 8;
  position: absolute;
  transform: translate(-50%, -50%);
}

#street-sign-next {
  left: 1197px;
  top: 416px;
  width: 138px;
  height: 127px;
  z-index: 6;
  position: absolute;
  transform: translate(-50%, -50%);
}

#grass2 {
  left: 936px;
  top: 436px;
  width: 125px;
  height: 86px;
  z-index: 4;
  position: absolute;
  transform: translate(-50%, -50%);
}

#quiz-barrier {
  z-index: 10;
  position: absolute;
  transform: translate(-50%, -50%);
}
</style>
