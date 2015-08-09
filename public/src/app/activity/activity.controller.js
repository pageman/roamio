(function() {
    'use strict';

    angular
        .module('roam.activity')
        .controller('ActivityController', ActivityController);

    ActivityController.$inject = ['$state', 'activity', '$q', 'logger'];
    /* @ngInject */
    function ActivityController($state, activity, $q, logger) {
        var vm = this;
        activate();

        function activate() {
            var promises = [activity];
            return $q.all(promises).then(function() {
                logger.success('activity controller loaded!');
                vm.activity = activity.data;
            });
        }
    }

})();
