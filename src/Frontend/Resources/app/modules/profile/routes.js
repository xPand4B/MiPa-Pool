import RouteCollection from "@plugins/RouteCollection";

export default new RouteCollection([
    {
        path: '/profile',
        layout: 'default',
        children: [
            {
                path: '/',
                module: 'profile.index',
            },
            // {
            //     path: '/update',
            //     module: 'profile.update',
            // },
        ]
    }
]);
