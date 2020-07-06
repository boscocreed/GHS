<!doctype html>
<html lang="en" ng-app="employeeApp">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Gale Healthcare Employees</title>
    </head>
    <body ng-controller="employeesController">

    <div class="row">
    <div class="pt-10 col-md-6" style="margin-left:20px;">
        <h1 class="text-center">Add employee</h1>

        <form name="form-employee">
            @csrf
            <div class="form-group">
                <label for="firstName">Name</label>
                <input type="text" class="form-control" id="Name" name="name" ng-model="employee.name" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" ng-model="employee.email" />
            </div>

            <button ng-if="!edit"ng-click="saveEmployee();" class="btn btn-primary mb-2">Add employee</button>
            <button ng-if="edit" class="btn btn-default" ng-click="setEmployee()">back</button>
            <button ng-if="edit" type="submit" class="btn btn-success" ng-click="saveEmployee('edit', employee.id);">Update</button>
        </form>
    </div>
    </div>


    <div class="row" style="flex-wrap:nowrap;">
    <div class="pt-10 col-md-6" style="margin-left:20px;">
        <h1 class="text-center">All employees</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</>
                    <th scope="col">Assign/Unassign</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="(e_key, e) in employees">
                    <th scope="row">
                    <button type="button" ng-click="setEmployee(e_key);" class="btn btn-info">Edit</button>
                    <a class="btn btn-danger" ng-click="delete(e.id);">Delete</a>

                    </th>
                    <td>@{{ e.id }}</td>
                    <td>@{{ ::e.name }}</td>
                    <td>@{{ ::e.email }}</td>
                    <td>
                    <select
                        style="width:400px;"
                        ng-model="e.assignment.title"
                        ng-options="x for x in schedule"
                        ng-change="scheduleEmployee( e, e.id);"
                        >
                        <option value="Day"></option>
                    </select>
                    <button ng-if="e.assignment" class="btn btn-primary" ng-click="delete(e.assignment.id, 'assignments')">Unassign</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="accordion col-md-6" id="accordionExample" >
        <div class="card" ng-repeat="day in schedule">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button"  aria-expanded="true" aria-controls="collapse">
                    @{{day}}
                    </button>
                </h2>
            </div>

            <div id="collapse" class="collapse show" aria-labelledby="heading" data-parent="#accordionExample">
                <div class="card-body">
                <ul class="list-group list-group-flush" ng-repeat="e in employees" ng-if="e.assignment.title == day">
                    <li class="list-group-item">@{{e.name}}</li>

                </ul>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular-route.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- AngularJS Application Scripts -->
    <script src="<?= asset('app/app.js') ?>"></script>
    <script src="<?= asset('app/controllers/employees.js') ?>"></script>
    </body>
</html>
