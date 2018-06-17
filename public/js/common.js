var resourcesObj;
var CRO;
var resourceName;
var moduleName;

var getCurResObj = function() {
    return resourcesObj;
};

var getResourceName = function(){
    return _.kebabCase(resourceName);
};
var getControllerName = function(){
    return _.kebabCase(resourceName);
};

var getModuleName = function(){
    return _.toLower(moduleName);
};

// ============ To initiate the resource Obj dynamically ===========
(function(){
    if(!_.isEmpty(resourceName)) {
        eval('resourcesObj = new '+ resourceName +'()')
        CRO = resourcesObj;
        resourcesObj.init();
    }
})();