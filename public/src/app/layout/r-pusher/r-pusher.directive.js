(function() {
    'use strict';

    angular
        .module('roam.layout')
        .directive('rPusher', rPusher);

    rPusher.$inject = ['$animateCss'];
    /* @ngInject */

    function rPusher($animateCss) {

        var directive = {
            restrict: 'EA',
            scope: {
                rPusherOpen: '='
            },
            link: link
        };

        return directive;

        function link (scope, elem, attrs) {
            scope.$watch('rPusherOpen', function(rPusherOpen) {
                scope.rPusherOpen = rPusherOpen;
                if (scope.rPusherOpen) {
                    var animator = $animateCss(elem, {
                        addClass: 'r-pusher--open',
                    });
                } else {
                    animator = $animateCss(elem, {
                        removeClass: 'r-pusher--open',
                    });
                }
            });
        }
    }

})();
