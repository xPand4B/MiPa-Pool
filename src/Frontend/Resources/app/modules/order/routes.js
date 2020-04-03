import RouteCollection from "@plugins/RouteCollection";

export default new RouteCollection([
    {
        path: '/',
        layout: 'default',
        children: [
            // {
            //     path: '/',
            //     module: 'order.create',
            // },
            {
                path: '/',
                module: 'order.index',
            },
            // {
            //     path: '/',
            //     module: 'order.update',
            // },
        ]
    }
]);
