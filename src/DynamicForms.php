<?php
namespace Yeganehha\DynamicForms;

use Illuminate\Foundation\Mix;
use Yeganehha\DynamicForms\app\Http\Traits\package\FieldsTrait;
use Yeganehha\DynamicForms\app\Http\Traits\package\FieldsValueTrait;
use Yeganehha\DynamicForms\app\Http\Traits\package\FormsTrait;

class DynamicForms
{

    use FormsTrait , FieldsTrait , FieldsValueTrait;

    /**
     * @param null $formName
     * @param null $model
     * @param false $extend_table
     * @return $this
     * @throws \ErrorException
     */
    public function form($formName = null , $model = null , $extend_table = false)
    {
       $this->_form($formName,$model,$extend_table);
       return $this;
    }

    /**
     * @param Mixed $formName
     * @return false|DynamicForms
     * @throws \ErrorException
     */
    public function exist($formName)
    {
       return ( $this->_exist($formName) ) ? $this : false ;
    }

    /**
     * @param int $formName
     * @return false|DynamicForms
     * @throws \ErrorException
     */
    public function findById($form_id)
    {
       return ( $this->_findById($form_id) ) ? $this : false ;
    }

    /**
     * @return bool
     * @throws \ErrorException
     */
    public function getTable()
    {
        return $this->_getTable();
    }

    /**
     * @param $isExternal
     * @return $this
     * @throws \ErrorException
     */
    public function setTable($isExternal)
    {
        $this->_setTable($isExternal);
        return $this;
    }

    /**
     * @return $this
     * @throws \ErrorException
     */
    public function setExternalTable()
    {
        $this->_setExternalTable();
        return $this;
    }

    /**
     * @return $this
     * @throws \ErrorException
     */
    public function setLocalTable(){
        $this->_setLocalTable();
        return $this;
    }

    /**
     * @return mixed
     * @throws \ErrorException
     */
    public function getFields($isArray = false , $showHidden = false){
        return $this->_getFields($isArray,$showHidden);
    }

    /**
     * @param array|null $fields
     * @throws \ErrorException
     */
    public function setFields($fields = null ){
        $this->_setFields($fields);
        return $this;
    }

    public function addFields($fields = null ){
        $this->_addFields($fields);
        return $this;
    }

    public function updateFields($fieldId , $field = null ){
        $this->_updateFields($fieldId,$field);
        return $this;
    }
    public function deleteFields($fieldId){
        $this->_deleteFields($fieldId);
        return $this;
    }

    public function getModel($returnClass = false){
        return $this->_getModel($returnClass);
    }

    public function setFillOutData($data){
        $this->_setFillOutData($data);
        return $this;
    }
    public function fillOutForm($model, $autoDetectData = true){
        $this->_fillOutForm($model,$autoDetectData);
        return $this;
    }
    public function showHidden($show = true){
        $this->_showHidden($show);
        return $this;
    }

    public function editForm(){
        $this->_editForm();
        return $this;
    }

    public function view(){
        $this->_view();
        return $this;
    }

    public function render(){
        return $this->_render();
    }
    public function renderEditor(){
        return $this->_renderEditor();
    }

    public function getId($ViewVariable = false){
        return $this->_getId($ViewVariable) ?? $this ;
    }

    public function getError(){
        return $this->_getError();
    }

    public function addFieldType($name , $label = null , $view = null){
        $this->_addFieldType($name , $label, $view);
        return $this;
    }

    public function removeFieldType(){
        $this->_removeFieldType(func_get_args());
        return $this;
    }

    public function deleteForm(){
        return $this->_deleteForm();
    }
}
