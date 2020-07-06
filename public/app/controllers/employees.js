app.controller('employeesController', function ($scope, $http, API_URL) {

    //fetch customers listing from
    $http({
        method: 'GET',
        url: API_URL + "employees"
    }).then(function (response) {
        $scope.employees = response.data.employees;
        $scope.assignments = response.data.assignments;
        console.log(response.data);
    }, function (error) {
        console.log(error);
        alert('There was an error retrieving employees');
    });

    $scope.schedule = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    $scope.saveEmployee = function (state, id) {
        var url = API_URL + "employees";
        var method = "POST";
        console.log(state);
        //append employee id to the URL if the form is in edit mode
        if (state === 'edit') {
            url += "/" + id;

            method = "PUT";
        }
        console.log(id)
        $http({
            method: method,
            url: url,
            data: $.param($scope.employee),
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function (response) {
            console.log(response);
            location.reload();
        }), (function (error) {
            console.log(error);
            alert('Error: Saving Employee');
        });
    }
    $scope.scheduleEmployee = function(employee, id){

        var assignment = {'title': employee.assignment.title, 'user_id': id};
        var url = API_URL + "assignments";
        var method = "POST";
        $http({
            method: method,
            url: url,
            data: $.param(assignment),
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function (response) {
            console.log(response);
            //location.reload();
        }), (function (error) {
            console.log(error);
            alert('Error: Saving Assignment');
        });

    }

    $scope.setEmployee = function(key = null){
        if(key || key == 0){
            $scope.edit = true;
            $scope.employee = $scope.employees[key];
        }else{
            $scope.edit = false;
            $scope.employee = [];
        }

    }
    //delete record
    $scope.delete = function (id, record = 'employees') {

        console.log(id);
            $http({
                method: 'DELETE',
                url: API_URL + record + '/' + id
            }).then(function (response) {
                console.log(response);
                location.reload();
            }, function (error) {
                console.log(error);
                alert('Unable to delete');
            });
    }
});
