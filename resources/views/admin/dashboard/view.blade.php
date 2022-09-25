@extends('admin.template.main')
@section('content')
<style>
#container{
    max-width: 100%;
}
#button-container {
    max-width: 800px;
    margin: 1em auto;
}

#pdf {
    border: 1px solid silver;
    border-radius: 3px;
    background: #a4edba;
    padding: 0.5em 1em;
}

#pdf i {
    margin-right: 1em;
}

</style>
<script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>
<script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>
<script src="https://code.highcharts.com/gantt/modules/accessibility.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if($errors->any())
            <div class="alert alert-danger">
            {{$errors->first()}}
            </div>
        @endif
        @if (Session::has('success'))
          <div class="alert alert-success">
            {{Session::get('success')}}
            </div>
        @endif
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">TimeChart Manufacturing Order</h3>
              </div>
              <div class="card-body">
                <div id="container"></div>
                <div id="button-container">
                    <button id="pdf">
                        <i class="fa fa-download"></i> Download PDF
                    </button>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script>
Highcharts.ganttChart('container', {
    title: {
        text: 'Manufacturing Order Timechart'
    },

    yAxis: {
        uniqueNames: true
    },


    lang: {
        accessibility: {
            axis: {
                xAxisDescriptionPlural: 'The chart has a two-part X axis showing time in both week numbers and days.'
            }
        }
    },

    series: [{
        name: 'Project 1',
        data: [{
            start: Date.UTC(2020, 09, 03, 21),
            end: Date.UTC(2020, 09, 04, 7, 00),
            name: 'INJECTION/MC06 N',
            color: '#000'
        }, {
            start: Date.UTC(2020, 09, 04, 21),
            end: Date.UTC(2020, 09, 05, 7, 00),
            name: 'INJECTION/MC07 N',
            color: '#000'
        }, {
            start: Date.UTC(2020, 09, 04, 7),
            end: Date.UTC(2020, 09, 04, 20, 00),
            name: 'INJECTION/MC07 M',
            color: '#3BB873'
        },{
            start: Date.UTC(2020, 09, 04, 21),
            end: Date.UTC(2020, 09, 05, 7, 00),
            name: 'INJECTION/MC07 N',
            color: 'rgb(124, 181, 236)'
        }, {
            start: Date.UTC(2020, 09, 06, 21),
            end: Date.UTC(2020, 09, 07, 7, 00),
            name: 'INJECTION/MC03 N',
            color: '#000'
        }, {
            start: Date.UTC(2020, 09, 07, 21),
            end: Date.UTC(2020, 09, 08, 7, 00),
            name: 'INJECTION/MC03 N',
            color: '#3BB873'
        }]
    }]
    });

    // Activate the custom button
    document.getElementById('pdf').addEventListener('click', function () {
    Highcharts.charts[0].exportChart({
        type: 'application/pdf'
    });
});
    function refresh()
    {
        var div = $('container'),
        divHtml = div.html();
        div.html(divHtml);
    }

    setInterval(function()
    {
        console.log("refreshed")
        refresh()
    }, 6000); //300000 is 5minutes in ms

  </script>
@endsection

