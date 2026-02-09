<?php

namespace App\Http\Controllers\Api\V1\Participant;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\TestResultService;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestResult\Show;
use App\Http\Requests\TestResult\Compare;
use App\Http\Requests\TestResult\showFactors;
use App\Notifications\SampleTestEmail as SampleTestEmail;

/**
 * @tags Participant
 */
class TestResultController extends Controller
{
    use ApiResponser;

    public function __construct(private TestResultService $testResultService)
    {
        //
    }

    /**
     * Test Result Show
     */
    public function show(Show $request)
    {
        $data = $this->testResultService->resource($request->all());

        return isset($data['errors']) ? $this->error($data) : $data;
    }

    /**
     * Test Compare Result Show With Factors
     */
    public function showFactors(showFactors $request)
    {
        $data = $this->testResultService->resource($request->all());

        return isset($data['errors']) ? $this->error($data) : $data;
    }

    /**
     * Test Compare Result Show
     */
    public function compare(Compare $request)
    {
        $data = $this->testResultService->compare($request->all());

        return isset($data['errors']) ? $this->error($data) : $data;
    }

    //Sample PDF

    public function generatepdf($id, Request $request)
    {
        // For individual Factors
        $individualRequest = ['answer_id' => $id, 'user' => false, 'lang' => 'en'];
        $individualData = $this->testResultService->resource($individualRequest);
        if ($individualData) {
            $data = $individualData['data'];
            $individualPdf1 = Pdf::loadView('pdf.individual_factors', compact('data'));
            $individualPdf2 = Pdf::loadView('pdf.factors', compact('data'));
            $individualPdf3 = Pdf::loadView('pdf.factor_results', compact('data'));
            $individualName = strtolower($data['user']->first_name);
            //$individualPdf->setPaper('A4', 'portrait');
            //$individualPdf->setOptions(['dpi' => 150]);

            //return $individualPdf->download($individualName.'-individual-factors.pdf');
            //return $individualPdf->download($individualName.'-factors.pdf');
            //return $individualPdf->download($individualName.'-factor-results.pdf');

            // Email code
            $pdfPath1 = storage_path("app/public/{$individualName}-individual-factors.pdf");
            $pdfPath2 = storage_path("app/public/{$individualName}-factors.pdf");
            $pdfPath3 = storage_path("app/public/{$individualName}-factor-results.pdf");
            $individualPdf1->save($pdfPath1);
            $individualPdf2->save($pdfPath2);
            $individualPdf3->save($pdfPath3);
            $user = User::find(1);
            $user->notify(new SampleTestEmail($user, $data, $pdfPath1, $pdfPath2, $pdfPath3));  // This is out testing line for emails
        }

        // // For all Factors
        // $allFacRequest = ['answer_id' => '8','flag' => 'factors','user' => false,'lang' => 'en' ];
        // $allFacData = $this->testResultService->resource($allFacRequest);
        // if($allFacData) {
        //     // dd($allFacData);
        //     // dd($allFacData['data'][0]['user']);
        //     $data = $allFacData['data'];
        //     $allFacPdf = PDF::loadView('pdf.factors', compact('data'));
        //     $allFacName = strtolower($data[0]['user']->first_name);
        //     // return $allFacPdf->download($allFacName.'-individual-factors.pdf');
        //     return $allFacPdf->download($allFacName.'-individual-factors.pdf');
        // }
    }
}
