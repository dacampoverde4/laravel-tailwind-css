@extends('admin.layout.master')
@section('content')
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-xlg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="inline_block font22">
                        <b class="vertical_align"><img src="{{ asset('backend/images/allusers.png') }}" alt="Report" title="Img" class="all_users">Group plan Mapping</b>
                        <a class="btn btn-info btnpad pull-right" href="{{route('subscription-plan-usergroup.index')}}"><i class="fa fa-arrow-left"></i> Back</a>
                        </h3>
                        <hr>
                        <div class="announcement_box paddingtb20">
                         <div class="box-body">
                              <div class="col-md-12">
                                  <div class="col-md-6">
                                      <table class="table table-user-information">
                                          <tbody>
                                              <tr>
                                                  <th>point 1 :</th>
                                                  <td>{{$point1}}</td>
                                              </tr>
                                              <tr>
                                                  <th>Plan of point 1</th>
                                              <td>{{$point1plan->name}} {{$point1plan->price}}</td>
                                              </tr>
                                              <tr>
                                                  <th>With</th>
                                                  <td>Mapped</td>
                                              </tr>
                                              
                                              <tr>
                                                  <th>point 2 :</th>
                                                  <td>{{$point2}}</td>
                                              </tr>
                                              
                                              <tr>
                                                  <th>Plan of point 2</th>
                                                  <td>{{$point2plan->name}} {{$point2plan->price}}</td>
                                              </tr>
                                              <tr>
                                              <tr>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection