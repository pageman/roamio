(function() {
    'use strict';

    angular
        .module('roam.splash')
        .controller('SplashController', SplashController);

    SplashController.$inject = ['$state', '$q', 'logger', '$mdDialog', 'Roam'];
    /* @ngInject */
    function SplashController($state, $q, logger, $mdDialog, Roam) {
        var vm = this;

        vm.search = function() {
            Roam.addFilter('query', vm.query);
            $state.go('main');
        };

        activate();

        function activate() {
            var promises = [];
            return $q.all(promises).then(function() {
                logger.success('splash controller loaded!');
            });
        }
    }

})();
