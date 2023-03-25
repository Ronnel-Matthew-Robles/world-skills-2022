import { createStore } from "vuex";

const state = {
  score: 0,
  firstScene: false,
  secondScene: false,
  thirdScene: false,
};

const getters = {
  getScore(state) {
    return state.score;
  },

  isFirstSceneCompleted(state) {
    return state.firstScene;
  },

  isSecondSceneCompleted(state) {
    return state.secondScene;
  },

  isThirdSceneCompleted(state) {
    return state.thirdScene;
  },
};

const actions = {
  addScore({ commit }) {
    commit("setScore");
  },

  firstCompleted({ commit }) {
    commit("setFirstScene");
  },

  secondCompleted({ commit }) {
    commit("setSecondScene");
  },

  thirdCompleted({ commit }) {
    commit("setThirdScene");
  },
};

const mutations = {
  setScore(state) {
    state.score += 1;
  },
  setFirstScene(state) {
    state.firstScene = true;
  },
  setSecondScene(state) {
    state.secondScene = true;
  },
  setThirdScene(state) {
    state.thirdScene = true;
  },
};

const store = createStore({
  state,
  getters,
  actions,
  mutations,
});

export default store;
