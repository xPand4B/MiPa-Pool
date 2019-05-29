
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

window.Vue = require('vue');

// Material Dashboard
    // Core JS Files
    require('../../node_modules/material-dashboard/assets/js/core/jquery.min.js');
    require('../../node_modules/material-dashboard/assets/js/core/popper.min.js');
    require('../../node_modules/material-dashboard/assets/js/core/bootstrap-material-design.min.js');

    // Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/
    require('../../node_modules/material-dashboard/assets/js/plugins/bootstrap-notify.js');

    // Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/
    require('../../node_modules/material-dashboard/assets/js/plugins/chartist.min.js');

    // Plugin for Scrollbar documentation here: https://github.com/utatti/perfect-scrollbar
    require('../../node_modules/material-dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js');

    // Material Dashboard Core initialisations of plugins and Bootstrap Material Design Library
    require('../../node_modules/material-dashboard/assets/js/material-dashboard.js?v=2.1.0');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
