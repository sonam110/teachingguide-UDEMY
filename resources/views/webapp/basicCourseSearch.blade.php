@extends('layouts.webapp')

@section('css')
<link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css?v=123')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/ionRangeSlider/ion.rangeSlider.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/nouslider/jquery.nouislider.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/footable/footable.core.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css?v=123') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2>Basic Course Search</h2>
    </div>
    <div class="col-lg-6">
        <h2 style="text-align: right;">
            <a href="/dashboard" class="btn btn-primary">
                Dashboard
            </a>
        </h2>
    </div>
</div>
<!--
search filter
-->
<div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <a class="collapse-link">
                  <h5>Search Filter <i class="fa fa-chevron-up"></i></h5>
              </a>
              <div class="ibox-tools" style="position: static;">
                  <a class="close-link">
                      <i class="fa fa-times"></i>
                  </a>
              </div>
          </div>

          <div class="ibox-content">
              <div class="row">
                  <div class="col-md-4 b-r"><h3 class="m-t-none m-b">Categories</h3>
                    <div class="col-md-6">
                        <div class="i-checks"><label> <input id="chkCatAll" type="checkbox"> <i></i> All Categories</label></div>
                        <div class="i-checks"><label> <input id="chkCatDev" type="checkbox"> <i></i> Development</label></div>
                        <div class="i-checks"><label> <input id="chkCatBus" type="checkbox" value=""> <i></i> Business</label></div>
                        <div class="i-checks"><label> <input id="chkCatITS" type="checkbox" value=""> <i></i> IT & Software</label></div>
                        <div class="i-checks"><label> <input id="chkCatOff" type="checkbox" value=""> <i></i> Office Productivity</label></div>
                        <div class="i-checks"><label> <input id="chkCatPer" type="checkbox" value=""> <i></i> Personal Development</label></div>
                        <div class="i-checks"><label> <input id="chkCatDes" type="checkbox" value=""> <i></i> Design</label></div>
                        <div class="i-checks"><label> <input id="chkCatMar" type="checkbox" value=""> <i></i> Marketing</label></div>
                    </div>
                    <div class="col-md-6">
                        <div class="i-checks"><label> <input id="chkCatLif" type="checkbox" value=""> <i></i> Lifestyle</label></div>
                        <div class="i-checks"><label> <input id="chkCatPho" type="checkbox" value=""> <i></i> Photography</label></div>
                        <div class="i-checks"><label> <input id="chkCatHea" type="checkbox" value=""> <i></i> Health & Fitness</label></div>
                        <div class="i-checks"><label> <input id="chkCatTea" type="checkbox" value=""> <i></i> Teacher Training</label></div>
                        <div class="i-checks"><label> <input id="chkCatMus" type="checkbox" value=""> <i></i> Music</label></div>
                        <div class="i-checks"><label> <input id="chkCatAca" type="checkbox" value=""> <i></i> Academics</label></div>
                        <div class="i-checks"><label> <input id="chkCatLan" type="checkbox" value=""> <i></i> Language</label></div>
                        <div class="i-checks"><label> <input id="chkCatTes" type="checkbox" value=""> <i></i> Test Prep</label></div>
                    </div>
                  </div>
                  <div class="col-md-8"><h4>Filters</h4>
                    <div class="row">

                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <input id="minRank" type="text" placeholder="min rank" class="form-control" onkeypress="return isNumberKey(event)">
                              </div>
                              <div class="form-group">
                                <input id="minSales" type="text" placeholder="min sales" class="form-control" onkeypress="return isNumberKey(event)">
                              </div>
                              <div class="form-group">
                                <input id="minReviews" type="text" placeholder="min reviews" class="form-control" onkeypress="return isNumberKey(event)">
                              </div>
                              <div class="form-group">
                                <input id="minRating" type="text" placeholder="min rating" class="form-control" onkeypress="return isNumberKey(event)">
                              </div>
                              <div class="form-group">
                                <input id="minStudents" type="text" placeholder="min students" class="form-control" onkeypress="return isNumberKey(event)">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <input id="maxRank" type="text" placeholder="max rank" class="form-control" onkeypress="return isNumberKey(event)">
                              </div>
                              <div class="form-group">
                                <input id="maxSales" type="text" placeholder="max sales" class="form-control" onkeypress="return isNumberKey(event)">
                              </div>
                              <div class="form-group">
                                <input id="maxReviews" type="text" placeholder="max reviews" class="form-control" onkeypress="return isNumberKey(event)">
                              </div>
                              <div class="form-group">
                                <input id="maxRating" type="text" placeholder="max rating" class="form-control" onkeypress="return isNumberKey(event)">
                              </div>
                              <div class="form-group">
                                <input id="maxStudents" type="text" placeholder="max students" class="form-control" onkeypress="return isNumberKey(event)">
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


<!--
search results table
-->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Search Results</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">

                <table id="coursetable" class="footable table table-stripped toggle-arrow-tiny">
                    <thead>
                    <tr>
                      <th>Title</th>
                      <th>SC Rank</th>
                      <th>Subcategory</th>
                      <th>Badge</th>
                      <th>Author</th>
                      <th>Topic</th>
                      <th>Rating</th>
                      <th>Students</th>
                      <th>Reviews</th>
                      <th>Engagement</th>
                      <th>Est.Sales</th>
                      <th>Udemy</th>
                    </tr>
                    </thead>
                    <tbody id="course-info">

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5">
                            <ul class="pagination pull-right"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js')}}"></script>
