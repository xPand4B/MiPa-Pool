export default {
    install(Vue) {
        const context = require.context('./', true, /\.\/[a-z-]+\/index\.vue$/);

        context.keys().reduce((accumulator, item) => {
            const component = context(item).default;
            const componentName = component.name.toLowerCase();

            Vue.component(componentName, () => import(`@components/global/${componentName}`));
        }, []);
    }
}
