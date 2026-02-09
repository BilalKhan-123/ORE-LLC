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
                                (($data[$factor]['result'] - $data[$factor]['min']) / 
                                ($data[$factor]['max'] - $data[$factor]['min']) * 100), 
                                2
                            )
                        ];
                    }
                }    

            @endphp
            {{-- @dd($data); --}}
                <h3 class="text-center f-21">Results</h3> 
 
                @if($data && $data['factors_explanations'][0]->language == 'en')       
                    @foreach ($testResults as $key => $result) 

                        <div class="col-md-12 text-center font-weight-bold">
                            <h2 style="color:green" class="lg:block text-white ml-3">{{$result['name'] ?? ''}}</h2>
                            <h4 style="color:brown">High Score</h4>
                            <h5>{!! $result['high_score'] !!}</h5 >
                                <h5>{!! $result['high_score_suggestion'] ?? '' !!}</h5>
                            <h4 style="color:brown">Low Score</h4>
                            <h5>{!! $result['low_score'] !!}</h5 >
                                <h5>{!! $result['low_score_suggestion'] ?? '' !!}</h5>
                        </div>

                         <div class="md:w-11/12 mx-auto w-3/4">
                            <div
                              class="graph relative flex w-full mt-24"
                              data-min="{{ $result['data']['min'] }}"
                              data-max="{{ $result['data']['max'] }}"
                            >
                            <div class="h-4 grow bg-[#8B0000]"></div>
                            <div class="h-4 grow bg-[#B22222]"></div>
                            <div class="h-4 grow bg-[#FF6347]"></div>
                            <div class="h-4 grow bg-[#90EE90]"></div>
                            <div class="h-4 grow bg-[#228B22]"></div>
                            <div class="h-4 grow bg-[#006400]"></div>
                              {{-- <span
                                class="pointer absolute text-white"
                                :style="`left: calc({{ round((($result['data']['result'] - $result['data']['min']) / (-$result['data']['min'] + $result['data']['max'])) * 100) }}%)`"
                              >
                                <div class="date_chip w-20">
                                    You {{ $result['data']['result'] }}
                
                                  <div class="absolute bg-primary-800 text-white p-2 rounded shadow-md bottom-full left-1/2 transform -translate-x-1/2"
                                  >{{ date('m/d/Y', $data['result_date']) }}
                                  </div>
                                </div>
                              </span> --}}
                              
                              
                                {{-- @if($result['data']['median'] > $result['data']['min'] && $result['data']['median'] < $result['data']['max'])
                                    <span class="avg_pointer absolute text-white"
                                        style="left: calc({{  round((($result['data']['result'] - $result['data']['min']) / (-$result['data']['min'] + $result['data']['max'])) * 100) }}%)">
                                        <div class="avg_chip text-white">
                                            {{ $result['median'] }}
                                            <p>Mid</p>
                                        </div>
                                    </span>
                                @endif  --}}
                            <span class="absolute -translate-x-1/2 w-1 h-4 bg-primary-900 left-[calc(100%/6)]"></span>
                            <span class="absolute -translate-x-1/2 w-1 h-4 bg-primary-900 left-[calc(100%/6*2)]"></span>
                            <span class="absolute -translate-x-1/2 w-1 h-4 bg-primary-900 left-[calc(100%/6*3)]"></span>
                            <span class="absolute -translate-x-1/2 w-1 h-4 bg-primary-900 left-[calc(100%/6*4)]"></span>
                            <span class="absolute -translate-x-1/2 w-1 h-4 bg-primary-900 left-[calc(100%/6*5)]"></span>
                            </div>
                            <div class="flex items-center lg:justify-center mt-16 mx-auto lg:px-12 px-4">
                                <table style="width: 400px;" class="table table-borderless font-weight-bold" border="1">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-2">Date</th>
                                            <th class="py-2 px-2">Min</th>
                                            <th class="py-2 px-2">Max</th>
                                            <th class="py-2 px-5">Mid</th>
                                            <th class="py-2 px-5">You</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="py-3 px-2 text-start">{{date('m/d/Y', $data['result_date'])}}</td>
                                        <td class="py-3 px-2 text-start">{{ $result['data']['min'] }}</td>
                                        <td class="py-3 px-2 text-start">{{ $result['data']['max'] }}</td>
                                        <td class="py-3 px-2 text-start">{{ $result['data']['median'] }}</td>
                                        <td class="py-3 px-2 text-start">{{ $result['data']['result'] }}</td>

                                    </tr>
                                    </tbody>
                                </table> 
                              <h4 style="color: blue" class="text-xl lg:text-2xl leading-relaxed text-start text-white">
                                 Your {{ str_replace('_', ' ', $result['factor']) }} factor is better than
                                <span class="font-bold">{{ $result['data']['percentile'] }}%</span>
                                of people in your age group
                              </h4>
                            </div>
                          </div>
                    @endforeach
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