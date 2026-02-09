<?php

namespace App\Services;

use App\Models\FactorExplanationConfig;
use App\Traits\BaseModel;
use DB;
use Auth;
use App\Http\Requests\FactorExplanationConfig\Request as FactorExplanationRequest;


class FactorExplanationConfigService
{
    use BaseModel;    
    
    public function __construct(private FactorExplanationConfig $fectorsObj)
    {
        
    }

    // Fucntion For get record (key)
    public function resource($id, $inputs = [])
    {
        if(is_numeric($id)) {
            $factor = $this->fectorsObj->getQB()->findOrFail($id);
        }
        else {
            $factor = $this->fectorsObj->getQB()->where('language',$id)->first();
        }
        return $factor;
    }

    public function collection($inputs = null)
    {
        $fector = $this->fectorsObj->getQB()->whereNotIn('language', ['fa'])->orderBy('created_at','DESC');
        
        $inputs['limit'] = isset($inputs['limit']) ? $inputs['limit'] : config('site.paginationLimit');
        return (isset($inputs['limit']) && $inputs['limit'] == '-1') ? $fector->get() : $fector->paginate($inputs['limit']);
    }

    public function update($id, array $inputs)  {
        if(is_numeric($id)) {
            
            $factorId = !is_null($id) ? $id : $inputs['id'];
            $factor = $this->resource($factorId);
            $factor->update($inputs);
        }
        else {
            $factorId = !is_null($id) ? $id : $inputs['id'];
            $factor = FactorExplanationConfig::where('language',$factorId)->update([
                'personal_profile_summary' => $inputs['personal_profile_summary'],
                'main_summary_text_for_table' => $inputs['main_summary_text_for_table'],
                'sub_summary_text_for_table' => $inputs['sub_summary_text_for_table'],
                'profile_summary_text_for_individual' => $inputs['profile_summary_text_for_individual'],
                'main_summary_text_for_individual' => $inputs['main_summary_text_for_individual'],
                'sub_summary_text_for_individual' => $inputs['sub_summary_text_for_individual'],
            ]);
        }
        
        $data['message'] = __('entity.entityUpdated', ['entity' => __('message.factor')]);
        return $data;
    }

    public function destroy(string $id)  {
        
        $factor = $this->resource($id)->delete();
        $data['message'] = __('entity.entityDeleted', ['entity' => __('message.factor')]);
        return $data;
    }

}
