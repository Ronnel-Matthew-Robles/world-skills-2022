import axios from "axios";

const state = {
  user: null,
  error: null,
};

const getters = {
  isLoggedIn(state) {
    console.log(state.user);
    return !!state.user;
  },
};

const actions = {
  async signUp({ commit }, { username, password }) {
    try {
      const response = await axios.post(
        "http://localhost/XX_module_c/api/v1/auth/signup",
        { username, password }
      );
      const { token, status } = response.data;
      if (status === "success") {
        localStorage.setItem("token", token);
        axios.defaults.headers.common.Authorization = `Bearer ${token}`;
        commit("setUser", username);
        return true;
      }
    } catch (e) {
      localStorage.removeItem("token");
      axios.defaults.headers.common.Authorization = null;
      console.log(e.response.data.errors.message);
      console.log(e);
      commit("signInFailure", e.response.data.message);
    }
  },

  async signIn({ commit }, { username, password }) {
    try {
      const response = await axios.post(
        "http://localhost:8000/api/v1/auth/signin",
        { username, password }
      );
      const { token, status } = response.data;
      if (status === "success") {
        localStorage.setItem("token", token);
        axios.defaults.headers.common.Authorization = `Bearer ${token}`;
        commit("setUser", username);
        return true;
      }
      return false;
    } catch (e) {
      localStorage.removeItem("token");
      axios.defaults.headers.common.Authorization = null;
      console.log(e);
      commit("signInFailure", e.response.data.message);
    }
  },

  signOut({ commit }) {
    localStorage.removeItem("token");
    delete axios.defaults.headers.common.Authorization;
    commit("setUser", null);
  },
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  signInFailure(state, error) {
    state.error = error;
  },
};

export default {
  state,
  getters,
  actions,
  mutations,
};
