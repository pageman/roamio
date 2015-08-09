(function() {
    'use strict';

    angular
        .module('roam.activity')
        .run(appRun);

    appRun.$inject = ['routerHelper'];
    /* @ngInject */
    function appRun(routerHelper) {
        routerHelper.configureStates(getStates());
    }

    function getStates() {
        return [
            {
                state: 'activity',
                config: {
                    url: '/activity/:id',
                    templateUrl: 'app/activity/activity.html',
                    controller: 'ActivityController',
                    controllerAs: 'vm',
                    resolve: {
                        activity: ['$stateParams', 'Activity', function($stateParams, Activity) {
                            return Activity.get($stateParams.id);
                        }]
                    }
                }
            }
        ];
    }
})();
