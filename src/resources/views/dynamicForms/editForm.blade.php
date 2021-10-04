<div id="moreFields" >
    @if(old('moreField'))
        @for( $i =0; $i < count(old('moreField')); $i++)
        <div class="card mb-5 moreFieldsItem{$key}">
            <input type="hidden" name="moreField[{{ $i }}][id]" value="{{ old('moreField.'.$i.'.id' , "") }}" class="form-control" >
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-12 col-form-label">name </label>
                                <div class="col-md-12">
                                    <input type="text" name="moreField[{{ $i }}][name]" value="{{ old('moreField.'.$i.'.name' , "") }}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-12 col-form-label mt-2">Type: </label>
                                <div class="col-md-12">
                                    <select class="form-control"  name="moreField[{{ $i }}][type]" data-size="7" data-style="btn btn-outline-info btn-round" title="Type">
                                        <option value="text" @if ( old('moreField.'.$i.'.type' , "") == 'text' ) selected @endif >Text Field</option>
                                        <option value="url" @if ( old('moreField.'.$i.'.type' , "") == 'url' ) selected @endif>url</option>
                                        <option value="password" @if ( old('moreField.'.$i.'.type' , "") == 'password' ) selected @endif>password</option>
                                        <option value="email" @if ( old('moreField.'.$i.'.type' , "") == 'email' ) selected @endif>email</option>
                                        <option value="select" @if ( old('moreField.'.$i.'.type' , "") == 'select' ) selected @endif>select</option>
                                        <option value="radio" @if ( old('moreField.'.$i.'.type' , "") == 'radio' ) selected @endif>radio</option>
                                        <option value="checkbox" @if ( old('moreField.'.$i.'.type' , "") == 'checkbox' ) selected @endif>checkbox</option>
                                        <option value="textarea" @if ( old('moreField.'.$i.'.type' , "") == 'textarea' ) selected @endif>textarea</option>
                                        <option value="date"  @if ( old('moreField.'.$i.'.type' , "") == 'date' ) selected @endif>date</option>
                                        <option value="number" @if ( old('moreField.'.$i.'.type' , "") == 'number' ) selected @endif>number</option>
                                        <option value="file" @if ( old('moreField.'.$i.'.type' , "") == 'file' ) selected @endif>file</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-12 col-form-label">description</label>
                                <div class="col-md-12">
                                    <input type="text" name="moreField[{{ $i }}][description]" value="{{ old('moreField.'.$i.'.description' , "") }}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-12 col-form-label mt-2">status</label>
                                <div class="col-md-12">
                                    <select class="form-control"  name="moreField[{{ $i }}][status]" data-size="7" data-style="btn btn-outline-info btn-round" title="status">
                                        <option value="required" @if ( old('moreField.'.$i.'.status' , "") == 'required' ) selected @endif>required</option>
                                        <option value="visible" @if ( old('moreField.'.$i.'.status' , "") == 'visible' ) selected @endif>visible</option>
                                        <option value="invisible" @if ( old('moreField.'.$i.'.status' , "") == 'invisible' ) selected @endif>invisible</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row moreFieldsItemMoreConfig{{ $i }} border rounded pb-2 mt-2" style="display: none;">
                            <hr>
                            <div class="col-md-8">
                                <label class="col-md-12 col-form-label">value Of Field</label>
                                <div class="col-md-12 border-bottom ">
                                    <input type="text" name="moreField[{{ $i }}][value]" value="{{ old('moreField.'.$i.'.value' , "") }}" class="form-control tagsinput" data-role="tagsinput" data-color="info"  placeholder="valueOfField">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-md-12 col-form-label">order To Show</label>
                                <div class="col-md-12">
                                    <input type="number" name="moreField[{{ $i }}][order]" value="{{ old('moreField.'.$i.'.order' , "") }}" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-12 col-form-label"> regixField</label>
                                <div class="col-md-12 border-bottom  text-left">
                                    <input type="text"  name="moreField[{{ $i }}][regex]" value="{{ old('moreField.'.$i.'.regex' , "") }}"  class="form-control tagsinput " dir="ltr" data-role="tagsinput" data-color="info" placeholder="regixField">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <<div class="btn btn-danger rounded" onclick="$('.moreFieldsItem{{ $i }}').remove();">
                                                                     <span class="btn-label">
                                                                        <i class="fa fa-trash"></i>
                                                                     </span>
                            delete
                        </div>
                        <div class="btn btn-default mt-4 rounded pointer" onclick="$('.moreFieldsItemMoreConfig{{ $i }}').toggle();">
                                                                     <span class="btn-label">
                                                                        <i class="fa fa-dot-circle-o"></i>
                                                                     </span>
                            more
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    @else
            @foreach($moreField[$DynamicFormsId] as $key => $field)
    <div class="card mb-5 moreFieldsItem{{ $key }}">
        <input type="hidden" name="moreField[{{ $key }}][id]" value="{{$field->id}}" class="form-control" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label">name </label>
                            <div class="col-md-12">
                                <input type="text" name="moreField[{{ $key }}][label]" value="{{$field->label}}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label mt-2">type</label>
                            <div class="col-md-12">
                                <select class="form-control"  name="moreField{{ $key }}][type_variable]" data-size="7" data-style="btn btn-outline-info btn-round">
                                    <option value="text" @if($field->type_variable == "text" ) selected @endif >text</option>
                                    <option value="url" @if($field->type_variable == "url" ) selected @endif >url</option>
                                    <option value="password" @if($field->type_variable == "url" ) selected @endif >password</option>
                                    <option value="email" @if($field->type_variable == "url" ) selected @endif >email</option>
                                    <option value="select" @if($field->type_variable == "url" ) selected @endif >select</option>
                                    <option value="radio" @if($field->type_variable == "url" ) selected @endif >radio</option>
                                    <option value="checkbox" @if($field->type_variable == "url" ) selected @endif >checkbox</option>
                                    <option value="textarea" @if($field->type_variable == "url" ) selected @endif >textarea</option>
                                    <option value="date" @if($field->type_variable == "url" ) selected @endif >date</option>
                                    <option value="number" @if($field->type_variable == "url" ) selected @endif >number</option>
                                    <option value="file" @if($field->type_variable == "url" ) selected @endif >file</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label">description</label>
                            <div class="col-md-12">
                                <input type="text" name="moreField[{{ $key }}][description]" value="{{$field->description}}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label mt-2">status</label>
                            <div class="col-md-12">
                                <select class="form-control"  name="moreField[{{ $key }}][status]" data-size="7" data-style="btn btn-outline-info btn-round" >
                                    <option value="required" @if($field->status == "required" ) selected @endif >required</option>
                                    <option value="show" @if($field->status == "show" ) selected @endif >show</option>
                                    <option value="hidden" @if($field->status == "hidden" ) selected @endif >hidden</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row moreFieldsItemMoreConfig{{ $key }} border rounded pb-2 mt-2" style="display: none;">
                        <hr>
                        <div class="col-md-8">
                            <label class="col-md-12 col-form-label">valueOfField</label>
                            <div class="col-md-12 border-bottom ">
                                <input type="text" name="moreField[{{ $key }}][values]" value="{{$field->values}}" class="form-control tagsinput" data-role="tagsinput" data-color="info"  placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-12 col-form-label"> orderToShow</label>
                            <div class="col-md-12">
                                <input type="number" name="moreField[{{ $key }}][order]" value="{{$field->order}}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="col-md-12 col-form-label">regixField</label>
                            <div class="col-md-12 border-bottom  text-left">
                                <input type="text"  name="moreField[{{ $key }}][validate]" value="{{$field->validate}}"  class="form-control tagsinput " dir="ltr" data-role="tagsinput" data-color="info" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="btn btn-danger rounded" onclick="$('.moreFieldsItem{{ $key }}').remove();">
                                                                 <span class="btn-label">
                                                                    <i class="fa fa-trash"></i>
                                                                 </span>
                        delete
                    </div>
                    <div class="btn btn-info mt-4 rounded pointer" onclick="$('.moreFieldsItemMoreConfig{{ $key }}').toggle();">
                                                                 <span class="btn-label">
                                                                    <i class="fa fa-dot-circle-o"></i>
                                                                 </span>
                        more
                    </div>
                </div>
            </div>
        </div>
    </div>
            @endforeach

    @endif
