import {
    Icon
} from "./components";

const GlobalComponents = {
    install(Vue) {
        Vue.component('icon', Icon);
    }
};

export default GlobalComponents;
