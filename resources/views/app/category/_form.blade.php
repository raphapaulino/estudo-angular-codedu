@component('form._form_group',['field' => 'name'])
    <label for="name">Nome</label>
    <input name="name" type="name" class="form-control {{ ($errors->has('name')?' is-invalid':'') }}" 
        id="name" value="{{ old('name', $category->name) }}">
@endcomponent