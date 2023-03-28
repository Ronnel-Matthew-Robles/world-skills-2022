import { createStore } from "vuex";
import userModule from "./modules/user";

const store = createStore(userModule);

export default store;
