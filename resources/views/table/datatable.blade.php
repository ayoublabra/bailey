<x-app-layout :assets="$assets ?? []">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between mb-3">
                  <div>
                     <span>Nombre de ventes finalisées</span>
                  </div>
                  <div>
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                     </svg>
                  </div>
               </div>
               <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-center">
                     <div class="border rounded p-3 bg-soft-danger me-3">
                        <svg width="24" height="24" viewBox="0 0 24 24">
                           <path fill="currentColor" d="M19.07,4.93L17.66,6.34C19.1,7.79 20,9.79 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12C4,7.92 7.05,4.56 11,4.07V6.09C8.16,6.57 6,9.03 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12C18,10.34 17.33,8.84 16.24,7.76L14.83,9.17C15.55,9.9 16,10.9 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12C8,10.14 9.28,8.59 11,8.14V10.28C10.4,10.63 10,11.26 10,12A2,2 0 0,0 12,14A2,2 0 0,0 14,12C14,11.26 13.6,10.62 13,10.28V2H12A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,9.24 20.88,6.74 19.07,4.93Z" />
                        </svg>
                     </div>
                     <h2 class="counter">{{ $nbcontractsfinis }}</h2>
                  </div>
                  <div class="pt-3">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"  viewBox="0 0 20 20" fill="#b91d12">
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
                  <h4 class="card-title">Mes ventes finalisées</h4>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table" data-ordering="false">
                     <thead>
                        <tr>
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
                        @foreach($contracts as $contract)
                           <tr>
                              <td>{{$contract->formatted_created_at}}</td>
                              <td>{{$contract->last_name ?? 'Néant' }}</td>
                              <td>{{$contract->first_name ?? 'Néant' }}</td>
                              <td>Bailey assurances</td>
                              <td>{{$contract->name ?? 'Néant' }}</td>
                              <td>{{$contract->address ?? 'Néant' }}</td>
                              <td>
                                 {{-- @if ($contract->formatted_created_at >= date('Y-m-d H:i:s', strtotime('-5 days')))
                                    {{$contract->mobile_phone ?? 'Néant' }} <br/> {{$contract->email ?? 'Néant' }}
                                 @else
                                       {{ str_repeat('*', 9) . substr($contract->mobile_phone, -2) }} <br/> {{ str_repeat('*', 9) . substr($contract->email, -2) }}
                                 @endif --}}
                                 @if (strtotime($contract->formatted_created_at) >= strtotime('-5 days'))
                                    {{$contract->mobile_phone ?? 'Néant' }} <br/> {{$contract->email ?? 'Néant' }}
                                 @else
                                    {{ str_repeat('*', 9) . substr($contract->mobile_phone ?? '', -2) }} <br/> {{ str_repeat('*', 9) . substr($contract->email ?? '', -2) }}
                                 @endif
                              </td>
                              <td>
                                 @if (strtotime($contract->formatted_created_at) >= strtotime('-5 days'))
                                       {{ $contract->iban }}
                                 @else
                                       {{ str_repeat('*', 9) . substr($contract->iban, -2) }}
                                 @endif
                              </td>
                              <td>
                                 @if (strtotime($contract->formatted_created_at) >= strtotime('-5 days'))
                                       {{ $contract->bic_swift }}
                                 @else
                                       {{ str_repeat('*', 9) . substr($contract->bic_swift, -2) }}
                                 @endif
                              </td>
                              <td>
                                 @if (strtotime($contract->formatted_created_at) >= strtotime('-5 days'))
                                       {{ $contract->pdl_number }}
                                 @else
                                       {{ str_repeat('*', 9) . substr($contract->pdl_number, -2) }}
                                 @endif
                              </td>
                              <td>{{$contract->state}}</td>

                           </tr>
                        @endforeach
                     </tbody>
                     <!-- <tfoot>
                        <tr>
                           <th>Name</th>
                           <th>Position</th>
                           <th>Office</th>
                           <th>Age</th>
                        </tr>
                     </tfoot> -->
                  </table>
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
                  <h4 class="card-title">Mes ventes finalisées sur l'année</h4>
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
                  <h4 class="card-title">Mes ventes finalisées par type sur l'année</h4>
               </div>
            </div>
            <div class="card-body">
               <div id="chartDiv" style="max-width: 100%;height: 400px;margin: 0px auto;">
               </div>
            </div>
         </div>
      </div>
   </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jscharting.com/latest/jscharting.js"></script>

<script>

   var contractsfinis = <?php echo json_encode($contractsfinisgrouped)?>;
   let years = contractsfinis.map(contract => contract.year);
   let count = contractsfinis.map(contract => contract.count);

   let contractsfinisgroupedbytype = <?php echo json_encode($contractsfinisgroupedbytype)?>;

   let yearstype = [];
   let itemstype = [];
   let data = {};

   for (let key in contractsfinisgroupedbytype) {
      let currentYear = key;
      let currentItems = contractsfinisgroupedbytype[key];
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
            text: "Nb Ventes Finalisées sur l’année"
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

</script>