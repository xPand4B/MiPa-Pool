import RouteCollection from "@plugins/RouteCollection";

export default new RouteCollection([
    {
        path: '/login',
        layout: 'auth',
        children: [
            {
                path: '',
                module: 'auth.login',
            }
        ]
    }
]);
