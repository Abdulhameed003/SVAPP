angular.module("myApp", ["ngTable", "ngTableDemos"]);

(function() {
  "use strict";

  angular.module("myApp").controller("demoController", demoController);
  
  demoController.$inject = ["NgTableParams", "ngTableSimpleList"];

  function demoController(NgTableParams, simpleList) {
    var self = this;
    self.tableParams = new NgTableParams({}, {
      dataset: simpleList
    });
  }
})();

(function() {
  "use strict";

  angular.module("myApp").controller("dynamicDemoController", dynamicDemoController);
  dynamicDemoController.$inject = ["NgTableParams", "ngTableSimpleList"];

  function dynamicDemoController(NgTableParams, simpleList) {
    var self = this;
    
    self.cols = [
      { field: "name", title: "Name", show: true },
      { field: "age", title: "Age", show: true },
      { field: "money", title: "Money", show: true }
    ];
    self.tableParams = new NgTableParams({}, {
      dataset: simpleList
    });
  }
})();

(function() {
  "use strict";

  angular.module("myApp").run(configureDefaults);
  configureDefaults.$inject = ["ngTableDefaults"];

  function configureDefaults(ngTableDefaults) {
    ngTableDefaults.params.count = 5;
    ngTableDefaults.settings.counts = [];
  }
})();