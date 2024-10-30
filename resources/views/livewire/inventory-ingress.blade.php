<form action="{{ route('inventory-ingress.store') }}" method="POST">
    @csrf
    <label for="material_id">Material</label>
    <select name="material_id" id="material_id">
        <!-- Aquí se mostrarían los materiales disponibles -->
    </select>

    <label for="quantity">Cantidad</label>
    <input type="number" name="quantity" id="quantity">

    <label for="price_per_unit">Precio por unidad</label>
    <input type="text" name="price_per_unit" id="price_per_unit">

    <label for="source">Fuente del ingreso</label>
    <input type="text" name="source" id="source">

    <label for="date">Fecha</label>
    <input type="date" name="date" id="date">

    <button type="submit">Registrar Ingreso</button>
</form>
