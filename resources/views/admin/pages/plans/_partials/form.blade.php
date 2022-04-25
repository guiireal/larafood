@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Nome:" value="{{ $plan->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="price">Preço:</label>
    <input type="text" id="price" name="price" class="form-control" placeholder="Preço:" value="{{ isset($plan) ? $plan->getOriginal('price') : old('price') }}">
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <input type="text" id="description" name="description" class="form-control" placeholder="Descrição:" value="{{ $plan->description ?? old('description') }}">
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>
