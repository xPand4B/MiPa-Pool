export default function AuthMiddleware({ from, to, next, router }) {
    if (localStorage.getItem('jwt')) {
        return next();
    }

    return router.push({
        name: 'auth.login'
    });
};