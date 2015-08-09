(function() {
    'use strict';

    angular
        .module('roam.splash')
        .run(appRun);

    appRun.$inject = ['routerHelper'];
    /* @ngInject */
    function appRun(routerHelper) {
        routerHelper.configureStates(getStates());
    }

    function getStates() {
        return [
            {
                state: 'splash',
                config: {
                    url: '/',
                    templateUrl: 'app/splash/splash.html',
                    controller: 'SplashController',
                    controllerAs: 'vm',
                    resolve: {
                    }
                }
            }
        ];
    }
})();
