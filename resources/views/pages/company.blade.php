@extends('layouts.app')
@section('content')
    <section id="companysection" class="project" ng-class="{visible:showcomp}">
        <div>
            <h1 class="sectiontitle">@{{projectTitle}}</h1>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-3">
                <form action="" class="search-form">
                    <div class="form-group has-feedback" style="position:relative;left:525px;top:18px;">
                        <label for="search" class="sr-only">Search</label>
                        <input type="text" class="form-control" name="search" id="search" placeholder="Search" ng-model="searchKeyword" style="font-family:sans-serif">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-wrapper companiestable " id="companyTable">
            <table class="table table-condensed table-bordered table-striped table-responsive table-hover">
                <thead>
                    <tr>

                        <th style="text-align:right;width:150px;"> No.
                            <a href="#" ng-click="sort('No')" class="sortDir" ng-class="{ active: isSorted('No') }">&#x25B2;</a>
                            <a href="#" ng-click="sort('-No')" class="sortDir" ng-class="{ active: isSorted('-No' ) }">&#x25BC;</a>
                        </th>

                        <th>Company name

                            <a href="#" ng-click="sort('companyName')" class="sortDir" ng-class="{ active: isSorted('companyName' ) }">&#x25B2;</a>
                            <a href="#" ng-click="sort('-companyName')" class="sortDir" ng-class="{ active: isSorted('-companyName' ) }">&#x25BC;</a>
                        </th>
                        <th>Contact person</th>
                        <th>Website</th>
                        <th>Phone</th>
                        <th>Industry</th>
                        <th style="width:400px;">Address</th>
                    </tr>

                </thead>
                <tbody ng-controller="MyControllerModal">
                    <tr ng-repeat="company in companylist|orderBy:predicate:reverse | filter:searchKeyword">
                        <td style="text-align:right;">
                            <div style="float:left;">
                                <input type="checkbox" class="squaredFour" checklist-model="companytable.companylist" checklist-value="company.No" style="position:relative;top:-1px;"
                                />
                                <a href="#" ng-click="openEditcomp('sm',company)" popover="Edit this company" popover-trigger="mouseenter" popover-placement="right">
                                    <span class="fa fa-pencil-square-o" style="font-size:19px;color:#4E4EFD ;position:relative;top:-2px;"></span>
                                </a>
                                <a href="#" ng-click="openDeletecomp('sm',company)" popover="Delete this company" popover-trigger="mouseenter" popover-placement="right">
                                    <span class="fa fa-trash" id="rowtrashhover" style="font-size:19px;color:#4E4EFD;position:relative;top:-3px;"></span>
                                </a>
                            </div>
                            @{{company.No}}
                        </td>
                        <td>@{{company.companyName}}</td>
                        <td>@{{company.contactPerson}}</td>
                        <td>@{{company.website}}</td>
                        <td>@{{company.phone}}</td>
                        <td>@{{company.industry}}</td>
                        <td>@{{company.address}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row2">
            <div class="pagination pagination-centered" ng-show="rows.length">
                <ul class="pagination-controle pagination">
                    <li>
                        <button type="button" class="btn btn-primary" ng-disabled="curPage == 0" ng-click="curPage=curPage-1"> &lt; &lt;</button>
                    </li>
                    <li>
                        <span id="pagenumbers">Page @{{curPage + 1}} of @{{ numberOfPages() }}</span>
                    </li>
                    <li>
                        <button type="button" class="btn btn-primary" ng-disabled="(curPage >= numberOfPages() - 1) || (filteredRows.length < pageSize)"
                            ng-click="curPage = curPage+1">&gt;&gt;</button>
                    </li>
                </ul>
            </div>
        </div>
        <div ng-controller="MyControllerModal">
            <a href="#" ng-click="openmultiplecompanydelete(companytable.companylist)" popover="Delete multiple companies" popover-trigger="mouseenter"
                popover-placement="left">
                <i class="fa fa-trash" style="position:fixed;top:13.3%;left:1320px;font-size:35px;color:#4E4EFD"></i>
            </a>
        </div>

    </section>
@endsection