<?php

namespace Yeganehha\DynamicForms\app\Http\Traits\package;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Yeganehha\DynamicForms\Models\Fieldsvalue;


trait FieldsValueTrait
{
    protected $FillOutedData = null ;
    protected $isFillOutForm = false ;
    protected $FillOutError = false ;
    protected $FillOutData = null ;


    private function getFillOutedForm($model){
        $fields = $this->getFields(true,$this->showHidden);
        $fieldsId = array_column($fields, 'id');
        if ( is_object($model) ){
            if ( $this->form->external_table ){
                $columns = $model->externalTableConnection($this->form->id)->get()->first();
                if ( $columns != null ) {
                    $columns = $columns->toArray();
                    unset($columns['model_id'], $columns['created_at'], $columns['updated_at']);
                    foreach ($columns as $key => $value) {
                        $values[substr($key, 2)]['value'] = $value;
                    }
                }
            } else {
                $values = $model->allValues()->get()->whereIn('field_id' ,  $fieldsId )->keyBy('field_id')->toArray();
            }
        }
        foreach ( $fields as $key => $field ){
            if ( isset($values[$field['id']]['value']) and ( $values[$field['id']]['value'] != null or $values[$field['id']]['value'] != "" ) )
                $fields[$key]['value'] = unserialize($values[$field['id']]['value']);
            else
                $fields[$key]['value'] =  "";
            if ( $field['type_variable'] == 'file' and ($fields[$key]['value'] != null or $fields[$key]['value'] != "") ) {
//              $fields[$key]['downloadLink'] = URL::temporarySignedRoute('dynamicForms.dl',now()->addMinutes(30) , ['path' => $fields[$key]['value']]);
                $fields[$key]['valueFile'] =  $fields[$key]['value'];
                $fields[$key]['valueHash'] =  Hash::make($fields[$key]['value']);
                $fields[$key]['value'] =  URL::temporarySignedRoute('dynamicForms.dl',now()->addMinutes(30) , ['path' => $fields[$key]['value']]);
            }
            $fields[$key]['valuesDe'] = explode(',', $fields[$key]['values'] );
            $fieldExport[$key] = (object)$fields[$key];
        }
        $this->FillOutedData  = $fieldExport;
    }

    private function setFillOutedForm($model,$validateData){
        $modelType = $this->_getModel();
        if ( $this->form->external_table ){
            if (! is_object($model))
                throw new \ErrorException(trans('dynamicForm::form.modelNotObject'));
            $data['model_id'] = $model->id;
            foreach ($validateData as $field_id => $field) {
                if ($field['type'] == 'file' and is_object($field['value']) and get_class($field['value']) == 'Illuminate\Http\UploadedFile') {
                    $path = 'DynamicForms/' . $this->form->id . '-' . implode('/', (array)unserialize($this->form->name));
                    $nameFile = $field_id . '-' . $model->id . '_' . $field['value']->getClientOriginalName();
                    Storage::putFileAs($path, $field['value'], $nameFile);
                    $field['value'] = $path . '/' . $nameFile;
                }
                $data['f_'.$field_id] = serialize($field['value']);
            }
            $ifExist = $model->externalTableConnection($this->form->id)->where('model_id' , $model->id )->get()->first();
            if ( $ifExist != null  ){
                $ifExist->update($data);
            } else {
                $model->externalTableConnection($this->form->id)->create($data);
            }
        } else {
            if (is_object($model))
                $model = $model->id;
            if (intval($model) == 0) {
                throw new \ErrorException(trans('dynamicForm::form.modelNotObject') );
            }
            Fieldsvalue::deleteFillOutFields(array_keys($validateData), $model, $modelType);
            foreach ($validateData as $field_id => $field) {
                if ($field['type'] == 'file' and is_object($field['value']) and get_class($field['value']) == 'Illuminate\Http\UploadedFile') {
                    $path = 'DynamicForms/' . $this->form->id . '-' . implode('/', (array)unserialize($this->form->name));
                    $nameFile = $field_id . '-' . $model . '_' . $field['value']->getClientOriginalName();
                    Storage::putFileAs($path, $field['value'], $nameFile);
                    $field['value'] = $path . '/' . $nameFile;
                }
                $data[] = [
                    'field_id' => $field_id,
                    'fieldable_id' => $model,
                    'fieldable_type' => $modelType,
                    'value' => serialize($field['value']),
                ];
            }
            Fieldsvalue::insert($data);
        }
    }