<script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/js/plugins/nouslider/jquery.nouislider.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/footable/footable.all.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>

<script>
    var table;

    $(document).ready(function(){
      $('#data_1 .input-group.date').datepicker({
          todayBtn: "linked",
          keyboardNavigation: false,
          forceParse: false,
          calendarWeeks: true,
          autoclose: true
      });

      table = $('#coursetable').DataTable({
          "processing": true,
          "serverSide": true,
          "dom": '<"html5buttons"B>itlp',
          "buttons": [

               ],
          "ajax": {
              "url": "{{ route('courseData') }}",
              "dataType": "json",
              "type": "POST",
              //"data": {"_token": "{{ csrf_token() }}"}
              "data": function(d) {
                  d._token = "{{ csrf_token() }}";
                  d.cAll = $('#chkCatAll:checked').is(':checked');
                  d.cDev = $('#chkCatDev:checked').is(':checked');
                  d.cBus = $('#chkCatBus:checked').is(':checked');
                  d.cITS = $('#chkCatITS:checked').is(':checked');
                  d.cOff = $('#chkCatOff:checked').is(':checked');
                  d.cPer = $('#chkCatPer:checked').is(':checked');
                  d.cDes = $('#chkCatDes:checked').is(':checked');
                  d.cMar = $('#chkCatMar:checked').is(':checked');
                  d.cLif = $('#chkCatLif:checked').is(':checked');
                  d.cPho = $('#chkCatPho:checked').is(':checked');
                  d.cHea = $('#chkCatHea:checked').is(':checked');
                  d.cTea = $('#chkCatTea:checked').is(':checked');
                  d.cMus = $('#chkCatMus:checked').is(':checked');
                  d.cAca = $('#chkCatAca:checked').is(':checked');
                  d.cLan = $('#chkCatLan:checked').is(':checked');
                  d.cTes = $('#chkCatTes:checked').is(':checked');
                  d.FreeCourses = $('#FreeCourses').prop('checked');
                  d.IncTags = $('#includeTags').val();
                  d.IncKeyRel = $('#IncKeyRel').prop('checked');
                  d.ExcTags = $('#excludeTags').val();
                  d.Authors = $('#selAuthor').val();
                  d.Level = $('#selLevel').val();
                  d.Badge = $('#selBadge').val();
                  d.Topic = $('#selTopic').val();
                  d.Prices = $('#selPrices').val();
                  d.minRank = $('#minRank').val();
                  d.minSales = $('#minSales').val();
                  d.minReviews = $('#minReviews').val();
                  d.minRating = $('#minRating').val();
                  d.minStudents = $('#minStudents').val();
                  d.maxRank = $('#maxRank').val();
                  d.maxSales = $('#maxSales').val();
                  d.maxReviews = $('#maxReviews').val();
                  d.maxRating = $('#maxRating').val();
                  d.maxStudents = $('#maxStudents').val();
              }
          },
          "order": [[10, "desc" ]],
          "columns": [
            {"data": "title"},
            {"data": "rank"},
            {"data": "subcategory"},
            {"data": "badge"},
            {"data": "author"},
            {"data": "topic"},
            {"data": "rating"},
            {
                "data": "students",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {
                "data": "reviews",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {"data": "engagement"},
            {
                "data": "sales",
                "render": function (data, type, row, meta) {
                   if(type === 'display'){
                      return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                   } else {
                      return data;
                   }
                }
            },
            {"data": "link"},
          ],
          "columnDefs": [{
              "targets": [11], // column or columns numbers
              "orderable": false,  // set orderable for selected columns
          },
          {
              "targets": [ 1,2,3,6 ],
              "visible": false,
              "searchable": false
          }],
      });

      $('.tagsinput').tagsinput({
          tagClass: 'label label-primary'
      });

      $('#read-data').on('click', function(){
          table.ajax.reload();
      });


      $('#selAuthor, #selTopic, #selPrices, #selLevel, #selBadge, #includeTags, #excludeTags, #IncKeyRel, #FreeCourses, .i-checks').on('change', function(e){
          table.ajax.reload();
      });

    });

    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 13) {
        table.ajax.reload();
        return false;
      }

      if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
      return true;
    }

    $('.chosen-select').chosen({width: "100%"});
    $('.select2_badge, .select2_level, .select2_prices').select2();
    $('.select2_authors').select2({
          placeholder: "All Authors",
          minimumInputLength: 2,
          ajax: {
              url: '/api/authors',
              dataType: 'json',
              data: function (params) {
                  return {
                      q: $.trim(params.term)
                  };
              },
              processResults: function (data) {
                  return {
                      results: data
                  };
              },
              cache: true
          }
      });
      $('.select2_topic').select2({
            placeholder: "All Topics",
            minimumInputLength: 1,
            ajax: {
                url: '/api/topics',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        $('#FreeCourses').bootstrapToggle({
            width: '200px'
        });
</script>

<script>

</script>
@endsection
