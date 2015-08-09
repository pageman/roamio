(function() {
    'use strict';

    angular
        .module('roam.core')
        .factory('Resource', Resource);

    Resource.$inject = ['$resource'];
    /* @ngInject */
    function Resource($resource) {

        var defaults = {
            update: {method: 'put', isArray: false},
            create: {method: 'post'}
        };

        methods = angular.extend(defaults, methods);

        var resource = $resource(url, params, methods);

        resource.prototype.$save = function() {
            if (!this._id) {
                return this.$create();
            } else {
                return this.$update({id: this._id});
            }
        };

        return resource;
    }
})();
