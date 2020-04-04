import VueRouter from "vue-router";
import RouteCollection from "@plugins/RouteCollection";
import Vue from "vue";

// Declare system routes
const systemRoutes = new RouteCollection([
    // nth
]);

// Get routes.js file from modules
const context = require.context('@modules', true, /\.\/[a-z-]+\/routes\.js$/);

// Merge system and module-routes
const routes = systemRoutes.concat(
    context.keys().reduce((accumulator, item) => {
        const module = context(item).default;

        return accumulator.concat(module);
    }, [])
);

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'hash',
    routes,
});
