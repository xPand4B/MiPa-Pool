import RouteCollection from "@plugins/RouteCollection";
import AuthMiddleware from "../../middleware/auth";

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
                // meta: {
                //     middleware: AuthMiddleware,
                // },
            },
            // {
            //     path: '/',
            //     module: 'order.update',
            // },
        ],
    }
]);
