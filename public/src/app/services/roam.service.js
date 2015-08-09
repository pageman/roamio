(function() {
    'use strict';

    angular
        .module('roam.services')
        .service('Roam', Roam);

    Roam.$inject = [];
    /* @ngInject */

    function Roam() {

        var filters = {};

        var service = {
            getFilters   : getFilters,
            addFilter    : addFilter,
            removeFilter : removeFilter
        };

        return service;

        function getFilters() {
            return filters;
        }

        function addFilter(key, value) {
            filters[key] = value;
        }

        function removeFilter(field) {
            delete filters[field];
        }

    }

})();