    private function validateData($fieldsInsert){
        $fields = $this->getFields(true,$this->showHidden);
        $validateRules = [];
        $validateData = [];
        foreach ( $fields as $key => $field ) {
            if ( $field['status'] != "hidden" or $this->showHidden ){
                $validateRulesLocal[$field['label']] = [];
                if ( $field['validate'] != null )
                    $validateRulesLocal[$field['label']] = explode('|',$field['validate']);
                if ( $field['status'] == "required" ){
                    $validateRulesLocal[$field['label']][] = "required";
                }
                if ( $field['type_variable'] == 'file'){
                    $file = Request()->file('dynamicForms.'.$field['id'] );
                    if ( $file != null ) {
                        $validateData[$field['id']]['value'] = $file ;
                        $validateData[$field['id']]['type'] = $field['type_variable'] ;
                        $fieldsInserted[$field['label']] = $file ;
                    }
                } else {
                    $validateData[$field['id']]['value'] = $fieldsInsert[$this->form->id][$field['id']] ?? "" ;
                    $validateData[$field['id']]['type'] = $field['type_variable'] ;
                    $fieldsInserted[$field['label']] = $fieldsInsert[$this->form->id][$field['id']] ?? "";
                }

                if ( ! ( $field['type_variable'] == 'file' and Request()->has('dynamicFormsHash.'.$field['id']) and Hash::check($fieldsInsert[$this->form->id][$field['id']] , Request()->get('dynamicFormsHash')[$field['id']] ) ) ){
                    $validateRules[$field['label']] = implode('|',array_unique($validateRulesLocal[$field['label']]));
                }
            }
        }
        $validator = Validator::make($fieldsInserted, $validateRules );
        if ( $validator->fails() )
            $this->FillOutError = $validator;
        return $validateData;
    }


    protected function _setFillOutData($fieldOutData){
        $this->isCalled();
        $this->FillOutData = $fieldOutData;
    }

    protected function _getError(){
        $this->isCalled();
        return $this->FillOutError;
    }

    protected function _fillOutForm($model, $autoDetectData = true){
        $this->isCalled();
        if ( ( is_object($model) and get_class($model) != $this->form->model ) or ( ! is_object($model) and $model != $this->form->model ) )
            throw new \ErrorException(trans('dynamicForm::form.modelShouldBe' , ['model' => $this->form->model]) );

        if ( ! is_object($model) )
            $this->isFillOutForm = true ;
        else
            $this->isFillOutForm = $model->id ;

        if ( ( $autoDetectData and Request()->has('dynamicForms') and  $this->FillOutData == null ) or ( !$autoDetectData and $this->FillOutData != null ) ){
            if ( $autoDetectData and Request()->has('dynamicForms') and  $this->FillOutData == null ){
                $FillOutData = Request()->get('dynamicForms');
            }
            if ( !$autoDetectData and $this->FillOutData != null )
                $FillOutData = $this->FillOutData;

            $this->FillOutError = false ;
            DB::beginTransaction();
            try {
                $validateData = $this->validateData($FillOutData);
                if ( $this->FillOutError === false ){
                    $this->setFillOutedForm($model,$validateData);
                    DB::commit();
                } else {
                    DB::rollback();
                }
            } catch (\Exception $e) {
                DB::rollback();
                throw new \ErrorException(trans('dynamicForm::form.errorInInsertData' , ['errorMessage' => $e->getMessage()]) );
            }
        }
        $this->getFillOutedForm($model);
    }

}
