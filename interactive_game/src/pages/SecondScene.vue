<template>
  <div
    class="game-container"
    tabindex="0"
    @keydown="moveAvatar"
    @click="moveAvatar"
  >
    <img id="background" src="@/assets/scene-2/background-scene-2.png" alt="" />
    <!-- <img id="game-title" src="@/assets/scene-2/game-title.png" alt="" /> -->
    <!-- <video
      controls
      id="scene-2-video"
      src="@/assets/scene-2-video.webm"
      autoplay
    ></video> -->
    <img id="scene-2-image" src="@/assets/scene-2-image.png" alt="" />
    <img id="main-area" src="@/assets/scene-2/main-area.png" alt="" />
    <img id="tree" src="@/assets/scene-2/tree.png" alt="" />
    <!-- <img
      id="street-sign-scene-2"
      src="@/assets/scene-2/street-sign-scene-2.png"
      alt=""
    /> -->
    <img
      id="avatar"
      :style="{ left: avatar.x + 'px', top: avatar.y + 'px' }"
      src="@/assets/scene-2/avatar.png"
      alt=""
    />
    <img id="grass" src="@/assets/scene-2/grass.png" alt="" />
    <img id="main-area" src="@/assets/scene-2/main-area.png" alt="" />
    <img
      id="fullscreen-button"
      src="@/assets/scene-2/fullscreen-button.png"
      alt=""
    />
    <img
      id="street-sign-next"
      src="@/assets/scene-2/street-sign-next.png"
      alt=""
    />
    <img id="grass2" src="@/assets/scene-2/grass.png" alt="" />
    <div v-if="!$store.state.secondScene">
      <div v-if="showBarrier">
        <img
          class="quiz-barrier"
          :style="{ left: barrier.x + 'px', top: barrier.y + 'px' }"
          src="@/assets/scene-2/quiz-barrier.png"
          alt=""
        />
      </div>
      <div v-if="showBarrier2">
        <img
          class="quiz-barrier"
          :style="{ left: barrier2.x + 'px', top: barrier2.y + 'px' }"
          src="@/assets/scene-2/quiz-barrier.png"
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
      <p v-if="showQuiz2">
        <QuizPopUp
          :question="question2.question"
          :choices="question2.choices"
          :correctAnswer="question2.correctAnswer"
          @toggleQuiz="toggleQuiz2"
        />
      </p>
    </div>
  </div>
</template>

<script>
import QuizPopUp from "@/components/QuizPopup.vue";

export default {
  name: "SecondScene",
  components: {
    QuizPopUp,
  },
  created() {
    if (this.$store.state.secondScene) {
      this.showBarrier = false;
      this.showBarrier2 = false;
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
      barrier: { x: 1000, y: 600 },
      barrier2: { x: 1200, y: 600 },
      showBarrier: true,
      showBarrier2: true,
      showQuiz: false,
      showQuiz2: false,
      moveToNextScene: false,
      question: {
        question: "Which is in <head>?",
        choices: ["meta", "body", "div", "textarea"],
        correctAnswer: "meta",
      },
      question2: {
        question: "Which is important content?",
        choices: ["b", "bold", "strong", "i"],
        correctAnswer: "strong",
      },
    };
  },
  watch: {
    moveToNextScene() {
      this.$router.push("/third");
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
            if (this.avatar.x <= 0) this.$router.push("/");
            break;
          case "ArrowRight":
            this.avatar.x += speed;
            if (this.avatar.x >= 1280) {
              if (this.showBarrier) {
                this.avatar.x = 1280;
              } else {
                this.nextScene();
              }
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
      localStorage.setItem("avatarX", this.avatar.x);
      localStorage.setItem("avatarY", this.avatar.y);
      if (this.showQuiz == false && this.detectCollision()) {
        this.showQuiz = true;
      }
      if (this.showQuiz2 == false && this.detectCollision2()) {
        this.showQuiz2 = true;
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
    },
    detectCollision2() {
      if (this.showBarrier2) {
        return this.avatar.x >= this.barrier2.x ? true : false;
      }
    },
    toggleQuiz2() {
      this.showQuiz2 = !this.showQuiz2;
      this.showBarrier2 = !this.showBarrier2;
      this.$store.commit("setScore");
    },
    nextScene() {
      this.$store.commit("setSecondScene");
      this.moveToNextScene = !this.moveToNextScene;
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

#street-sign-scene-1 {
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

#scene-2-image {
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

.quiz-barrier {
  z-index: 10;
  position: absolute;
  transform: translate(-50%, -50%);
}
</style>
