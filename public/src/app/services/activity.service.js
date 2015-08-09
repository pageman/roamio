(function() {
    'use strict';

    angular
        .module('roam.services')
        .factory('Activity', Activity);

    Activity.$inject = ['$http'];
    /* @ngInject */

    function Activity($http) {
        var service = {
            get: get
        };

        return service;

        function get(id) {
            return $http({
                url: 'api/get-by-id/' + id,
                method: 'GET'
            });
        }
    }

})();
