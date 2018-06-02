var defineReport = function () {
    this.init = function () {
        console.log('toggle', '');
        
        this.toggleCustom($(':input[name="custom"]'));
    }

    this.toggleCustom = function(linkObj) {
        // console.log();
        
        $('.custom-class-file').attr({ hidden: !linkObj.prop('checked')}); 
    }
};