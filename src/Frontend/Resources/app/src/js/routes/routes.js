const routes = [
    {
        path: '/login',
        component: () => import('../layouts/layout-auth/AuthLayout'),
        children: [
            {
                path: '/',
                name: 'login',
                component: () => import('../pages/auth/Login')
            }
        ]
    },
    {
        path: '/register',
        component: () => import('../layouts/layout-auth/AuthLayout'),
        children: [
            {
                path: '/',
                name: 'register',
                component: () => import('../pages/auth/Register')
            }
        ]
    },

    {
        path: '/',
        component: () => import('../layouts/layout-default'),
        children: [
            {
                path: '/',
                name: 'order.index',
                component: () => import('../pages/order/index')
            },
            {
                path: 'profile',
                name: 'user.index',
                component: () => import('../pages/user/index')
            },
        ]
    }
];

export default routes;
