(function() {
    'use strict';

    angular
        .module('roam.services')
        .factory('Search', Search);

    Search.$inject = ['$http'];
    /* @ngInject */

    function Search($http) {
        var service = {
            get: get
        };

        return service;

        function get(params) {
            return $http({
                url: 'api/search',
                method: 'GET',
                params: params
            });
        }
    }

})();