</div>
<div id="moreFieldsDelete">
</div>
<div class="row">
    <div class="col-md-12">
        <div class="btn btn-success border pointer float-left" onclick="add();">
                                             <span class="btn-label">
                                                <i class="fa fa-plus"></i>
                                             </span>
            add field
        </div>
    </div>
</div>
<div id="typeOfAddItem" style="display: none;">
    <div class="card mb-5 moreFieldsItem__IIDD__">
        <input type="hidden" name="moreField[__IIDD__][id]" value="0" class="form-control" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label">name</label>
                            <div class="col-md-12">
                                <input type="text" name="moreField[__IIDD__][name]"  value="" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label mt-2">type</label>
                            <div class="col-md-12">
                                <select class="form-control"  name="moreField[__IIDD__][type]" data-size="7" data-style="btn btn-outline-info btn-round" title="">
                                    <option value="text" selected>text</option>
                                    <option value="url">url</option>
                                    <option value="password">password</option>
                                    <option value="email">email</option>
                                    <option value="select">select</option>
                                    <option value="radio">radio</option>
                                    <option value="checkbox">checkbox</option>
                                    <option value="textarea">textarea</option>
                                    <option value="date">date</option>
                                    <option value="number">number</option>
                                    <option value="file">file</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label">description</label>
                            <div class="col-md-12">
                                <input type="text"  name="moreField[__IIDD__][description]" value="" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-12 col-form-label mt-2">status</label>
                            <div class="col-md-12">
                                <select class="form-control" name="moreField[__IIDD__][status]" data-size="7" data-style="btn btn-outline-info btn-round" title="">
                                    <option value="required">required</option>
                                    <option value="visible" selected>visible</option>
                                    <option value="invisible">invisible</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row moreFieldsItemMoreConfig__IIDD__ border rounded pb-2 mt-2" style="display: none;">
                        <hr>
                        <div class="col-md-8">
                            <label class="col-md-12 col-form-label">valueOfField </label>
                            <div class="col-md-12 border-bottom ">
                                <input type="text"   name="moreField[__IIDD__][value]" value="" class="form-control tagsinputTemp"   placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-12 col-form-label">orderToShow</label>
                            <div class="col-md-12">
                                <input type="number" name="moreField[__IIDD__][order]" value="" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="col-md-12 col-form-label">regixField</label>
                            <div class="col-md-12 border-bottom  text-left">
                                <input type="text"   name="moreField[__IIDD__][regex]" value="" class="form-control tagsinputTemp " dir="ltr" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="btn btn-danger rounded" onclick="$('.moreFieldsItem__IIDD__').remove()">
                                                                 <span class="btn-label">
                                                                    <i class="fa fa-trash"></i>
                                                                 </span>
                        delete
                    </div>
                    <div class="btn btn-default mt-4 rounded pointer" onclick="$('.moreFieldsItemMoreConfig__IIDD__').toggle();">
                                                                 <span class="btn-label">
                                                                    <i class="fa fa-dot-circle-o"></i>
                                                                 </span>
                        more
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var numberOfElement = 0;
    function add() {
        var string = $('#typeOfAddItem').html();
        string = string.replace(new RegExp('__IIDD__', 'g'), numberOfElement);
        string = string.replace(new RegExp('selectpickerTemp', 'g'), 'selectpicker');
        string = string.replace(new RegExp('tagsinputTemp', 'g'), 'tagsinput');
        string = string.replace(new RegExp('tagsinputDataTemp', 'g'), 'data-role="tagsinput" data-color="info"');
        $('#moreFields').append(string);
        numberOfElement++;
        // $('.selectpicker').selectpicker('refresh');
        $('.tagsinput').tagsinput('refresh').tagClass('info');
    }
</script>

