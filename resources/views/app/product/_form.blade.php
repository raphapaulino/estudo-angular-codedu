@component('form._form_group',['field' => 'name'])
    <label for="name">Nome</label>
    <input name="name" type="name" class="form-control {{ ($errors->has('name')?' is-invalid':'') }}" 
        id="name" value="{{ old('name', $product->name) }}">
@endcomponent

@component('form._form_group',['field' => 'description'])
    <label for="description">Descrição</label>
    <textarea name="description" type="description" class="form-control {{ ($errors->has('description')?' is-invalid':'') }}" 
        id="description">{{ old('description', $product->description) }}</textarea>
@endcomponent

@component('form._form_group',['field' => 'price'])
    <label for="price">Preço</label>
    <input name="price" type="number" class="form-control {{ ($errors->has('price')?' is-invalid':'') }}" 
        id="price" step="0.01" value="{{ old('price', $product->price) }}">
@endcomponent

@component('form._form_group',['field' => 'category_id'])
    <label for="category_id">Categoria</label>
    <select name="category_id" class="form-control {{ ($errors->has('category_id')?' is-invalid':'') }}" id="category_id">
        <option value="">Selecione...</option>
        @foreach ($categories->pluck('name','id') as $key => $category)
            <option value="{{ $key }}" {{ old('category_id', optional($product->category)->id) == $key ? 'selected' : '' }}>{{ $category }}</option>
        @endforeach
    </select>
@endcomponent
{{--

@component('form._form_group',['field' => 'price'])
    {{ Form::label('price','Preço') }}
    {{ Form::number('price',null,['step' => '0.01','class' => 'form-control'.($errors->has('price')?' is-invalid':'')]) }}
@endcomponent

@component('form._form_group',['field' => 'category_id'])
    {{ Form::label('category_id','Categoria') }}
    {{ Form::select('category_id',$categories->pluck('name','id'),null,['class' => 'form-control'.($errors->has('category_id')?' is-invalid':'')]) }}
@endcomponent --}}