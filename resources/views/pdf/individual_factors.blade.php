<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.min.css')}}" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<style>
    .text-danger {
        color:red;
    }
</style>

<body style="font-family: Arial, Helvetica, sans-serif;">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
                <h3 class="text-center f-21">Individual Result Factors</h3> 
                @if($data && $data['factors_explanations'][0]->language == 'en')       
                    <div class="col-md-12 text-center font-weight-bold">
                        <h2 class="lg:block text-white ml-3">{{$data['factors_explanations'][0]->main_summary_text_for_individual ?? ''}}</h2>
                        <h3 class="lg:block text-white ml-3">{{$data['factors_explanations'][0]->sub_summary_text_for_individual ?? ''}}</h3>
                        <h5 class="lg:block text-white ml-3">{{$data['factors_explanations'][0]->profile_summary_text_for_individual ?? ''}}</h5>
                    </div>
                    <div class="col-md-12 text-center">
                        <table style="width:400px" class="table table-borderless font-weight-bold" border="1">
                            <thead>
                               <tr>
                                 <th class="py-2 px-2"></th>
                                 <th class="py-2 px-2">Factor Ranking</th>
                                 <th class="py-2 px-2">Factor Loading</th>
                                 <th class="py-2 px-5">Eenhancer</th>
                               </tr>
                           </thead>
                           @php
                           $testResults = $data['factors_explanations']; // Access the factors_explanations array

                            foreach ($testResults as $key => $item) {
                                $factor = strtolower($item['factor']); // Convert factor to lowercase
                                $factor = str_replace(' ', '_', $factor); // Replace spaces with underscores

                                if (isset($data[$factor])) { // Check if the factor exists in the data array
                                    $testResults[$key]['data'] = [
                                        'min' => $data[$factor]['min'] ?? null,
                                        'max' => $data[$factor]['max'] ?? null,
                                        'result' => $data[$factor]['result'] ?? null,
                                        'average' => $data[$factor]['average'] ?? null,
                                        'median' => $data[$factor]['median'] ?? null,
                                        'percentile' => number_format(
                                            ((($data[$factor]['result'] - $data[$factor]['min']) / 
                                            ($data[$factor]['max'] - $data[$factor]['min'])) * 100), 
                                            2
                                        )
                                    ];
                                }
                            }    

                           @endphp
                           <tbody>
                            @if(isset($testResults) && count($testResults) > 0)
                            @php
                                $sortedResults = collect($data['factors_explanations'])->sortByDesc('data.percentile');
                                $count = 1;
                            @endphp
                            @foreach($sortedResults as $key => $result)
                                <tr>
                                    <td class="py-3 px-2 text-start">{{$count++}}</td>
                                    <td class="py-3 px-2 text-start">{{ ucwords($result->factor)  }}</td>
                                    <td class="py-3 px-2 text-start"> @if (isset($result)) 
                                        {{$result['data']['percentile']}}
                                       @endif
                                         %</td>
                                    <td class="py-3 px-5 text-start">{{ in_array($result->factor, ['Generosity', 'Admiration', 'Curiosity', 'Gratitude']) ? 'Anti Inflammatory' : 'Anti Stress' }}
                                    </td>
                                
                                </tr>
                             @endforeach
                             @else
                                <tr>
                                    <td>
                                        <p class="text-danger">No Record Found!</p>
                                    </td>
                                </tr>
                             @endif
                           </tbody>
                        </table>
                    </div>
                @else
                    <div class="col-md-12 text-center text-danger">
                        <p class="text-danger">No Record Found!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
         
</body>
<script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</script>
</html>