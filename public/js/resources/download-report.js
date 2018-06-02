var downloadReport = function() {

    this.init = function() {
        this.onGroupChange($(':input[name="group"]'));
        
    }

    this.onGroupChange = function (linkObj) {
        this.setReportList(linkObj);
        this.setFilterForm(linkObj);
    }

    this.setReportList = function (linkObj) {
        var data = { group_name: linkObj.val() };
        axios.post('/rpt/download-report/get-report-list', data).then(function (response) {
            $(':input[name="report"]').closest('.col').html(response.data);
        }).catch(function (error) {
            console.error(error);
        });
    }

    this.setFilterForm = function(linkObj) {
        // console.log(linkObj);
        var fiterFormDiv = $('.filter');
        axios.post('/rpt/download-report/get-group-form', { group_name: linkObj.val()})
        .then(function (response) {
            // console.log(response.data);
            fiterFormDiv.html(response.data);
        }).catch(function (error) { 
            console.error(error.message);
        });
    }


};