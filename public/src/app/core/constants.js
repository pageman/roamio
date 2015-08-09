/* global toastr:false, moment:false */
(function() {
    'use strict';

    angular
      .module('roam.core')
      .constant('toastr', toastr)
      .constant('moment', moment)
      .constant('api', {
          url: '192.168.1.192:8080/api'
      })
})();
