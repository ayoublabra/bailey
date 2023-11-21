<style>
   #brandingLogo{
      display: none;
   }
   .accordion-body {
   padding: 1rem 1.5rem;
   }



</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
{{-- <link rel="stylesheet" href="{{ asset('css/state.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/state.css') }}">

<x-app-layout :assets="$assets ?? []">
   <div>
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <div class="d-flex justify-content-between mb-3">
                     <div>
                        <span>Nombre de ventes non finalisées</span>
                     </div>
                     <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                           <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                     </div>
                  </div>
                  <div class="d-flex justify-content-between">
                     <div class="d-flex align-items-center">
                        <div class="border rounded p-3 bg-soft-success me-3">
                           <svg  width="24px" height="24px" viewBox="0 0 24 24">
                              <path fill="currentColor" d="M21.4 11.6L12.4 2.6C12 2.2 11.5 2 11 2H4C2.9 2 2 2.9 2 4V11C2 11.5 2.2 12 2.6 12.4L11.6 21.4C12 21.8 12.5 22 13 22C13.5 22 14 21.8 14.4 21.4L21.4 14.4C21.8 14 22 13.5 22 13C22 12.5 21.8 12 21.4 11.6M13 20L4 11V4H11L20 13M6.5 5C7.3 5 8 5.7 8 6.5S7.3 8 6.5 8 5 7.3 5 6.5 5.7 5 6.5 5M10.1 8.9L11.5 7.5L17 13L15.6 14.4L10.1 8.9M7.6 11.4L9 10L13 14L11.6 15.4L7.6 11.4Z" />
                           </svg>
                        </div>
                        <h2 class="counter">{{ $nbcontractsnonfinis }}</h2>
                     </div>
                     <div class="pt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"  viewBox="0 0 20 20" fill="#07750b">
                           <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                        </svg>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Mes ventes non finalisées</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="datatable" class="table table-striped" data-toggle="data-table" data-ordering="false">
                        <thead>
                           <tr>
                              <th>Actions</th>
                              <th>Date</th>
                              <th>Prénom</th>
                              <th>Nom</th>
                              <th>Bailey</th>
                              <th>Type de contrat</th>
                              <th>Adresse</th>
                              <th>Info</th>
                              <th>Iban</th>
                              <th>Bic</th>
                              <th>Pdl</th>
                              <th>Statut</th>
                           </tr>
                        </thead>
                        <tbody>

                           @foreach($contractsnonfinis as $contract)
                              <tr data-company-id="{{$contract->company_id}}">
                                 <td><a class="btn btn-danger"  target="_blank" href="{{route('getFinalisation',$contract->id)}}"onclick="resetIban({{$contract->id}})">Finaliser</a></td>
                                 <td>{{$contract->formatted_created_at}}</td>
                                 <td>{{$contract->last_name ?? 'Néant' }}</td>
                                 <td>{{$contract->first_name ?? 'Néant' }}</td>
                                 <td>Bailey assurances</td>
                                 <td>{{$contract->name ?? 'Néant' }}</td>
                                 <td>{{$contract->address ?? 'Néant' }}</td>
                                 <td>{{$contract->mobile_phone ?? 'Néant' }} <br/> {{$contract->email ?? 'Néant' }}</td>
                                 <td>{{$contract->iban ?? 'Néant' }}</td>
                                 <td>{{$contract->bic_swift ?? 'Néant' }}</td>
                                 <td>{{$contract->pdl_number ?? 'Néant' }}</td>
                                 <td>{{$contract->state ?? 'Néant' }}</td>
                                 
                              </tr>

                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>


      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Mes ventes non finalisées sur l'année</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div id="chart">
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Mes ventes non finalisées par type sur l'année</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div id="chartDiv" style="max-width: 100%;height: 400px;margin: 0px auto;"></div>

               </div>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jscharting.com/latest/jscharting.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
  

   var contractsnonfinisgrouped = <?php echo json_encode($contractsnonfinisgrouped)?>;
   let years = contractsnonfinisgrouped.map(contract => contract.year);
   let count = contractsnonfinisgrouped.map(contract => contract.count);

   let contractsnonfinisgroupedbytype = <?php echo json_encode($contractsnonfinisgroupedbytype)?>;

   let yearstype = [];
   let itemstype = [];
   let data = {};

   for (let key in contractsnonfinisgroupedbytype) {
      let currentYear = key;
      let currentItems = contractsnonfinisgroupedbytype[key];
      yearstype.push(currentYear);
      itemstype.push(currentItems);
   }

   var options = {
      chart: {
         height: 350,
         type: "line",
         stacked: false
      },
      dataLabels: {
         enabled: false
      },
      colors: ['#99C2A2'],
      series: [
         {
            name: 'NB',
            type: 'column',
            data: count.map(value => parseInt(value))
         },
      ],
      stroke: {
         width: [10, 10, 10]
      },
      plotOptions: {
         bar: {
            columnWidth: "20%"
         }
      },
      xaxis: {
         categories: years
      },
      yaxis: [
         {
            seriesName: 'Column A',
            axisTicks: {
            show: true
            },
            axisBorder: {
            show: true,
            },
            title: {
            text: "Nb Ventes non Finalisées sur l’année"
            },
            labels: {
               formatter: function(val) {
                     return parseInt(val);
               }
            }
         },
      ],
      tooltip: {
         shared: false,
         intersect: true,
         x: {
            show: false
         }
      },
      legend: {
         horizontalAlign: "left",
         offsetX: 40
      }
   };


   var chart = new ApexCharts(document.querySelector("#chart"), options);

   chart.render();

   for (let i = 0; i < yearstype.length; i++) {
      data[yearstype[i]] = itemstype[i];
   }

   let series = [
      { name: "AF GAZ", points: [] },
      { name: "AF ELEC", points: [] },
      { name: "Mon assurance PGE", points: [] }
   ];

   let years1 = Object.keys(data);

   years1.forEach(year => {
      series.forEach(serie => {
         serie.points.push(data[year].includes(serie.name) ? 1 : 0);
      });
   });

   var chart = JSC.chart("chartDiv", {
      debug: true,
      type: "column",
      yAxis: {
         scale_type: 'stacked'
      },
      title_label_text: "",
      xAxis: {
         scale_type: "integer",
         label_text: "",
         categories: years1,
      },
      series: series,
   });

   function _ResuptionOfContract(id){
      window.location.href = '/forms/wizard';
   }
   function resetIban(params) {

      var contract_id=null;
      contract_id=params;
      // console.log(params);
      var formData1=[];
      formData1 = formData1.concat([                             
            {
               name: "contract_id",
               value: contract_id
            }   
      ]);
      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         type: 'POST',
         url: '/resetIban',
         data: formData1,
         dataType: 'JSON',
         success: function(result) {
            // id_contract=result.savedIds;
         }
      });
      
   }


</script>