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

const router = new VueRouter({
    mode: 'hash',
    routes,
});

// Creates a `nextMiddleware()` function which not only
// runs the default `next()` callback but also triggers
// the subsequent Middleware function.
function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];

    // If no subsequent Middleware exists, the default `next()` callback is returned.
    if (!subsequentMiddleware) {
        return context.next;
    }

    return (...parameters) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters);

        // Then run the subsequent Middleware with a new `nextMiddleware()` callback.
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({
            ...context, next: nextMiddleware
        });
    };
}

router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware) ? to.meta.middleware : [to.meta.middleware];

        const context = {
            from, next, router, to,
        };

        const nextMiddleware = nextFactory(context, middleware, 1);

        return middleware[0]({
            ...context, next: nextMiddleware
        });
    }

    return next();
});

export default router;