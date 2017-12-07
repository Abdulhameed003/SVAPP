@extends('layouts.app')
@section('content')
    <section id="salespersonsection" class="project" ng-class="{visible:showsalesperson}">
        <div>
            <h1 class="sectiontitle">{{projectTitle}}</h1>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-3">
                <form action="" class="search-form">
                    <div class="form-group has-feedback" style="position:relative;left:505px;top:18px;">
                        <label for="search" class="sr-only">Search</label>
                        <input type="text" class="form-control" name="search" id="search" placeholder="Search" ng-model="searchKeyword" style="font-family:'lato', sans-serif">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-wrapper companiestable" id="companyTable">
            <table class="table table-condensed table-bordered table-striped table-responsive table-hover">
                <thead>
                    <tr>

                        <th style="text-align:right;width:150px;"> No.
                            <a href="#" ng-click="sort('No')" class="sortDir" ng-class="{ active: isSorted('No') }">&#x25B2;</a>
                            <a href="#" ng-click="sort('-No')" class="sortDir" ng-class="{ active: isSorted('-No' ) }">&#x25BC;</a>
                        </th>

                        <th>Name

                            <a href="#" ng-click="sort('name')" class="sortDir" ng-class="{ active: isSorted('name' ) }">&#x25B2;</a>
                            <a href="#" ng-click="sort('-name')" class="sortDir" ng-class="{ active: isSorted('-name' ) }">&#x25BC;</a>
                        </th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Position</th>
                        <th>Total Projects</th>
                    </tr>

                </thead>
                <tbody ng-controller="MyControllerModal">
                    <tr ng-repeat="sperson in spersonlist|orderBy:predicate:reverse | filter:searchKeyword">
                        <td style="text-align:right;">
                            <div style="float:left;">
                                <input type="checkbox" class="squaredFour" checklist-model="spersontable.spersonlist" checklist-value="sperson.No" style="position:relative;top:-1px;"
                                />
                                <a href="#" ng-click="openEditsperson('sm',sperson)" popover="Edit this sales person" popover-trigger="mouseenter" popover-placement="right">
                                    <span class="fa fa-pencil-square-o" style="font-size:19px;color:#D32F2F;position:relative;top:-2px;"></span>
                                </a>
                                <a href="#" ng-click="openDeletesperson('sm',sperson)" popover="Delete this sales person" popover-trigger="mouseenter" popover-placement="right">
                                    <span class="fa fa-trash" id="rowtrashhover" style="font-size:19px;color:#D32F2F;position:relative;top:-3px;"></span>
                                </a>
                            </div>
                            {{sperson.No}}
                        </td>
                        <td>{{sperson.name}}</td>
                        <td>{{sperson.phone}}</td>
                        <td>{{sperson.email}}</td>
                        <td>{{sperson.position}}</td>
                        <td>{{sperson.total}}</td>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row2">
            <div class="pagination pagination-centered" ng-show="rows.length">
                <ul class="pagination-controle pagination">
                    <li>
                        <button type="button" class="btn button" ng-disabled="curPage == 0" ng-click="curPage=curPage-1"> &lt; &lt;</button>
                    </li>
                    <li>
                        <span id="pagenumbers">Page {{curPage + 1}} of {{ numberOfPages() }}</span>
                    </li>
                    <li>
                        <button type="button" class="btn button" ng-disabled="(curPage >= numberOfPages() - 1) || (filteredRows.length < pageSize)"
                            ng-click="curPage = curPage+1">&gt;&gt;</button>
                    </li>
                </ul>
            </div>
        </div>
        </div>
        <div ng-controller="MyControllerModal" id="salespersondelete" class="deletinghover">
            <a href="#" ng-click="openmultiplespersondelete(spersontable.spersonlist)" popover="Delete multiple sales persons" popover-trigger="mouseenter"
                popover-placement="left">
                <i class="fa fa-trash" style="position:absolute;top:2.5%;left:1290px;font-size:35px;color:#D32F2F"></i>
            </a>
        </div>

    </section>
@endsection