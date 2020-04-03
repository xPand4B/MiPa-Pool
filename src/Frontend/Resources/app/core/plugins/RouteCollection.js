export default class RouteCollection {

    /**
     * @param routes
     * @returns {[]|*[]}
     */
    constructor(routes = []) {
        this.routeCollection = [];

        this.resolveRoutes(routes);

        return this.routeCollection;
    }

    /**
     * Resolve all given routes.
     *
     * @param routes
     */
    resolveRoutes(routes = []) {
        routes.map((item, index) => {
            this.resolveLayout(item);
            this.resolveModule(item);
            this.resolveChildren(item);
        });

        this.routeCollection = routes;
    }

    /**
     * Resolve the layout per single route.
     *
     * @param item
     * @returns {*[]}
     */
    resolveLayout(item = []) {
        const {
            layout = ''
        } = item;

        if (!layout) {
            return item;
        }

        const moduleName = layout.toString().toLowerCase();

        item.component = () => import(`@modules/layout/page/layout-${moduleName}`);

        delete item.layout;

        return item;
    }

    /**
     * Resolve the module per single route.
     *
     * @param item
     * @returns {*[]}
     */
    resolveModule(item = []) {
        const {
            module = ''
        } = item;

        if (!module) {
            return item;
        }

        const moduleName = module.toString().toLowerCase().replace('.', '-');
        const moduleDir = moduleName.split('-')[0];

        item.name = moduleName.replace('-', '.');
        item.component = () => import(`@modules/${moduleDir}/page/${moduleName}`);

        delete item.module;

        return item;
    }

    /**
     * Resolve the children per route.
     *
     * @param item
     * @returns {*[]}
     */
    resolveChildren(item = []) {
        const {
            children = []
        } = item;

        if (children.length !== 0) {
            this.resolveRoutes(children);
        }

        return item;
    }
}