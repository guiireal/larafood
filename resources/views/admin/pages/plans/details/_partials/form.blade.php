@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" placeholder="Nome" class="form-control" value={{ $planDetail->name ?? old('name') }}>
</div>

<div class="form-group">
    <button class="btn btn-dark">Enviar</button>
</div>
