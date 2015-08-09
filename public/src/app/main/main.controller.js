(function() {
    'use strict';

    angular
        .module('roam.main')
        .controller('MainController', MainController);

    MainController.$inject = ['$state', '$q', 'logger', '$mdSidenav',
        'Roam', 'Search'];
    /* @ngInject */
    function MainController($state, $q, logger, $mdSidenav,
            Roam, Search) {
        var vm = this;
        vm.sidenavOpen = false;
        vm.filters = Roam.getFilters();
        vm.filtersSet = !angular.equals({}, vm.filters);
        vm.activities = [];

        activate();

        vm.toggleSideNav = function(e) {
            vm.sidenavOpen = !vm.sidenavOpen;
        };

        vm.onChange = function(field, value) {
            if (!value) {
                Roam.removeFilter(field);
            } else {
                Roam.addFilter(field, value);
            }
            Search.get(Roam.getFilters()).then(function (re) {
                vm.activities = re.data;
            });
        };

        vm.toggleFilterChange = function(field, value) {
            if (vm[field] === value) {
                vm[field] = '';
                Roam.removeFilter(field);
            } else {
                vm[field] = value;
                Roam.addFilter(field, vm[field]);
            }

            Search.get(Roam.getFilters()).then(function (re) {
                vm.activities = re.data;
            });
        };

        function activate() {
            var promises = [getAllActivities()];
            return $q.all(promises).then(function(arr) {
                vm.activities = arr[0].data;
            });
        }

        function getAllActivities() {
            vm.activities = Search.get(vm.filters);
            return vm.activities;
        }

    }

})();
