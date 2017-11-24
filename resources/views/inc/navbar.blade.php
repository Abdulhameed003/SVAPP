 <nav class="bar" style="height:50px;width:100%;position:fixed; top:3%;left:0%;">
    <button type="button" class="btn btn-link mainbutton" ng-click="callProject(); setTabletoDefault()" style="position:fixed;top:3%;left:100px;">Projects</button>
    <button type="button" class="btn btn-link mainbutton" style="position:fixed;top:3%;left:250px;" ng-click="callCompany()">Companies</button>
    <button type="button" class="btn btn-link mainbutton" style="position:fixed;top:3%;left:400px;" ng-click="callContact()">Contacts</button>
    <button type="button" class="btn btn-link mainbutton" style="position:fixed;top:3%;left:550px;" ng-click="callSalesperson()">Sales Persons</button>
    <button type="button" class="btn btn-link mainbutton" style="position:fixed;top:3%;left:700px;">Dashboard</button>
    
    <div class="dropdown navdropdown" style="top:3%;left:88%;" ng-controller="MyControllerModal">
        <button type="button" class="btn btn-link mainbutton1" id="usernamebtn">Username</button>
        <div class="dropdown-content">
            <a href="#" ng-click="openchangepassword('sm')">Change password</a>
            <a href="index.html">Sign out</a>
        </div>
    </div>

    <div class="dropdown navdropdown" style=" top:3%;left:84.3%;">
        <button class="btn-link mainbutton1 barIcon">
            <span class="glyphicon glyphicon-plus-sign" style="color:white; font-size:20px; padding-top:5px;"></span>
        </button>
        <div class="dropdown-content" role="menu" aria-labelledby="dropdownMenu" ng-controller="MyControllerModal">
            <div class="dropdown-submenu">
                <a tabindex="-1" href="#">Add Project</a>
                <div class="dropdown-content">

                    <a tabindex="-1" href="#" ng-click="openL('sm')">Lead</a>
                    <a href="#" ng-click="openD('sm')">Deal</a>

                </div>
            </div>

            <a href="#" ng-click="opencontact('sm')">Add Contact</a>
            <a href="#" ng-click="opensalesperson('sm')">Add Sales Person</a>
        </div>
    </div>

    <div class="dropdown navdropdown" style="top:3.1%;left:80.5%;" ng-controller="MyControllerModal">
        <button class="btn-link mainbutton1 barIcon">
            <span>
                <img src="image/settings.png" style="height:22px; width:22px;">
            </span>
        </button>
        <div class="dropdown-content">
            <a href="#" ng-click="openindustry('sm')">Edit industry</a>
            <a href="#" ng-click="openproduct('sm')">Edit product</a>
        </div>
    </div>
</nav>