
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

// Material Dashboard
    // Core JS Files
    require('../../node_modules/material-dashboard/assets/js/core/jquery.min');
    require('../../node_modules/material-dashboard/assets/js/core/popper.min');
    require('../../node_modules/material-dashboard/assets/js/core/bootstrap-material-design.min');
    // Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/
    require('../../node_modules/material-dashboard/assets/js/plugins/bootstrap-notify');
    // Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/
    require('../../node_modules/material-dashboard/assets/js/plugins/chartist.min.js');
    // Plugin for Scrollbar documentation here: https://github.com/utatti/perfect-scrollbar
    require('../../node_modules/material-dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js');
    // Material Dashboard Core initialisations of plugins and Bootstrap Material Design Library
    require('../../node_modules/material-dashboard/assets/js/material-dashboard.js?v=2.1.0');