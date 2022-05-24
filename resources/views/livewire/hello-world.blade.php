<div>
    <input wire:model="name" type="text">
    <input wire:model="loud" type="checkbox">
    <select wire:model="greeting" multiple>
        <option>Hello</option>
        <option>GoodBye</option>
        <option>Adios</option>
    </select>
    <h1>{{ implode(', ', $greeting) }} {{ $name }}
    @if ($loud)
        !
    @endif
    </h1>
</div>
